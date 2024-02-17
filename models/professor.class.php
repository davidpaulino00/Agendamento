<?php
	class professor extends usuario
	{
		private $idprofessor;
		private $curriculo;
		function __construct($idprofessor = null ,$curriculo = null, $idusuario = null, $faixa = null ,$nome = null,$email = null, $senha = null,	$perfil = null,  $sexo =null,$celular = null,$telefone = null, $logradouro = null, $numero =null,$complemento = null,$bairro = null,$cidade = null,$uf = null,$cep = null,$situacao = null, $tipo = null)
		{
			$this->idprofessor = $idprofessor;
			$this->curriculo = $curriculo;
			parent:: __construct($idusuario, $faixa ,		$nome,$email, $senha,	$perfil,  $sexo,$celular ,$telefone,	 $logradouro, $numero,	 $complemento,$bairro,$cidade,$uf,$cep,$situacao, $tipo);				
		}
		function getIdProfessor()
		{
			return $this->idprofessor;
		}
		function getCurriculo()
		{
			return $this->curriculo;
		}
		
		
		
	}//class
?>