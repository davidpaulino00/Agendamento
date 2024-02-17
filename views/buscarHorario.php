<?php
	if($_GET)
	{
		session_start();
		require_once '../models/conexao.class.php';
		require_once '../models/horario.class.php';
		require_once '../models/modalidade.class.php';
		require_once '../models/horarioDAO.class.php';
		require_once '../models/usuario.class.php';
		require_once "../models/professor.class.php";
		
		$modalidade = new modalidade($_GET["id"]);
		$horario = new horario(null, null, null, null, $modalidade, null, "S");
		$horarioDAO = new horarioDAO();
		if (isset ($_SESSION["perfil"])){
			
			
			if($_SESSION["perfil"] == "Administrador")
				$ret = $horarioDAO->buscarHorariosModalidade($horario);
			else if($_SESSION["perfil"] == "Professor")
			{
				$professor = new professor(null, null, $_SESSION["id"]);
				$horario->setProfessor($professor);
				$ret = $horarioDAO->buscarHorariosModalidadeProfessor($horario);
			}
	   }
	   else{
		   $ret = $horarioDAO->buscarHorariosModalidade($horario);
	   }
		echo json_encode($ret);
	}
?>