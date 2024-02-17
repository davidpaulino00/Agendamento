<?php
	class faixaDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}
		function buscarTodosFaixa()
		{
			$sql = "SELECT * FROM faixa";
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
		function buscarFaixa($faixa)
		{
			
			$sql =  "SELECT *  FROM faixa WHERE modalidade_idmodalidade = ? order by sequencia";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm ->bindValue(1, $faixa->getModalidade()->getId());
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
		function buscarUmaFaixa($faixa)
		{
			$sql = "SELECT * FROM faixa WHERE idfaixa = ? ";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $faixa->getId());
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
		function verificarFaixa($faixa)
		{
			$sql = "SELECT * FROM faixa WHERE descritivo = ? AND modalidade_idmodalidade = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $faixa->getDescritivo());
				$stm->bindValue(2, $faixa->getModalidade()->getId());
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
		function inserir($faixa)
		{
			
			$sql = "INSERT INTO faixa (modalidade_idmodalidade, descritivo, sequencia) VALUES(?,?,?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $faixa->getModalidade()->getId());
				$stm->bindValue(2, $faixa->getDescritivo());
				$stm->bindValue(3, $faixa->getSequencia());

				
				
				
				$stm->execute();
				$this->db = null;
				return "Faixa inserido com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Inserir Faixa da Modalidade";
			}
		}
	   function alterar($faixa)
		{
			$sql = "UPDATE faixa SET descritivo = ? , sequencia= ? WHERE idfaixa = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $faixa->getDescritivo());
				$stm->bindValue(2, $faixa->getSequencia());
				$stm->bindValue(3, $faixa->getId());
				
				
				
				$stm->execute();
				$this->db = null;
				return "Faixa Alterado com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Inserir faixa";
			}
		}
	}
	
?>