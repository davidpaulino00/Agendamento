<?php
	class modalidadeDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}
		
		
		function buscarUmaModalidade($modalidade)
		{
			$sql = "SELECT * FROM modalidade WHERE idmodalidade = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $modalidade->getId());
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
		function buscarModalidades()
		{
			$sql = "SELECT * FROM modalidade";
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
		}//buscarModalidades
		function inserir($modalidade)
		{
			$sql = "INSERT INTO modalidade (descritivo, situacao) VALUES(?,?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $modalidade->getDescritivo());
				$stm->bindValue(2, $modalidade->getSituacao());
				$stm->execute();
				$this->db = null;
				return "Modalidade inserida com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Inserir Modalidade";
			}
		}
		function verificarModalidade($modalidade)
		{
			$sql = "SELECT * FROM modalidade WHERE descritivo = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $modalidade->getDescritivo());
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
		function alterar($modalidade)
		{
			$sql = "UPDATE modalidade SET descritivo = ? WHERE idmodalidade = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $modalidade->getDescritivo());
				$stm->bindValue(2, $modalidade->getId());
				$stm->execute();
				$this->db = null;
				return "Modalidade Alterada com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Inserir Modalidade";
			}
		}
		function alterarSituacao($modalidade)
		{
			$sql = "UPDATE modalidade SET situacao = ? WHERE idmodalidade = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $modalidade->getSituacao());
				$stm->bindValue(2, $modalidade->getId());
				$stm->execute();
				$this->db = null;
				return "Modalidade Alterada com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Inserir Modalidade";
			}
		}
		function buscarFaixasModalidade($modalidade)
		{
			$sql = "SELECT faixa.* FROM modalidade, faixa WHERE idmodalidade = modalidade_idmodalidade AND idmodalidade = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $modalidade->getId());
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
		function buscarTodasModalidadesProfessor($professor)
		{
			$sql = "SELECT DISTINCT idmodalidade, descritivo FROM modalidade, horario, usuario, professor WHERE idmodalidade = modalidade_idmodalidade AND professor_idprofessor = idprofessor AND usuario_idusuario = idusuario AND idusuario = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $professor->getIdUsuario());
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
	}
?>