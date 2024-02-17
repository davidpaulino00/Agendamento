<?php
	require_once "../models/conexao.class.php";
	require_once "../models/modalidade.class.php";
	require_once "../models/modalidadeDAO.class.php";
	if($_GET)
	{
		$modalidade = new modalidade($_GET["id"], null, $_GET["sit"]);
		$modalidadeDAO = new modalidadeDAO();
		$ret = $modalidadeDAO->alterarSituacao($modalidade);
		header("Location:listarModalidade.php?msg=$ret");
	}
?>