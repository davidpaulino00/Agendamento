<?php
	function verificaAutorizacao()
	{
		$acesso = true;
		if(!isset($_SESSION))
			session_start();
			
		if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "Administrador")
		{
			$acesso = false;
		}
		return $acesso;
	}
?>