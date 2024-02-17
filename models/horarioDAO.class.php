<?php
	class horarioDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}
		function buscarTodosHorarios()
		{
			$sql = "SELECT  FROM horario";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}//buscarTodos
		function buscarHorariosModalidade($horario)
		{
			$sql = "SELECT * FROM horario WHERE  modalidade_idmodalidade = ? AND situacao = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $horario->getModalidade()->getId());
				$stm->bindValue(2, $horario->getSituacao());
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die("problema1");
			}
		}//buscarTodos
		function buscarUmHorario($horario)
		{
			$sql = "SELECT * FROM horario WHERE idhorario = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $horario->getId());
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}//buscarTodos
		function buscarHorarios()
		{
			$sql = "SELECT horario.*, descritivo, nome FROM horario, professor, usuario, modalidade WHERE modalidade_idmodalidade = idmodalidade AND professor_idprofessor = idprofessor AND usuario_idusuario = idusuario AND horario.situacao = 'S' Order By dia_semana, horario_inicio";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die("Problema2");
			}
		}
		function buscarTodosHorariosModalidade($horario)
		{
			$sql = "SELECT horario.*, descritivo, nome FROM horario, modalidade, usuario, professor  WHERE modalidade_idmodalidade = idmodalidade AND professor_idprofessor = idprofessor AND usuario_idusuario = idusuario AND modalidade_idmodalidade = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $horario->getModalidade()->getId());
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				//die($e->getMessage());
				die("problema3");
			}
		}//buscarTodos
		function inserir($horario)
		{
			//var_dump($horario);
			$sql = "INSERT INTO horario (modalidade_idmodalidade, professor_idprofessor, horario_inicio, horario_fim, dia_semana, situacao) VALUES(?,?,?,?,?,?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $horario->getModalidade()->getId());
				$stm->bindValue(2, $horario->getProfessor()->getIdprofessor());
				$stm->bindValue(3, $horario->getHorai());
				$stm->bindValue(4, $horario->getHoraf());
				$stm->bindValue(5, $horario->getDia_semana());
				$stm->bindValue(6, $horario->getSituacao());
				
				
				$stm->execute();
				$this->db = null;
				return "Horário inserido com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Inserir Horário da Modalidade";
			}
		}
		function alterar($horario)
		{
			$sql = "UPDATE horario SET professor_idprofessor = ?, horario_inicio = ? , horario_fim = ?, dia_semana = ? WHERE idhorario = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $horario->getProfessor()->getIdProfessor());
				$stm->bindValue(2, $horario->getHorai());
				$stm->bindValue(3, $horario->getHoraf());
				$stm->bindValue(4, $horario->getDia_semana());
				$stm->bindValue(5, $horario->getId());
				$stm->execute();
				$this->db = null;
				return "Horário da Modalidade Alterado com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Inserir Modalidade";
			}
		}
		function alterarSituacao($horario)
		{
			$sql = "UPDATE horario SET situacao = ? WHERE idhorario = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $horario->getSituacao());
				$stm->bindValue(2, $horario->getId());
				$stm->execute();
				$this->db = null;
				return "Situação do Horário da Modalidade Alterada com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Alterar a situação do horário da modalidade";
			}
		}
		function buscarHorariosModalidadeProfessor($horario)
		{
			
			$sql = "SELECT * FROM horario, usuario, professor WHERE  professor_idprofessor = idprofessor AND usuario_idusuario = idusuario AND modalidade_idmodalidade = ? AND horario.situacao = ? AND idusuario = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $horario->getModalidade()->getId());
				$stm->bindValue(2, $horario->getSituacao());
				$stm->bindValue(3, $horario->getProfessor()->getIdUsuario());
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}//buscarTodos
	}
?>