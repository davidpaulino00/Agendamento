 <?php
	//echo $_SERVER['REQUEST_URI'];
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/modalidadeDAO.class.php";
						
	//buscar modalidades no BD
	$modalidadeDAO = new modalidadeDAO();
	$retorno = $modalidadeDAO->buscarModalidades();
	
?>
 <div class="content">
			<div class="container">
			 <?php
				if(is_array($retorno) && count($retorno) > 0)
				{
			?>
				<div class="row justify-content-center align-items-center">
				<h2>Modalidades</h2></div><br><br>
				
				<table class="table table-striped table-bordered table-sm"  id="modalidade">
				
					<thead>
						<tr>
						    <th scope="col">Descritivo</th>
							<th scope="col" style="text-align:center;">Situação</th>
							<th style="text-align:center;" scope="col">Ações</th>
						</tr>
					</thead>
					<tbody>
		<?php
												
						
			foreach($retorno as $dado)
			{
				echo "<tr>";
				
				echo "<td>{$dado->descritivo}</td>";
				$situacao = "";
				if($dado->situacao == "S")
					$situacao = "Ativa";
				else
					$situacao = "Inativa";
				echo "<td style='text-align:center;'>$situacao</td>";	
				
					echo "<td style='text-align:center;' ><a class='btn btn-warning btn-sm' href='edit_modalidade.php?id={$dado->idmodalidade}'>Alterar</a>&nbsp;&nbsp;";
					
					if($dado->situacao == "S")
					{
						echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_modalidade.php?id={$dado->idmodalidade}&sit=N'>Inativar</a>";
						
					}
					else
					{
						echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_modalidade.php?id={$dado->idmodalidade}&sit=S'>Ativar</a>";
					}
					if($dado->situacao == "N")
					{
						echo "&nbsp;&nbsp;<a class='btn btn-primary btn-sm disabled' href='#'>Horário</a>";
					}
					else
					{
						echo "&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='listarHorario.php?id={$dado->idmodalidade}'>Horário</a>";
					}
					if($dado->situacao == "N")
					{
						echo "&nbsp;&nbsp;<a class='btn btn-primary btn-sm disabled' href='#'>Faixa</a>";
					}
					else
					{
				      echo "&nbsp;&nbsp;<a class='btn btn-warning btn-sm' href='listarfaixa.php?id={$dado->idmodalidade}'>Faixa</a>&nbsp;&nbsp;";
					}
					
					
				echo "</td></tr>";
			}
						
		?>
					
					</tbody>
				</table>
				<br><a class='btn btn-success btn-bg' href='form_modalidade.php'>Nova Modalidade</a>
				<?php
				}
				else
				{
					header("location:form_modalidade.php");
				}
				?>
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#modalidade tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#modalidade',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#modalidade tbody tr:visible").length != 0) {
						$("#modalidade").trigger("update");
						$("#modalidade").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>