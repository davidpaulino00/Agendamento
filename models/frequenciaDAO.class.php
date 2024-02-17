<?php
	class frequenciaDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}
		function buscarFrequenciaModalidade($aluno)
		{
			$sql = "SELECT descritivo, data_aula, presenca FROM  frequencia, modalidade, matricula, aluno, usuario WHERE idusuario = usuario_idusuario AND idaluno = aluno_idaluno AND idmodalidade = modalidade_idmodalidade AND idmatricula = matricula_idmatricula AND idusuario =?  ORDER BY descritivo, data_aula desc";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $aluno->getIdusuario());
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
		
		function inserir($frequencia)
		{
			
			$sql = "INSERT INTO frequencia (matricula_idmatricula, data_aula, presenca) VALUES(?,?,?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $frequencia->getMatricula()->getId());
				$stm->bindValue(2, $frequencia->getData_aula());
				$stm->bindValue(3, $frequencia->getPresenca());
				$stm->execute();
				$this->db = null;
				return "Frequência inserida com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Inserir Frequência";
			}
		}
		function verificarChamada($frequencia)
		{
			
			$sql = "SELECT frequencia.*, usuario.nome, matricula.idmatricula FROM frequencia, matricula, aluno, usuario WHERE idmatricula = matricula_idmatricula AND aluno_idaluno = idaluno AND usuario_idusuario = idusuario AND data_aula = ? AND modalidade_idmodalidade = ? AND horario_idhorario = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $frequencia->getData_aula());
				$stm->bindValue(2, $frequencia->getMatricula()->getModalidade()->getId());
				$stm->bindValue(3, $frequencia->getMatricula()->getHorario()->getId());
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao verificar Frequência";
			}
		}
		function excluir($frequencia)
		{
			
			$sql = "DELETE FROM frequencia WHERE matricula_idmatricula = ? AND data_aula = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $frequencia->getMatricula()->getId());
				$stm->bindValue(2, $frequencia->getData_aula());
				
				$stm->execute();
				//não fechar a conexao
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Excluir Frequência";
			}
		}
	}
?>