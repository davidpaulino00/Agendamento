<?php
	class aula_testeDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}
		
		function buscarUmaAula($aula_teste)
		{
			$sql = "SELECT * FROM aula_teste WHERE idaula_teste = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $aula_teste->getId());
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
		public function inserir($aula_teste)
		{
			$sql = "INSERT INTO aula_teste (horario_idhorario, nome, sexo, email, celular, telefone, data_aula, observacao, situacao) VALUES(?,?,?,?,?,?,?,?,?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $aula_teste->getHorario()->getId());
				$stm->bindValue(2, $aula_teste->getNome());
				$stm->bindValue(3, $aula_teste->getSexo());
				$stm->bindValue(4, $aula_teste->getEmail());
				$stm->bindValue(5, $aula_teste->getCelular());
				$stm->bindValue(6, $aula_teste->getTelefone());
				$stm->bindValue(7, $aula_teste->getData_aula());
				$stm->bindValue(8, $aula_teste->getObservacao());
				$stm->bindValue(9, $aula_teste->getSituacao());
				$stm->execute();
				$this->db = null;
				return "Aula Teste agendada com Sucesso";
			}
			catch(Exception $e)
			{
				$this->db = null;
				return "Erro ao Agendar Aula Teste";
			}
			
		}//fim inserir
		function verificarAgenda($aula_teste)
		{
			$sql = "SELECT idaula_teste FROM aula_teste, horario, modalidade WHERE email = ? AND idhorario = horario_idhorario AND idmodalidade = modalidade_idmodalidade AND modalidade_idmodalidade = ? AND (aula_teste.situacao = ? OR data_aula > now())";
			try
			{
			
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $aula_teste->getEmail());
				$stm->bindValue(2, $aula_teste->getHorario()->getModalidade()->getId());
				$stm->bindValue(3, $aula_teste->getSituacao());
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			} 
			
		}//verificar Agendar
		function buscarTodosAlunoAgendado()
		{
			$sql = "SELECT aula_teste.*, horario_inicio,horario_fim,dia_semana, idmodalidade, descritivo FROM aula_teste, horario, modalidade WHERE idhorario = horario_idhorario AND idmodalidade = modalidade_idmodalidade ORDER BY idmodalidade, data_aula, nome";
			try
			{
			
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
		}//buscarTodosAlunoAgendado
		function baixarAulaRealizada($aula_teste)
		{
			
			$sql = "UPDATE aula_teste SET situacao = ? WHERE idaula_teste = ?";
			try
			{
				//prepara a frase
				$stm = $this->db->prepare($sql);
				//substituir os pontos de interrogação pelo conteudo
				$stm->bindValue(1, $aula_teste->getSituacao());
				$stm->bindValue(2, $aula_teste->getId());
				//executar a frase sql no BD
				$stm->execute();
				//fechar a conexão
				$this->db = null;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
	}
?>