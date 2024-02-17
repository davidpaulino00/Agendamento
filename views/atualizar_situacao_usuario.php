<?php
	if($_GET)
	{
		require_once "../models/conexao.class.php";
		require_once "../models/usuarioDAO.class.php";
		require_once "../models/usuario.class.php";
		$usuario = new usuario($_GET["id"]);
		$usuario->setSituacao($_GET["sit"]);
		$usuarioDAO = new usuarioDAO();
		$usuarioDAO->atualizarSituacao($usuario);
		if($_GET["pag"] == "aluno")
			header("location:listarAlunos.php");
		else if($_GET["pag"] == "professor")
			header("location:listarProfessores.php");
		else
			header("location:listarFuncionarios.php");
	}
	
?>