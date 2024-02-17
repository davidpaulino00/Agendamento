<?php
	class horario
	{
		private $id;
		private $hora_inicio;
		private $hora_fim;
		private $dia_semana;
		private $modalidade;
		private $professor;
		private $situacao;
		
		function __construct($id=null,$hora_inicio=null,$hora_fim=null,	$dia_semana=null,$modalidade=null, $professor=null, $situacao = null)
		{
			$this->id = $id;
			$this->hora_inicio = $hora_inicio;
			$this->hora_fim = $hora_fim;
			$this->dia_semana= $dia_semana;
			$this->modalidade = $modalidade;
			$this->professor = $professor;
			$this->situacao = $situacao;
		}
		function getId()
		{
			return $this->id;
		}
		function getHorai()
		{
			return $this->hora_inicio;
		}
		function getHoraf()
		{
			return $this->hora_fim;
		}
		function getDia_semana()
		{
			return $this->dia_semana;
		}
		function getModalidade()
		{
			return $this->modalidade;
		}
		function getProfessor()
		{
			return $this->professor;
		}
		function getSituacao()
		{
			return $this->situacao;
		}
		function setModalidade($modalidade)
		{
			$this->modalidade = $modalidade;
		}
		function setSituacao($situacao)
		{
			$this->situacao = $situacao;
		}
		function setProfessor($professor)
		{
			$this->professor = $professor;
		}

	}
?>