<?php
	class frequencia
	{
		private $id;
		private $data_aula;
		private $presenca;
		private $matricula;
		
		function __construct($id=null, $data_aula=null, $presenca =null, $matricula = null)
		{
			$this->id = $id;
			$this->data_aula = $data_aula;
			$this->presenca = $presenca;
			$this->matricula = $matricula;
			
		}
		function getId()
		{
			return $this->id;
		}
		function getData_aula()
		{
			return $this->data_aula;
		}
		function getPresenca()
		{
			return $this->presenca;
		}
		function getMatricula()
		{
			return $this->matricula;
		}
		function setPresenca($presenca)
		{
			$this->presenca = $presenca;
		}
		function setMatricula($matricula)
		{
			$this->matricula = $matricula;
		}
		
	}
?>