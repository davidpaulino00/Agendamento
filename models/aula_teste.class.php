<?php
	class aula_teste
	{
		private $id;
		private $nome;
		private $sexo;
		private $horario;
		private $celular;
		private $telefone;
		private $email;
		private $data_aula;
		private $observacao;
		private $situacao;
		
		
		
		function __construct($id=null, $nome=null, $sexo=null, $horario=null,
		$celular=null,$telefone=null,$email=null,$data_aula = null, $observacao=null, $situacao=false)
		{
			$this->id = $id;
			$this->nome = $nome;
			$this->sexo = $sexo;
			$this->horario = $horario;
			$this->celular = $celular;
			$this->telefone = $telefone;
			$this->email = $email;
			$this->data_aula = $data_aula;
			$this->observacao = $observacao;
			$this->situacao = $situacao;
		}
		function getId()
		{
			return $this->id;
		}
		function getNome()
		{
			return $this->nome;
		}
		function getSexo()
		{
			return $this->sexo;
		}
		function getHorario()
		{
			return $this->horario;
		}
		function getCelular()
		{
			return $this->celular;
		}
		function getTelefone()
		{
			return $this->telefone;
		}
		function getEmail()
		{
			return $this->email;
		}
		function getData_aula()
		{
			return $this->data_aula;
		}
		function getObservacao()
		{
			return $this->observacao;
		}
		function getSituacao()
		{
			return $this->situacao;
		}
	}
?>