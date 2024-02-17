<?php
	require_once "../models/conexao.class.php";
	require_once "../models/frequencia.class.php";
	require_once "../models/frequenciaDAO.class.php";
	if($_GET)
	{
		$frequencia = new frequencia($_GET["id"]);
		$frequencia->getPresenca();
		$frequenciaDAO = new frequenciaDAO();
		$ret = $frequenciaDAO->alterarPresenca($frequencia);
		header("Location:listarfrequencia.php?msg=$ret");
	}
?>