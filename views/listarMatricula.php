 <html>
 <?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/matricula.class.php";
	require_once "../models/matriculaDAO.class.php";
	require_once "../models/usuario.class.php";
	require_once "../models/aluno.class.php";
	$idaluno = 0;
	if($_GET)
	{
		$idaluno = $_GET["id"];
		//buscar matriculas no BD
		$aluno = new aluno($_GET["id"]);
		
		$matricula = new matricula(null, null, $aluno);
		$matriculaDAO = new matriculaDAO();
		$retorno = $matriculaDAO->buscarMatriculasAluno($matricula);
	}
	
?>
 <div class="content">
			<div class="container">
			 <?php
				if(is_array($retorno) && count($retorno) > 0)
				{
			?>
				<div class="row justify-content-center align-items-center">
				<h2>Lista de Matrículas</h2></div><br><br>
				<div class="row justify-content-center align-items-center">
  
						<label for="aluno" class="col-sm-1 col-form-label col-form-label-lg">Aluno:</label>
						<div class="col-sm-6">
							<input type="text" name="aluno" required class="form-control form-control-lg" id="aluno" placeholder="" value="<?php echo $retorno[0]->nome;?>" readonly>
						</div>
					</div><br><br>
				
				<table class="table table-striped table-bordered table-sm"  id="matricula">
				
					<thead>
						<tr>
						    <th scope="col">Modalidade</th>
							<th style="text-align:center;">Data da Matrícula</th>
							<th style="text-align:center;">Data de Validade</th>
							<th style="text-align:center;">Horário de Inicio</th>
							<th style="text-align:center;">Horário de Fim</th>
							<th style="text-align:center;">Dia da Semana</th>
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
				$data = explode("-", $dado->data_matricula);
				$dataM = $data[2] . "/" . $data[1] . "/" . $data[0];
				$data = explode("-", $dado->data_validade);
				$dataV = $data[2] . "/" . $data[1] . "/" . $data[0];
				echo "<td>{$dataM}</td>";
				echo "<td>{$dataV}</td>";
				echo "<td>{$dado->horario_inicio}</td>";
				echo "<td>{$dado->horario_fim}</td>";
				$diasemana = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
				echo "<td>{$diasemana[$dado->dia_semana]}</td>";
				
				$situacao = "";
				if($dado->situacao == "S")
					$situacao = "Ativa";
				else
					$situacao = "Inativa";
				echo "<td style='text-align:center;'>$situacao</td>";	
				
					echo "<td style='text-align:center;' ><a class='btn btn-warning btn-sm' href='edit_matricula.php?id={$dado->idmatricula}'>Alterar</a>&nbsp;&nbsp;";
					if($dado->situacao == "S")
					{
						echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_matricula.php?id={$dado->idmatricula}&sit=N&idaluno={$dado->aluno_idaluno}'>Inativar</a>";
						
					}
					else
					{
						echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_matricula.php?id={$dado->idmatricula}&sit=S&idaluno={$dado->aluno_idaluno}'>Ativar</a>";
					}
					
					
				echo "</td></tr>";
			}
						
		?>
					
					</tbody>
				</table>
				<br><a class='btn btn-success btn-bg' href='form_matricula.php?id=<?php echo $retorno[0]->aluno_idaluno;?>'>Nova Matrícula</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='btn btn-primary btn-md' href='listarAlunos.php'>Voltar</a>
				<?php
				}
				else
				{
					header("Location:form_matricula.php?id={$_GET['id']}");
				}
				?>
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#matricula tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#matricula',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#matricula tbody tr:visible").length != 0) {
						$("#matricula").trigger("update");
						$("#matricula").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>