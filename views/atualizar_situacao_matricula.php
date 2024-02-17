<?php
	require_once "../models/conexao.class.php";
	require_once "../models/matricula.class.php";
	require_once "../models/matriculaDAO.class.php";
	if($_GET)
	{
		$matricula = new matricula($_GET["id"], null, null,null,null, null, $_GET["sit"]);
		$matriculaDAO = new matriculaDAO();
		$ret = $matriculaDAO->alterarSituacao($matricula);
		header("Location:listarMatricula.php?msg=$ret&id={$_GET['idaluno']}");
	}
?>