 <html>
 <?php
	require_once "cabecalho.php";
?>
 <div class="content">
			<div class="container">
			 
				<h2>Lista de Alunos Agendados</h2><br><br>
				
				<table class="table-striped"  width="50%" id="matricula">
				
					<thead>
						<tr>
						    <th>Nome :</th>
							<th>Presenca: </th>
							<th>Situação :</th>
							
							<th style='text-align:center'>Ações</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						require_once "../models/conexao.class.php";
						require_once "../models/aluno_agendadoDAO.class.php";
						require_once "../models/aluno_agendado.class.php";
						require_once "../models/alunoDAO.class.php";
						require_once "../models/aluno.class.php";
						//buscar produtos no BD
						$aluno_agendadoDAO = new aluno_agendadoDAO();
					
						$retorno = $aluno_agendadoDAO->buscarTodosAlunoAgendado();
						if(count($retorno) > 0)
						{
							foreach($retorno as $dado)
							{
								echo "<tr>";
								
								echo "<td>{$dado->nome}</td>";
								echo "<td>{$dado->presenca}</td>";
								echo "<td>{$dado->situacao}</td>";
								
								
								echo "<td><a class='btn btn-warning btn-sm' href='alterarAluno_agenda.php?id={$dado->idaluno_agenda}'>Alterar</a></td>";
								echo "</tr>";
							}
						}
					?>
					</form>
					</tbody>
				</table>
				<br><a href="matricula.php" class="btn btn-lg btn-success">Nova Aluno Agendado</a>
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#usuario tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#usuario',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#usuario tbody tr:visible").length != 0) {
						$("#usuario").trigger("update");
						$("#usuario").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>