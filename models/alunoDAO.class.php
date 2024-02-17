<?php 
	class alunoDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}
		function inserir($aluno)
		{
			
			//escrever frase sql para executar a operação no BD
			$sql = "INSERT INTO usuario (nome, email, senha, perfil, sexo, celular, telefone, logradouro, numero, complemento, bairro, cidade, uf, cep, situacao, tipo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			try
			{
				$this->db->beginTransaction();
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $aluno->getNome());
				$stm->bindValue(2, $aluno->getEmail());
				$stm->bindValue(3, $aluno->getSenha());
				$stm->bindValue(4, $aluno->getPerfil());
				$stm->bindValue(5, $aluno->getSexo());
				$stm->bindValue(6, $aluno->getCelular());
				$stm->bindValue(7, $aluno->getTelefone());
				$stm->bindValue(8, $aluno->getLogradouro());
				$stm->bindValue(9, $aluno->getNumero());
				$stm->bindValue(10, $aluno->getComplemento());
				$stm->bindValue(11, $aluno->getBairro());
				$stm->bindValue(12, $aluno->getCidade());
				$stm->bindValue(13, $aluno->getUf());
				$stm->bindValue(14, $aluno->getCep());
				$stm->bindValue(15, $aluno->getSituacao());
				$stm->bindValue(16, $aluno->getTipo());
				//executar a frase sql no BD
				$stm->execute();
				$idusuario = $this->db->lastInsertId();
			}
			catch (PDOException $e)
			{
				$this->db = null;
				return "Problema ao cadastrar aluno";
			}
			
			$sql = "INSERT INTO aluno (usuario_idusuario, lesao, descricao_lesao, deficiencia, descricao_deficiencia) VALUES(?,?,?,?,?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $idusuario);
				$stm->bindValue(2, $aluno->getLesao());
				$stm->bindValue(3, $aluno->getDescricao_Lesao());
				$stm->bindValue(4, $aluno->getDeficiencia());
				$stm->bindValue(5, $aluno->getDescricao_Deficiencia());
				$stm->execute();
				$this->db->commit();
				$this->db = null;
				return "Aluno cadastrado com Sucesso";
			}
			catch (PDOException $e)
			{
				$this->db->rollback();
				$this->db = null;
				return "Problema ao cadastrar aluno";
			}
			
			
			
		}//inserir
		
		
		function buscarTodosAlunos()
		{
			$sql = "SELECT aluno.*, usuario.* FROM aluno, usuario WHERE usuario_idusuario = idusuario";
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
		function buscarUmAluno($alunos)
		{
			$sql = "SELECT usuario.*, aluno.* FROM aluno, usuario WHERE idusuario = usuario_idusuario AND idaluno = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1,$alunos->getIdAluno());
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
		function buscarUmAlunoFaixa($aluno)
		{
			$sql = "SELECT aluno.usuario_idusuario, usuario_modalidade.faixa_idfaixa FROM aluno, usuario, usuario_modalidade WHERE usuario.idusuario = aluno.usuario_idusuario AND usuario_modalidade.usuario_idusuario = usuario.idusuario AND idaluno = ? AND usuario_modalidade.modalidade_idmodalidade = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1,$aluno->getIdAluno());
				$stm->bindValue(2,$aluno->getModalidade()[0]->getId());
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
		}//buscarUmAlunoFaixa
		function alterar($aluno)
		{
			echo "<pre>";
			var_dump($aluno);
			echo "</pre>";
			$sql = "UPDATE usuario SET nome = ?, email = ?, sexo =?, celular = ?, telefone = ?, logradouro =?, numero = ?, complemento = ?, bairro = ?, cidade = ?, uf = ?, cep = ? WHERE idusuario = ?";
			try
			{
				$this->db->beginTransaction();
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $aluno->getNome());
				$stm->bindValue(2, $aluno->getEmail());
				$stm->bindValue(3, $aluno->getSexo());
				$stm->bindValue(4, $aluno->getCelular());
				$stm->bindValue(5, $aluno->getTelefone());
				$stm->bindValue(6, $aluno->getLogradouro());
				$stm->bindValue(7, $aluno->getNumero());
				$stm->bindValue(8, $aluno->getComplemento());
				$stm->bindValue(9, $aluno->getBairro());
				$stm->bindValue(10, $aluno->getCidade());
				$stm->bindValue(11, $aluno->getUf());
				$stm->bindValue(12, $aluno->getCep());
				$stm->bindValue(13, $aluno->getIdUsuario());
				//executar a frase sql no BD
				$stm->execute();
				
				
			}
			catch (PDOException $e)
			{
				$this->db = null;
				return "Problema ao Alterar aluno";
			}
			
			$sql = "UPDATE aluno SET lesao = ?, descricao_lesao = ?, deficiencia = ?, descricao_deficiencia = ? WHERE idaluno = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				
				$stm->bindValue(1, $aluno->getLesao());
				$stm->bindValue(2, $aluno->getDescricao_Lesao());
				$stm->bindValue(3, $aluno->getDeficiencia());
				$stm->bindValue(4, $aluno->getDescricao_Deficiencia());
				$stm->bindValue(5, $aluno->getIdAluno());
				$stm->execute();
				$this->db->commit();
				$this->db = null;
				return "Aluno Alterado com Sucesso";
			}
			catch (PDOException $e)
			{
				$this->db->rollback();
				$this->db = null;
				return "Problema ao Alterar o aluno";
			}
		}//alterar
		
}//class
?>