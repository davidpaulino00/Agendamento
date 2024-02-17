<?php
	require_once "../models/conexao.class.php";
	require_once "../models/faixa.class.php";
	require_once "../models/faixaDAO.class.php";
	if($_GET)
	{
		$faixa = new faixa($_GET["id"]);
		$faixa->setSituacao($_GET["sit"]);
		$faixaDAO = new faixaDAO();
		$ret = $faixaDAO->alterarSituacao($faixa);
		header("Location:listarfaixa.php?msg=$ret");
	}
?>