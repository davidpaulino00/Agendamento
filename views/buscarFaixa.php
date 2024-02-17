<?php
	if($_GET)
	{
		require_once '../models/conexao.class.php';
		require_once '../models/modalidade.class.php';
		require_once '../models/modalidadeDAO.class.php';
		
		$modalidade = new modalidade($_GET["id"]);
		$modalidadeDAO = new modalidadeDAO();
		$ret = $modalidadeDAO->buscarFaixasModalidade($modalidade);
		echo json_encode($ret);
	}
?>