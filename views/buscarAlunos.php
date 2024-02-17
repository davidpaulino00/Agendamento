<?php
	if($_GET)
	{
		
		require_once '../models/conexao.class.php';
		require_once '../models/horario.class.php';
		require_once '../models/modalidade.class.php';
		require_once '../models/matriculaDAO.class.php';
		require_once '../models/matricula.class.php';
		require_once '../models/frequencia.class.php';
		require_once '../models/frequenciaDAO.class.php';
		
		//verificar se já tem chamada feita
		$modalidade = new modalidade($_GET["idm"]);
		$horario = new horario($_GET["idh"]);
		$matricula = new matricula(null, $horario, null, $modalidade);
		$frequencia = new frequencia(null, $_GET["dataaula"], null, $matricula);
		
		$frequenciaDAO = new frequenciaDAO();
		$retorno = $frequenciaDAO->verificarChamada($frequencia);
		
		
		if(is_array($retorno) && count($retorno) > 0)
		{
			//busca todos os alunos e já foi feita a chamada
			echo json_encode($retorno);
			
		}
		else
		{
				
			//busca todos os alunos e ainda não foi feita a chamada
			$modalidade = new modalidade($_GET["idm"]);
			$horario = new horario($_GET["idh"]);
			$matricula = new matricula(null, $horario, null, $modalidade, null, null, "S");
			$matriculaDAO = new matriculaDAO();
			$ret = $matriculaDAO->buscarAlunosMatriculados($matricula);
			echo json_encode($ret);
		}
	}
?>