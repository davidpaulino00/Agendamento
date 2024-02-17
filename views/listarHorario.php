 <?php
	require_once "cabecalho.php";
	require_once "funcao_acesso.php";
	if(!verificaAutorizacao())
		header("location:home.php");
	require_once "../models/conexao.class.php";
	require_once "../models/horarioDAO.class.php";
	require_once "../models/horario.class.php";
	require_once "../models/modalidade.class.php";
	require_once "../models/modalidadeDAO.class.php";
	$id_modalidade = 0;
	if($_GET)
    {
		$id_modalidade = $_GET["id"];
		
		//buscar horários da modalidades no BD
		$modalidade = new modalidade($_GET["id"]);
		$horario = new horario(null, null, null, null, $modalidade, null,null);
		$horarioDAO = new horarioDAO();
		$retorno = $horarioDAO->buscarTodosHorariosModalidade($horario);
		$modalidadeDAO = new modalidadeDAO();
		$mod = $modalidadeDAO->buscarUmaModalidade($modalidade);
	}
	else
		header("Location:listarModalidade.php");
	
?>
 <div class="content">
	<div class="container">
			 
		<br>
				<div class="row justify-content-center align-items-center">
				<h2>Horários</h2></div><br>
				<div class="row justify-content-center align-items-center">
				<h3>Modalidade - <?php echo $mod[0]->descritivo;?></h3></div><br>
				<?php
					if(is_array($retorno) && count($retorno) > 0)
					{
				?>
				
				<table class="table table-striped table-bordered"  id="horario">
				
				<thead>
					<tr>
						<th scope="col">Início</th>
						<th scope="col">Término</th>
						<th scope="col">Dia da Semana</th>
						<th scope="col">Professor</th>
						<th scope="col" style="text-align:center;">Situação</th>
						<th style="text-align:center;" scope="col">Ações</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$dia = array("Domingo","Segunda-Feira", "Terça-Feira","Quarta-Feira","Quinta-Feira","Sexta-Feira","Sábado"); 							
						
			foreach($retorno as $dado)
			{
				echo "<tr>";
				
				echo "<td>{$dado->horario_inicio}</td>";
				echo "<td>{$dado->horario_fim}</td>";
				
				echo "<td>" . $dia[$dado->dia_semana] . "</td>";
				echo "<td>{$dado->nome}</td>";
				$situacao = "";
				if($dado->situacao == "S")
					$situacao = "Ativa";
				else
					$situacao = "Inativa";
				echo "<td style='text-align:center;'>$situacao</td>";	
				
				
					echo "<td style='text-align:center;' ><a class='btn btn-warning btn-sm' href='edit_horario.php?id={$dado->idhorario}&id_mod={$id_modalidade}'>Alterar</a>&nbsp;&nbsp;";
					if($dado->situacao == "S")
					{
						echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_horario.php?id={$dado->idhorario}&sit=N&id_mod={$id_modalidade}'>Inativar</a>";
						
					}
					else
					{
						echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_horario.php?id={$dado->idhorario}&sit=S&id_mod={$id_modalidade}'>Ativar</a>";
					}
					
					
				echo "</td></tr>";
			}
						
		?>
					
					</tbody>
				</table>
	<?php
	
				
	echo "<br><a class='btn btn-success btn-lg' href='form_horario.php?id={$id_modalidade}'>Novo Horário</a>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='btn btn-primary btn-lg' href='listarModalidade.php'>Voltar</a>";
	}
	else
	{
		header("location:form_horario.php?id=$id_modalidade");
	}
	?>			
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#horario tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#horario',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#horario tbody tr:visible").length != 0) {
						$("#horario").trigger("update");
						$("#horario").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>