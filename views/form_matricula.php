<?php
	date_default_timezone_set('America/Sao_Paulo');
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/modalidade.class.php";
	require_once "../models/modalidadeDAO.class.php";
	require_once "../models/usuario.class.php";
	require_once "../models/aluno.class.php";
	require_once "../models/alunoDAO.class.php";
	require_once "../models/matriculaDAO.class.php";
	require_once "../models/matricula.class.php";
	require_once "../models/horario.class.php";
	require_once "../models/faixa.class.php";
	
	
	if($_POST)
	{
		$erro =0;
		if($_POST["dataMatricula"] == "")
		{
			echo "<script>alert('Data da Matrícula deve ser preenchida');</script>";
			$erro++;
		}
		if($_POST["dataValidade"] == "")
		{
			echo "<script>alert('Data de Vencimento deve ser preenchida');</script>";
			$erro++;
		}
		if($_POST["modalidade"]  == 0)
		{
			echo "<script>alert('Escolha uma modalidade');</script>";
			$erro++;
		}
		if($_POST["horario"]  == 0)
		{
			echo "<script>alert('Escolha um horário');</script>";
			$erro++;
		}
		if($_POST["faixa"]  == 0)
		{
			echo "<script>alert('Escolha uma faixa');</script>";
			$erro++;
		}
		if($erro == 0)
		{
			if(strtotime($_POST["dataMatricula"]) >= strtotime($_POST["dataValidade"]))
			{
				echo "<script>alert('A data da matrícula deve ser menor do que a data de validade');</script>";
				$erro++;
			}
		}
		if($erro == 0)
		{
			//verificar se já tem matrícula ativa 
			$modalidade = new modalidade($_POST["modalidade"]);
			$aluno = new aluno($_POST["idaluno"]);
			$horario = new horario($_POST["horario"]);
			$matricula = new matricula(null, $horario, $aluno, $modalidade, null, null, "S" );
			$matriculaDAO = new matriculaDAO();
			$ret = $matriculaDAO->verificarMatricula($matricula);
			if(count($ret) > 0)
			{
				echo "<script>alert('Matrícula já cadastrada');</script>";
				$erro++;
			}
		}
				
		if($erro == 0)
		{
			$modalidade = new modalidade($_POST["modalidade"]);
			$horario = new horario($_POST["horario"]);
			$faixa = new faixa($_POST["faixa"]);
			$modalidade->setFaixa($faixa);
			$aluno = new aluno($_POST["idaluno"],null,null,null,null, $_POST["idusuario"]);
			$matricula = new matricula(null, $horario, $aluno, $modalidade, $_POST["dataMatricula"], $_POST["dataValidade"], "S");
			$matriculaDAO = new matriculaDAO();
			$retorno = $matriculaDAO->inserir($matricula);
			header("Location:listarMatricula.php?id={$_POST['idaluno']}&msg=$retorno");
		}
			
	}//ifpost
	if($_GET)
	{
		$aluno = new aluno($_GET["id"]);
		$alunoDAO = new alunoDAO();
		$retorno = $alunoDAO->buscarUmAluno($aluno);
	}
