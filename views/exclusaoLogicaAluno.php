<?php
	require_once "../models/conexao.class.php";
	require_once "../models/aluno.class.php";
	require_once "../models/alunoDAO.class.php";
	if($_POST)
	{
		$aluno = new aluno($_POST["id"],null,null,null,null,null,null, $_POST["status"]);
		$alunoDAO = new alunoDAO();
		$alunoDAO->exclusaoLogica($aluno);
		header("Location:listarAlunos.php");
	}
?>