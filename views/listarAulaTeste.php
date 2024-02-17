 <html>
 <?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/aula_testeDAO.class.php";
						
	//buscar agenda de aulas teste no BD
	$aula_testeDAO = new aula_testeDAO();
	$retorno = $aula_testeDAO->buscarTodosAlunoAgendado();
	
?>
 <div class="content">
			<div class="container">
			 <?php
				if(is_array($retorno) && count($retorno) > 0)
				{
			?>
				<div class="row justify-content-center align-items-center">
				<h2>Agenda de Aulas Teste</h2></div><br><br>
				
				<table class="table table-striped"  width="50%" id="aula_teste">
				
					<thead>
						<tr>
						    <th scope="col">Nome</th>
							<th>E-mail</th>
							<th>Telefone</th>
							<th>Modalidade</th>
							<th>Início</th>
							<th>Término</th>				
							<th>Data da Aula</th>					
							<th style='text-align:center'>Ações</th>
					  </tr>
					</thead>
					<tbody>
					<?php
					foreach($retorno as $dado)
					{
						echo "<tr>";
						
						echo "<td>{$dado->nome}</td>";
						
						echo "<td>{$dado->email}</td>";
						if($dado->celular != null)
							echo "<td>{$dado->celular}</td>";
						else
							echo "<td>{$dado->telefone}</td>";
						echo "<td>{$dado->descritivo}</td>";
						
						echo "<td>{$dado->horario_inicio}</td>";
						echo "<td>{$dado->horario_fim}</td>";
						$data = explode("-", $dado->data_aula);
						$aula = $data[2] . "/" . $data[1] . "/" . $data[0];
						echo "<td>$aula</td>";
						if($dado->situacao == "S")
							echo "<td><a class='btn btn-warning btn-sm' href='baixar_aula_teste.php?id={$dado->idaula_teste}'>Baixar</a>";
						else
						{
							echo "<td><a class='btn btn-success btn-sm' href='#'>Realizada</a>";
						}
						//echo "&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='detalhes_aula_teste.php?id={$dado->idaula_teste}'>Detalhes</a></td>";
						echo "</tr>";
					}
						
					?>
					
					</tbody>
				</table>
				<?php
				}
				else
				{
					echo "<div class='row justify-content-center align-items-center'><h2>Não há aulas teste agendada</h2></div>";
				}
				?>
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#aula_teste tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#aula_teste',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#aula_teste tbody tr:visible").length != 0) {
						$("#aula_teste").trigger("update");
						$("#aula_teste").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>