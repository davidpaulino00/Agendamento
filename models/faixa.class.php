<?php
	class faixa
	{
		private $id;
		private $descritivo;
		private $sequencia;
		private $modalidade;
		
		
		
		function __construct($id=null, $descritivo=null, $sequencia=null, $modalidade=null)
		{
			$this->id = $id;
			$this->descritivo = $descritivo;
			$this->sequencia = $sequencia;
			$this->modalidade = $modalidade;
			
			
		}
		function getId()
		{
			return $this->id;
		}
		function getDescritivo()
		{
			return $this->descritivo;
		}
		function getSequencia()
		{
			return $this->sequencia;
		}
		function getModalidade()
		{
			return $this->modalidade;
		}
		function setId($id)
		{
			$this->id = $id;
		}
	}
?>