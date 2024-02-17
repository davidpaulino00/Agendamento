<?php
	class usuario
	{
		private $idusuario;
		private $faixa;
		private $nome;
		private $email;
		private $senha;
		private $perfil;
		private $sexo;
		private $celular;
		private $telefone;
		private $logradouro;
		private $numero;
		private $complemento;
		private $bairro;
		private $cidade;
		private $uf;
		private $cep;
		private $situacao;
		private $tipo;
		private $modalidade;
		
		function __construct($idusuario = null ,$faixa = null ,	$nome = null,$email = null, $senha = null,$perfil = null,  $sexo = null,$celular = null,$telefone = null,	 $logradouro = null, $numero = null,	 $complemento = null,$bairro = null,$cidade = null,$uf = null,$cep = null,$situacao = null, $tipo = null)
		{
			$this->idusuario = $idusuario;
			$this->faixa = $faixa;
			$this->nome = $nome;
			$this->email = $email;
			$this->senha = $senha;
			$this->perfil = $perfil;
			$this->sexo = $sexo;
			$this->celular = $celular;
			$this->telefone = $telefone;
			$this->logradouro = $logradouro;
			$this->numero = $numero;
			$this->complemento = $complemento;
			$this->bairro = $bairro;
			$this->cidade = $cidade;
			$this->uf = $uf;
			$this->cep = $cep;
			$this->situacao = $situacao;
			$this->tipo = $tipo;
		}
		function getIdUsuario()
		{
			return $this->idusuario;
		}
		function getFaixa()
		{
			return $this->faixa;
		}
		function setFaixa($faixa)
		{
			$this->faixa[] = $faixa;
		}
		
		function getNome()
		{
			return $this->nome;
		}
		function getEmail()
		{
			return $this->email;
		}
		function getSenha()
		{
			return $this->senha;
		}
		function getPerfil()
		{
			return $this->perfil;
		}
		function getSexo()
		{
			return $this->sexo;
		}
		function getCelular()
		{
			return $this->celular;
		}
		function getTelefone()
		{
			return $this->telefone;
		}
		function getLogradouro()
		{
			return $this->logradouro;
		}
		function getNumero()
		{
			return $this->numero;
		}
		function getComplemento()
		{
			return $this->complemento;
		}
		function getBairro()
		{
			return $this->bairro;
		}
		function getCidade()
		{
			return $this->cidade;
		}
		function getUf()
		{
			return $this->uf;
		}
		function getCep()
		{
			return $this->cep;
		}
		function getSituacao()
		{
			return $this->situacao;
		}
		function setSituacao($situacao)
		{
			$this->situacao = $situacao;
		}
		function getTipo()
		{
			return $this->tipo;
		}
		function setTipo($tipo)
		{
			$this->tipo = $tipo;
		}
		function getModalidade()
		{
			return $this->modalidade;
		}
		function setModalidade($modalidade)
		{
			$this->modalidade[] = $modalidade;
		}
		
	}//class
?>