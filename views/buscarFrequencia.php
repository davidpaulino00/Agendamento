<?php
   
  if($_GET)
	{
		session_start();
		require_once '../models/conexao.class.php';
		require_once '../models/horario.class.php';
		require_once '../models/modalidade.class.php';
		require_once '../models/horarioDAO.class.php';
		require_once '../models/usuario.class.php';
		require_once '../models/matricula.class.php';
		require_once "../models/frequencia.class.php";
		require_once "../models/frequenciaDAO.class.php";
		
		
		
		$frequencia = new frequencia(null, $matricula,null, null, null);
		$frequenciaDAO = new frequenciaDAO();
		if($_SESSION["perfil"] == "Aluno")
			$ret = $frequenciaDAO->buscarFrequencia($frequencia);
		else 
		{
			echo"erro";
		}
		echo json_encode($ret);
	}
?>