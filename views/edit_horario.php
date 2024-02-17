<?php
	require_once "cabecalho.php";
	require_once "funcao_acesso.php";
	if(!verificaAutorizacao())
		header("location:home.php");
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
	$id=0;
	if($_GET)
	{
		$id_modalidade = $_GET["id_mod"];
		$id = $_GET["id"];
		//buscar dados modalidade
		$modalidade = new modalidade($_GET["id_mod"]);
		
		$modalidadeDAO = new modalidadeDAO();
		$ret = $modalidadeDAO->buscarUmaModalidade($modalidade);
		
		$descritivo = $ret[0]->descritivo;
		$horario = new horario($_GET["id"]);
		$horarioDAO = new horarioDAO();
		$retorno = $horarioDAO->buscarUmHorario($horario);
	}
	if($_POST)
	{
		$erro =0;
		//validar antes de alterar
		
		if($erro == 0)
		{
			$professor = new professor($_POST["professor"]);
			$horario = new horario($id, $_POST["inicio"], $_POST["fim"], $_POST["semana"], null, $professor);
			$horarioDAO = new horarioDAO();
			$retorno = $horarioDAO->alterar($horario);
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
			
			<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="modalidade" class="col-sm-2 col-form-label col-form-label-lg">Modalidade</label>
						<div class="col-sm-6">
							<input type="text" name="modalidade"  class="form-control form-control-lg" id="modalidade" placeholder="" value="<?php echo $descritivo?>" disabled>
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="inicio" class="col-sm-2 col-form-label col-form-label-lg">Horário de Inicio:</label>
						<div class="col-sm-6">
							<input type="time" name="inicio" required class="form-control form-control-lg" id="inicio" placeholder="" value="<?php if($_POST)echo $_POST['inicio'];else echo $retorno[0]->horario_inicio;?>">
						</div>
					</div>
				</div>
					<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="fim" class="col-sm-2 col-form-label col-form-label-lg">Horário de Término:</label>
						<div class="col-sm-6">
							<input type="time" name="fim" required class="form-control form-control-lg" id="fim" placeholder="" value="<?php if($_POST)echo $_POST['fim'];else echo $retorno[0]->horario_fim;?>">
						</div>
					</div>
				</div>
				</div>
					<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="semana" class="col-sm-2 col-form-label col-form-label-lg">Dia da Semana</label>
						<div class="col-sm-6">
							<select name="semana" id="semana">
							
							<?php
							$semana = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");
							for($x=1; $x<7; $x++)
							{
								if($retorno[0]->dia_semana == $x)
								{
									echo "<option value='{$x}' selected>{$semana[$x]}</option>";
								}
								else
								{
									echo "<option value='{$x}'>{$semana[$x]}</option>";
								}
							
							}
							
							?>
							</select>
						</div>
					</div>
				</div>
					<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
				<label for="professor" class="col-sm-2 col-form-label col-form-label-lg">Professor</label>
				<div class="col-sm-6">
				<select name="professor" id="professor">
				<?php
					$modalidade = new modalidade($id_modalidade);
					$usuario = new usuario();
					$usuario->setModalidade($modalidade);
					$usuarioDAO = new usuarioDAO();
					$prof = $usuarioDAO->buscarTodosUsuariosModalidade($usuario);
					foreach($prof as $dado)
					{
						if($dado->idprofessor == $retorno[0]->professor_idprofessor)
						{
							echo "<option value='{$dado->idprofessor}' selected>{$dado->nome}</option>";
						}
						else
						{
							echo "<option value='{$dado->idprofessor}'>{$dado->nome}</option>";
						}
					}
				?>
				</select>
			</div>
		</div>
		
	</div>
				
	<br>
	<div class="row justify-content-center align-items-center">
		<input type="submit" class = "btn btn-lg btn-success col-sm-2" value = "Alterar">
	</div>
			</div>
		</form>
	</div>
</div>
	
	</body>
</html>