<?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/modalidade.class.php";
	require_once "../models/modalidadeDAO.class.php";
	require_once "../models/horario.class.php";
	require_once "../models/horarioDAO.class.php";
	require_once "../models/usuario.class.php";
	require_once "../models/usuarioDAO.class.php";
	require_once "../models/professor.class.php";
	require_once "../models/professorDAO.class.php";
	$id_modalidade = 0;
	$descritivo = "";
	if($_GET)
	{
		$id_modalidade = $_GET["id"];
		
		//buscar dados modalidade
		$modalidade = new modalidade($_GET["id"]);
		
		$modalidadeDAO = new modalidadeDAO();
		$ret = $modalidadeDAO->buscarUmaModalidade($modalidade);
		
		$descritivo = $ret[0]->descritivo;
	}
	if($_POST)
	{
		$erro =0;
		//fazer a validação
		
		if($erro == 0)
		{
			
			$modalidade = new modalidade($id_modalidade);
			$professor = new professor($_POST["professor"]);
			$horario = new horario(null, $_POST["inicio"], $_POST["fim"], $_POST["semana"], $modalidade, $professor, "S");
			$horarioDAO = new horarioDAO();
			$retorno = $horarioDAO->inserir($horario);
			header("Location:listarHorario.php?msg=$retorno&id=$id_modalidade");
		}
			
	}//ifpost
?>
<div class="content">
	<div class="container">
			
		<form action="#" method="POST">
			<div class="row justify-content-center align-items-center">	
				<h2>Horário</h2>
			</div><br><br>
			<div class="box">
			<input type="hidden" name="id" value="<?php echo $id_modalidade;?>">
			<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="modalidade" class="col-sm-2 col-form-label col-form-label-lg">Modalidade</label>
						<div class="col-sm-6">
							<input type="text" name="modalidade"  class="form-control form-control-lg" id="modalidade" placeholder="" value="<?php echo $descritivo?>" disabled>
						</div>
					</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="inicio" class="col-sm-2 col-form-label col-form-label-lg">Horário de Início:</label>
						<div class="col-sm-6">
							<input type="time" name="inicio" required class="form-control form-control-lg" id="inicio" placeholder="" value="<?php if($_POST)echo $_POST['inicio'];else echo '00:00'?>">
						</div>
					</div>
					<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="fim" class="col-sm-2 col-form-label col-form-label-lg">Horário de Término:</label>
						<div class="col-sm-6">
							<input type="time" name="fim" required class="form-control form-control-lg" id="fim" placeholder="" value="<?php if($_POST)echo $_POST['fim'];else echo '00:00'?>">
						</div>
					</div>
					<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="semana" class="col-sm-2 col-form-label col-form-label-lg">Dia da Semana</label>
						<div class="col-sm-6">
							<select name="semana" id="semana">
							<option value=7>Escolha o dia da semana</option>
							<option value=1>Segunda-Feira</option>
							<option value=2>Terça-Feira</option>
							<option value=3>Quarta-Feira</option>
							<option value=4>Quinta-Feira</option>
							<option value=5>Sexta-Feira</option>
							<option value=6>Sábado</option>
							<option value=0>Domingo</option>
							</select>
						</div>
					</div>
					<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
				<label for="professor" class="col-sm-2 col-form-label col-form-label-lg">Professor</label>
				<div class="col-sm-6">
				<select name="professor" id="professor">
					<option value='0'>Escolha um professor</option>
					
					<?php
					$modalidade = new modalidade($id_modalidade);
					$usuario = new usuario();
					$usuario->setModalidade($modalidade);
					$usuarioDAO = new usuarioDAO();
					$prof = $usuarioDAO->buscarTodosUsuariosModalidade($usuario);
					foreach($prof as $dado)
					{
						echo "<option value='{$dado->idprofessor}'>{$dado->nome}</option>";
					}
				?>
				</select>
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