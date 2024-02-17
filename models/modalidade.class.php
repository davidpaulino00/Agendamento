<?php
	class modalidade
	{
		private $id;
		private $descritivo;
		private $professor;
		private $situacao;
		private $faixa;
			
		function __construct($id=null, $descritivo=null, $situacao=null)
		{
			$this->id = $id;
			$this->descritivo = $descritivo;
			$this->situacao = $situacao;
		}
		function getId()
		{
			return $this->id;
		}
		function getDescritivo()
		{
			return $this->descritivo;
		}
		function getSituacao()
		{
			return $this->situacao;
		}
		function getProfessor()
		{
			return $this->professor;
		}
		function getFaixa()
		{
			return $this->faixa;
		}
		function setSituacao($professor)
		{
			$this->professor[]=$professor;
		}
		function setFaixa($faixa)
		{
			$this->faixa[]=$faixa;
		}
		
	}
?>