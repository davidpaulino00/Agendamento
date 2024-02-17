<?php
	class matriculaDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}
		
		function buscarMatriculasAluno($matricula)
		{
			$sql = "SELECT matricula.*, usuario.nome, modalidade.descritivo, horario.horario_inicio, horario.horario_fim, dia_semana FROM matricula, usuario, aluno, horario, modalidade WHERE idaluno = aluno_idaluno AND idusuario = usuario_idusuario AND horario_idhorario = idhorario AND matricula.modalidade_idmodalidade = idmodalidade AND aluno_idaluno = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $matricula->getAluno()->getIdaluno());
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			} 
		}//buscarUmFaixa
		function buscarTodasModalidades()
		{
			$sql = "SELECT DISTINCT idmodalidade, descritivo FROM modalidade, horario WHERE idmodalidade = modalidade_idmodalidade";
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
		}//buscarTodasModalidades
		function buscarUmaMatricula($matricula)
		{
			$sql = "SELECT matricula.*, nome, descritivo FROM matricula, modalidade, aluno, usuario WHERE usuario_idusuario = idusuario 
			AND modalidade_idmodalidade = idmodalidade  AND idaluno = aluno_idaluno AND idmatricula = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $matricula->getId());
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			} 
		}//buscarModalidades
		function inserir($matricula)
		{
			
			$sql = "INSERT INTO matricula (modalidade_idmodalidade, horario_idhorario, aluno_idaluno, data_matricula, data_validade, situacao) VALUES(?, ?, ?, ?, ?, ?)";
			try
			{
				$this->db->beginTransaction();
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $matricula->getModalidade()->getId());
				$stm->bindValue(2, $matricula->getHorario()->getId());
				$stm->bindValue(3, $matricula->getAluno()->getIdaluno());
				$stm->bindValue(4, $matricula->getData_Matricula());
				$stm->bindValue(5, $matricula->getData_Validade());
				$stm->bindValue(6, $matricula->getSituacao());
				$stm->execute();
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Inserir Matrícula";
			}
			$sql = "INSERT INTO usuario_modalidade (faixa_idfaixa, modalidade_idmodalidade, usuario_idusuario) VALUES(?,?,?)";
				
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $matricula->getModalidade()->getFaixa()[0]->getId());
				$stm->bindValue(2, $matricula->getModalidade()->getId());
				$stm->bindValue(3, $matricula->getAluno()->getIdUsuario());
				$stm->execute();
				$this->db->commit();
				$this->db = null;
				return "Matrícula cadastrada com Sucesso";
				
			}
			catch (PDOException $e)
			{
				$this->db->rollback();
				$this->db = null;
				return "Problema ao cadastrar Matrícula";
			}
		}
		function verificarMatricula($matricula)
		{
			$sql = "SELECT matricula.* FROM matricula  WHERE aluno_idaluno = ? AND data_validade > now() AND modalidade_idmodalidade = ? AND situacao = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $matricula->getAluno()->getIdaluno());
				$stm->bindValue(2, $matricula->getModalidade()->getId());
				$stm->bindValue(3, $matricula->getSituacao());
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			} 
		}
		
		function alterar($matricula)
		{
			//var_dump($matricula);
			//die();
			$sql = "UPDATE matricula SET horario_idhorario = ?, data_matricula = ?, data_validade = ? WHERE idmatricula = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $matricula->getHorario()->getId());
				$stm->bindValue(2, $matricula->getData_Matricula());
				$stm->bindValue(3, $matricula->getData_Validade());
				$stm->bindValue(4, $matricula->getId());
				$stm->execute();
				
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Alterar a Matrícula";
			}
						
			$sql = "UPDATE usuario_modalidade SET faixa_idfaixa = ? WHERE modalidade_idmodalidade = ? AND usuario_idusuario = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $matricula->getModalidade()->getFaixa()[0]->getId());
				$stm->bindValue(2, $matricula->getModalidade()->getId());
				$stm->bindValue(3, $matricula->getAluno()->getIdUsuario());
				
				$stm->execute();
				$this->db = null;
				return "Matrícula Alterada com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Alterar a Matrícula";
			}
		}
		function alterarSituacao($matricula)
		{
			$sql = "UPDATE matricula SET situacao = ? WHERE idmatricula = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $matricula->getSituacao());
				$stm->bindValue(2, $matricula->getId());
				$stm->execute();
				$this->db = null;
				return "Situação da Matrícula Alterada com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Alterar a Situação da Matrícula";
			}
		}
		function buscarAlunosMatriculados($matricula)
		{
			$sql = "SELECT usuario.nome, matricula.idmatricula  FROM matricula, usuario, aluno  WHERE aluno_idaluno = idaluno AND usuario_idusuario = idusuario AND data_validade > now() AND modalidade_idmodalidade = ? AND horario_idhorario = ? AND matricula.situacao = ? AND usuario.situacao = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				
				$stm->bindValue(1, $matricula->getModalidade()->getId());
				$stm->bindValue(2, $matricula->getHorario()->getId());
				$stm->bindValue(3, $matricula->getSituacao());
				$stm->bindValue(4, "S");
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			} 
		}
	}
?>