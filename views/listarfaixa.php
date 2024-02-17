 <?php
	
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/faixaDAO.class.php";
	require_once "../models/faixa.class.php";
	require_once "../models/modalidade.class.php";
	require_once "../models/modalidadeDAO.class.php";
	$id_modalidade = 0;
	if($_GET)
    {
		$id_modalidade = $_GET["id"];
		
		//buscar horários da modalidades no BD
		$modalidade = new modalidade($_GET["id"]);
		$faixa = new faixa(null, null, null, $modalidade);
		$faixaDAO = new faixaDAO();
		$retorno = $faixaDAO->buscarFaixa($faixa);
		$modalidadeDAO = new modalidadeDAO();
		$mod = $modalidadeDAO->buscarUmaModalidade($modalidade);
	}
	else
		header("Location:listarmodalidade.php");
?>
 <div class="content">
	<div class="container">
			 
		<br>
				<div class="row justify-content-center align-items-center">
				<h2>Faixas</h2></div><br>
				<div class="row justify-content-center align-items-center">
				<h3>Modalidade - <?php echo $mod[0]->descritivo;?></h3></div><br>
				<?php
					if(is_array($retorno) && count($retorno) > 0)
					{
				?>
				
				<table class="table table-striped table-bordered"  id="faixa">
				
				<thead>
					<tr>
						<th scope="col">Descritivo</th>
						<th scope="col">Sequência</th>
						
						
						<th style="text-align:center;" scope="col">Ações</th>
					</tr>
				</thead>
				<tbody>
				<?php
												
						
			foreach($retorno as $dado)
			{
				echo "<tr>";
				
				echo "<td>{$dado->descritivo}</td>";
				echo "<td>{$dado->sequencia}</td>";
				
				
				//echo "<td>" . $dia[$dado->dia_semana] . "</td>";
				
				////$situacao = "";
				//if($dado->situacao == "S")
					//$situacao = "Ativa";
				//else
					//$situacao = "Inativa";
				//echo "<td style='text-align:center;'>$situacao</td>";	
				
					echo "<td style='text-align:center;' ><a class='btn btn-warning btn-sm' href='edit_faixa.php?id={$dado->idfaixa}&id_mod={$id_modalidade}'>Alterar</a>&nbsp;&nbsp;";
					//if($dado->situacao == "S")
					
					
				echo "</td></tr>";
			}
						
		?>
					
					</tbody>
				</table>
	<?php
	
				
	echo "<br><a class='btn btn-success btn-lg' href='form_faixa.php?id={$id_modalidade}'>Novo faixa</a>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='btn btn-primary btn-lg' href='listarModalidade.php'>Voltar</a>";
	}
	else
	{
		header("location:form_faixa.php?id=$id_modalidade");
	}
	?>			
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#faixa tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#faixa',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#faixa tbody tr:visible").length != 0) {
						$("#faixa").trigger("update");
						$("#faixa").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>