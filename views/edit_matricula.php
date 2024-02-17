<?php
	date_default_timezone_set('America/Sao_Paulo');
	require_once "cabecalho.php";
	require_once "funcao_acesso.php";
	if(!verificaAutorizacao())
		header("location:home.php");
	require_once "../models/conexao.class.php";
	require_once "../models/modalidade.class.php";
	require_once "../models/modalidadeDAO.class.php";
	require_once "../models/usuario.class.php";
	require_once "../models/aluno.class.php";
	require_once "../models/alunoDAO.class.php";
	require_once "../models/matriculaDAO.class.php";
	require_once "../models/matricula.class.php";
	require_once "../models/horario.class.php";
	require_once "../models/horarioDAO.class.php";
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
			
			$horario = new horario($_POST["horario"]);
			$faixa = new faixa($_POST["faixa"]);
			$aluno = new aluno(null, null,null,null,null, $_POST["idusuario"]);
			$modalidade = new modalidade($_POST["idmodalidade"]);
			$modalidade->setFaixa($faixa);
			$matricula = new matricula($_POST["idmatricula"], $horario, $aluno, $modalidade, $_POST["dataMatricula"], $_POST["dataValidade"]);
			$matriculaDAO = new matriculaDAO();
			$retorno = $matriculaDAO->alterar($matricula);
			header("Location:listarMatricula.php?id={$_POST['idaluno']}&msg=$retorno");
		}
			
	}//ifpost
	if($_GET)
	{
		$matricula = new matricula($_GET["id"]);
		$matriculaDAO = new matriculaDAO();
		$retorno = $matriculaDAO->buscarUmaMatricula($matricula);
		$aluno = new aluno($retorno[0]->aluno_idaluno);
		$modalidade = new modalidade($retorno[0]->modalidade_idmodalidade);
		$aluno->setModalidade($modalidade);
		$alunoDAO = new alunoDAO();
		$retAluno = $alunoDAO->buscarUmAlunoFaixa($aluno);
		
	}
?>
<div class="content">
	<div class="container">
			
		<form action="#" method="POST">
			<input type="hidden" name="idaluno" value="<?php echo $retorno[0]->aluno_idaluno;?>">
			<input type="hidden" name="idusuario" value="<?php echo $retAluno[0]->usuario_idusuario;?>">
			<input type="hidden" name="idmatricula" value="<?php echo $retorno[0]->idmatricula;?>">
			<input type="hidden" name="idmodalidade" value="<?php echo $retorno[0]->modalidade_idmodalidade;?>">
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
							<input type="text" name="modalidade" required class="form-control form-control-lg" id="modalidade" placeholder="" value="<?php echo $retorno[0]->descritivo;?>" readonly>
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div  class="row justify-content-center align-items-center">
					<label for='horario' class='col-sm-2 col-form-label col-form-label-lg' id='l1'>Horário:</label>
					
					<div class="col-sm-6">
					<select  name="horario" id="horario">
					<?php
					$modalidade = new modalidade($retorno[0]->modalidade_idmodalidade);
					
					$horario = new horario(null, null, null,null,$modalidade);
					$horario->setSituacao("S");
					
					$horarioDAO = new horarioDAO();
					
					$ret = $horarioDAO->buscarHorariosModalidade($horario);
					
					$diasemana = array('Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado');
					
					if(is_array($ret))
					{
						foreach($ret as $h)
						{
							$desc = $diasemana[$h->dia_semana] . " - Das " . $h->horario_inicio . " às " . $h->horario_fim;
							if($retorno[0]->horario_idhorario == $h->idhorario)
							{
								echo "<option value='$h->idhorario' selected>$desc</option>";
							}
							else
							{
								echo "<option value='$h->idhorario'>$desc</option>";
							}
						}
					}
					?>
					
					</select>
					</div>
					</div>
					</div>
					<div class = "form-group">
					<div  class="row justify-content-center align-items-center">
					<label for='faixa' class='col-sm-2 col-form-label col-form-label-lg' id='l2'>Faixa:</label>
					
					<div class="col-sm-6">
					<select  name="faixa" id="faixa">
					<?php
					$modalidade = new modalidade($retorno[0]->modalidade_idmodalidade);
					$modalidadeDAO = new modalidadeDAO();
					
					$ret = $modalidadeDAO->buscarFaixasModalidade($modalidade);
					
					if(is_array($ret))
					{
						foreach($ret as $f)
						{
							
							if($retAluno[0]->faixa_idfaixa == $f->idfaixa)
							{
								echo "<option value='{$f->idfaixa}' selected>{$f->descritivo}</option>";
							}
							else
							{
								echo "<option value='{$f->idfaixa}'>{$f->descritivo}</option>";
							}
						}
					}
					?>
					
					</select>
					</div>
					</div>
					</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="dataMatricula" class="col-sm-2 col-form-label col-form-label-lg">Data da Matrícula:</label>
						<div class="col-sm-6">
							<input type="date" name="dataMatricula" required class="form-control form-control-lg" id="dataMatricula" placeholder="" value="<?php echo $retorno[0]->data_matricula;?>">
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="dataValidade" class="col-sm-2 col-form-label col-form-label-lg">Data de Validade:</label>
						<div class="col-sm-6">
							<input type="date" name="dataValidade" required class="form-control form-control-lg" id="dataValidade" placeholder="" value="<?php echo $retorno[0]->data_validade;?>">
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
	
	</body>
</html>