?>
<div class="content">
	<div class="container">
			
		<form action="#" method="POST">
			<input type="hidden" name="idaluno" value="<?php echo $retorno[0]->idaluno;?>">
			<input type="hidden" name="idusuario" value="<?php echo $retorno[0]->usuario_idusuario;?>">
			<div class="row justify-content-center align-items-center">	
				<h2>Matrícula</h2>
			</div><br><br>
			<div class="box">
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="aluno" class="col-sm-2 col-form-label col-form-label-lg">Aluno:</label>
						<div class="col-sm-6">
							<input type="text" name="aluno" required class="form-control form-control-lg" id="aluno" placeholder="" value="<?php echo $retorno[0]->nome;?>" readonly>
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">	
				
				<label for="modalidade" class="col-sm-2 col-form-label col-form-label-lg">Modalidade:</label>
				<div class="col-sm-6">
				<select name="modalidade" id="modalidade">
				<option value="0">Escolha uma Modalidade</option>
				<?php
					$modalidadeDAO = new modalidadeDAO();
					$ret = $modalidadeDAO->buscarTodasModalidades();
					
					if(is_array($ret))
					{
						foreach($ret as $dado)
						{
							echo "<option value='{$dado->idmodalidade}'>{$dado->descritivo}</option>";
						}
					}
				?>
				</select>
				</div>
				</div>
				</div>
				<div class = "form-group">
					<div  class="row justify-content-center align-items-center">
					<label for='horario' class='col-sm-2 col-form-label col-form-label-lg' id='l1' style='display:none'>Horário:</label>
					
					<div class="col-sm-6">
					<!--não quebrar essa linha abaixo<-->
					
					<select  name="horario" id="horario" style="display:none"><option value="0">Escolha um Horário</option></select>
					</div>
					</div>
					</div>
				
				<div class = "form-group">
					<div  class="row justify-content-center align-items-center">
					<label for='faixa' class='col-sm-2 col-form-label col-form-label-lg' id='l2' style='display:none'>Faixa:</label>
					
					<div class="col-sm-6">
					<!--não quebrar essa linha abaixo<-->
					
					<select  name="faixa" id="faixa" style="display:none"><option value="0">Escolha uma Faixa</option></select>
					</div>
					</div>
					</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="dataMatricula" class="col-sm-2 col-form-label col-form-label-lg">Data da Matrícula:</label>
						<div class="col-sm-6">
							<input type="date" name="dataMatricula" required class="form-control form-control-lg" id="dataMatricula" placeholder="" value="<?php if($_POST)echo $_POST['dataMatricula'];?>">
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="dataValidade" class="col-sm-2 col-form-label col-form-label-lg">Data de Validade:</label>
						<div class="col-sm-6">
							<input type="date" name="dataValidade" required class="form-control form-control-lg" id="dataValidade" placeholder="" value="<?php if($_POST)echo $_POST['dataValidade'];?>">
						</div>
					</div>
				</div>
				
					<br>
				<div class="row justify-content-center align-items-center">
					<input type="submit" class = "btn btn-lg btn-success col-sm-2" value = "Enviar">
				</div>
			</div>
		</form>
	</div>
</div>
	<script type="text/javascript" src="../lib/jquery.js"></script>
	<script>
	
	$(function(){
		$('#modalidade').change(function(){
		//Pega id da modalidade

		var idmodalidade = $(this).val();
		if(idmodalidade == 0)
		{
			limpar();
			alert("escolha uma modalidade");
		}
		else
		{
			//Função ajax
			$.ajax({
				type:"GET",
				url:"buscarHorario.php",
				data:"id=" + idmodalidade,
				dataType:"json",
				success:function(horario){
					
					limpar("horario");
					document.getElementById("l1").style = "display:inline";
					document.getElementById("horario").style = "display:inline";
					var diasemana = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
					for(var x=0; x<horario.length;x++)
					{
						var option = document.createElement("option");
						option.setAttribute("value", horario[x].idhorario);
						option.appendChild(document.createTextNode(diasemana[horario[x].dia_semana] + " - Das " + horario[x].horario_inicio + " às " + horario[x].horario_fim));
						document.getElementById("horario").appendChild(option);
					}
				},
				error:function(){
					alert("Falha!!!");
				}
			});
			//Função ajax
			$.ajax({
				type:"GET",
				url:"buscarFaixa.php",
				data:"id=" + idmodalidade,
				dataType:"json",
				success:function(faixa){
					
					limpar("faixa");
					document.getElementById("l2").style = "display:inline";
					document.getElementById("faixa").style = "display:inline";
					
					for(var x=0; x<faixa.length;x++)
					{
						var option = document.createElement("option");
						option.setAttribute("value", faixa[x].idfaixa);
						option.appendChild(document.createTextNode(faixa[x].descritivo));
						document.getElementById("faixa").appendChild(option);
					}
				},
				error:function(){
					alert("Falha!!!");
				}
			});
		}
	});
});

function limpar(qual)
{
	if(qual == "horario")
	{
		var filhos = document.getElementById("horario").childNodes.length;
		if(filhos > 1)
		{
			for(var x=0; x<filhos-1; x++)
			{
				var elem = document.getElementById("horario").lastChild;
				document.getElementById("horario").removeChild(elem);
			}
			document.getElementById("l1").style = "display:none";
			document.getElementById("horario").style = "display:none";
		}
	}
	if(qual == "faixa")
	{
		filhos = document.getElementById("faixa").childNodes.length;
		if(filhos > 1)
		{
			for(var x=0; x<filhos-1; x++)
			{
				var elem = document.getElementById("faixa").lastChild;
				document.getElementById("faixa").removeChild(elem);
			}
			document.getElementById("l2").style = "display:none";
			document.getElementById("faixa").style = "display:none";
		}
	}
}

	</script>
	</body>
</html>