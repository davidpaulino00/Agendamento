<?php
	require_once "funcao_acesso.php";
	if(!verificaAutorizacao())
		header("location:home.php");
	if(isset($_GET["id"])
	
		require_once '../models/conexao.class.php';
		require_once '../models/aula_testeDAO.class.php';
		require_once '../models/aula_teste.class.php';
		$id = (int)$_GET["id"];
		$aula_teste = new aula_teste($id, null, null,null,null,null,null,null,null,"N");
		$aula_testeDAO = new aula_testeDAO();
		$aula_testeDAO->baixarAulaRealizada($aula_teste);
		header("Location:listarAulaTeste.php");
	
	else{
		header("Location:home.php");
	}
	
	
?>