<?php
	class matricula
	{
		private $id;
		private $horario;
		private $aluno;
		private $modalidade;
		private $data_maticula;
		private $data_validade;
		private $situacao;
			
		function __construct($id=null, $horario=null,$aluno=null, $modalidade = null,$data_matricula=null,$data_validade=null,$situacao=null)
		{
			$this->id = $id;
			$this->horario = $horario;
			$this->aluno = $aluno;
			$this->modalidade = $modalidade;
			$this->data_matricula = $data_matricula;
			$this->data_validade = $data_validade;
			$this->situacao = $situacao;
	
		}
		function getId()
		{
			return $this->id;
		}
		function getHorario()
		{
			return $this->horario;
		}
		function getAluno()
		{
			return $this->aluno;
		}
		function getData_Matricula()
		{
			return $this->data_matricula;
		}
		function getData_Validade()
		{
			return $this->data_validade;
		}
		function getSituacao()
		{
			return $this->situacao;
		}
		function getModalidade()
		{
			return $this->modalidade;
		}
		function setModalidade($modalidade)
		{
			$this->modalidade = $modalidade;
		}
		function setHorario($horario)
		{
			$this->horario = $horario;
		}
	}
?>