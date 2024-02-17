<?php 
	class professorDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}
		function inserir($professor)
		{
			
			//escrever frase sql para executar a operação no BD
			$sql = "INSERT INTO usuario (nome, email, senha, perfil, sexo, celular, telefone, logradouro, numero, complemento, bairro, cidade, uf, cep, situacao, tipo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			try
			{
				$this->db->beginTransaction();
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $professor->getNome());
				$stm->bindValue(2, $professor->getEmail());
				$stm->bindValue(3, $professor->getSenha());
				$stm->bindValue(4, $professor->getPerfil());
				$stm->bindValue(5, $professor->getSexo());
				$stm->bindValue(6, $professor->getCelular());
				$stm->bindValue(7, $professor->getTelefone());
				$stm->bindValue(8, $professor->getLogradouro());
				$stm->bindValue(9, $professor->getNumero());
				$stm->bindValue(10, $professor->getComplemento());
				$stm->bindValue(11, $professor->getBairro());
				$stm->bindValue(12, $professor->getCidade());
				$stm->bindValue(13, $professor->getUf());
				$stm->bindValue(14, $professor->getCep());
				$stm->bindValue(15, $professor->getSituacao());
				$stm->bindValue(16, $professor->getTipo());
				//executar a frase sql no BD
				$stm->execute();
				$idusuario = $this->db->lastInsertId();
			}
			catch (PDOException $e)
			{
				$this->db = null;
				return "Problema ao cadastrar professor";
			}
			
			$sql = "INSERT INTO professor (usuario_idusuario, curriculo) VALUES(?,?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $idusuario);
				$stm->bindValue(2, $professor->getCurriculo());
				$stm->execute();
				
			}
			catch (PDOException $e)
			{
				$this->db->rollback();
				$this->db = null;
				return "Problema ao cadastrar Professor";
			}
			foreach($professor->getModalidade() as $dado)
			{
				$sql = "INSERT INTO usuario_modalidade (faixa_idfaixa, modalidade_idmodalidade, usuario_idusuario) VALUES(?,?,?)";
				
				try
				{
					$stm = $this->db->prepare($sql);
					$stm->bindValue(1, $dado->getFaixa()[0]->getId());
					$stm->bindValue(2, $dado->getId());
					$stm->bindValue(3, $idusuario);
					$stm->execute();
					
				}
				catch (PDOException $e)
				{
					$this->db->rollback();
					$this->db = null;
					return "Problema ao cadastrar Professor";
				}
			}
			$this->db->commit();
			$this->db = null;
			return "Professor cadastrado com Sucesso";
			
		}//inserir
		
		
		function buscarTodosProfessores()
		{
			$sql = "SELECT professor.*, usuario.* FROM professor, usuario WHERE usuario_idusuario = idusuario";
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
		
		
		function buscarUmProfessor($professor)
		{
			$sql = "SELECT usuario.*, professor.* FROM professor, usuario WHERE idusuario = usuario_idusuario AND idprofessor = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1,$professor->getIdProfessor());
				$ret = $stm->execute();
				$this->db = null;
				if($ret)
				{
					return $stm->fetchAll(PDO::FETCH_OBJ);
				}
			}
			catch ( Exception $e )
			{
				die ($e->getMessage());
			}
		}//buscarUmalunos
		function alterar($professor)
		{
			//var_dump($professor);
			$sql = "UPDATE usuario SET nome = ?, email = ?, perfil = ?, sexo = ?, celular = ?, telefone = ?, logradouro =?, numero = ?, complemento = ?, bairro = ?, cidade = ?, cep = ? WHERE idusuario = ?";
			try
			{
				$this->db->beginTransaction();
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $professor->getNome());
				$stm->bindValue(2, $professor->getEmail());
				$stm->bindValue(3, $professor->getPerfil());
				$stm->bindValue(4, $professor->getSexo());
				$stm->bindValue(5, $professor->getCelular());
				$stm->bindValue(6, $professor->getTelefone());
				$stm->bindValue(7, $professor->getLogradouro());
				$stm->bindValue(8, $professor->getNumero());
				$stm->bindValue(9, $professor->getComplemento());
				$stm->bindValue(10, $professor->getBairro());
				$stm->bindValue(11, $professor->getCidade());
				$stm->bindValue(12, $professor->getCep());
				$stm->bindValue(13, $professor->getIdUsuario());
				//executar a frase sql no BD
				$stm->execute();
				
				
			}
			catch (PDOException $e)
			{
				$this->db = null;
				return "Problema ao Alterar Professor";
			}
			
			$sql = "UPDATE professor SET curriculo = ? WHERE idprofessor = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				
				$stm->bindValue(1, $professor->getCurriculo());
				
				$stm->bindValue(2, $professor->getIdProfessor());
				$stm->execute();
				
			}
			catch (PDOException $e)
			{
				$this->db->rollback();
				$this->db = null;
				return "Problema ao Alterar o professor";
			}
			$sql = "DELETE FROM usuario_modalidade WHERE usuario_idusuario = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $professor->getIdUsuario());
				//executar a frase sql no BD
				$stm->execute();
			}
			catch (PDOException $e)
			{
				$this->db->rollback();
				$this->db = null;
				return "Problema ao Alterar o professor";
			}
			foreach($professor->getModalidade() as $dado)
			{
				$sql = "INSERT INTO usuario_modalidade (faixa_idfaixa, modalidade_idmodalidade, usuario_idusuario) VALUES(?,?,?)";
			
				try
				{
					$stm = $this->db->prepare($sql);
					$stm->bindValue(1, $dado->getFaixa()[0]->getId());
					$stm->bindValue(2, $dado->getId());
					$stm->bindValue(3, $professor->getIdUsuario());
					$stm->execute();
					
				}
				catch (PDOException $e)
				{
					$this->db->rollback();
					$this->db = null;
					return "Problema ao cadastrar Professor";
				}
			}
			$this->db->commit();
			$this->db = null;
			return "Professor Alterado com Sucesso";
		}//alterar
	}//class
?>