<?php
	class aluno extends usuario
	{
		private $idaluno;
		private $lesao;
		private $descricao_lesao;
		private $deficiencia;
		private $descricao_deficiencia;
		

		function __construct($idaluno = null ,$lesao = null,$descricao_lesao = null, $deficiencia = null, $descricao_deficiencia= null, $idusuario = null, $faixa = null ,$nome = null,$email = null, $senha = null,	$perfil = null,  $sexo =null,$celular = null,$telefone = null, $logradouro = null, $numero =null,$complemento = null,$bairro = null,$cidade = null,$uf = null,$cep = null,$situacao = null, $tipo = null)
		{
			$this->idaluno = $idaluno;
			$this->lesao = $lesao;
			$this->descricao_lesao = $descricao_lesao;
			$this->deficiencia = $deficiencia;
			$this->descricao_deficiencia = $descricao_deficiencia;
			parent:: __construct($idusuario, $faixa, $nome, $email, $senha,	$perfil, $sexo, $celular , $telefone, $logradouro, $numero,	 $complemento, $bairro, $cidade, $uf, $cep, $situacao, $tipo);				
		}
		function getIdAluno()
		{
			return $this->idaluno;
		}
		function getLesao()
		{
			return $this->lesao;
		}
		function getDescricao_Lesao()
		{
			return $this->descricao_lesao;
		}
		function getDeficiencia()
		{
			return $this->deficiencia;
		}
		function getDescricao_Deficiencia()
		{
			return $this->descricao_deficiencia;
		}
		
		
		
	}//class
?>