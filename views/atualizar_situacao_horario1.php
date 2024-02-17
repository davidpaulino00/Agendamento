<?php
	require_once "../models/conexao.class.php";
	require_once "../models/horario.class.php";
	require_once "../models/horarioDAO.class.php";
	if($_GET)
	{
		$horario = new horario($_GET["id"]);
		$horario->setSituacao($_GET["sit"]);
		$horarioDAO = new horarioDAO();
		$ret = $horarioDAO->alterarSituacao($horario);
		header("Location:listarHorario.php?msg=$ret");
	}
?>