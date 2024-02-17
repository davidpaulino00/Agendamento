<?php 
	class usuarioDAO extends conexao
	{
		function __construct()
		{
			parent:: __construct();
		}
		
		function autenticacao($usuario)
		{ 
			$sql = "SELECT idusuario, nome, perfil FROM usuario WHERE email = ? AND senha = ? AND situacao = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $usuario->getEmail());
				$stm->bindValue(2, $usuario->getSenha());
				$stm->bindValue(3, $usuario->getSituacao());
				//executar a frase sql no BD
				$stm->execute();
				//fechamos a conexao
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		function atualizarSenha($usuario)
		{
			$sql = "UPDATE usuario SET senha=? WHERE idusuario = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario->getSenha());
				$stm->bindValue(2, $usuario->getIdUsuario());
				$stm->execute();
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}
			
		}
		function atualizarSituacao($usuario)
		{
			$sql = "UPDATE usuario SET situacao=? WHERE idusuario = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario->getSituacao());
				$stm->bindValue(2, $usuario->getIdUsuario());
				$stm->execute();
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}
		}
		function buscarTodosFuncionarios($usuario)
		{ 
			$sql = "SELECT idusuario, nome, telefone, celular, email, tipo, situacao FROM usuario WHERE tipo = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $usuario->getTipo());
				
				//executar a frase sql no BD
				$stm->execute();
				//fechamos a conexao
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		function inserir($usuario)
		{
			$sql = "INSERT INTO usuario (nome, email, senha, perfil, sexo, celular, telefone, logradouro, numero, complemento, bairro, cidade, uf, cep, situacao, tipo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			try
			{
				
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $usuario->getNome());
				$stm->bindValue(2, $usuario->getEmail());
				$stm->bindValue(3, $usuario->getSenha());
				$stm->bindValue(4, $usuario->getPerfil());
				$stm->bindValue(5, $usuario->getSexo());
				$stm->bindValue(6, $usuario->getCelular());
				$stm->bindValue(7, $usuario->getTelefone());
				$stm->bindValue(8, $usuario->getLogradouro());
				$stm->bindValue(9, $usuario->getNumero());
				$stm->bindValue(10, $usuario->getComplemento());
				$stm->bindValue(11, $usuario->getBairro());
				$stm->bindValue(12, $usuario->getCidade());
				$stm->bindValue(13, $usuario->getUf());
				$stm->bindValue(14, $usuario->getCep());
				$stm->bindValue(15, $usuario->getSituacao());
				$stm->bindValue(16, $usuario->getTipo());
				//executar a frase sql no BD
				$stm->execute();
				$this->db = null;
			}
			catch (PDOException $e)
			{
				$this->db = null;
				return "Problema ao cadastrar Funcionário";
			}
		}
		function buscarUmUsuario($usuario)
		{ 
			$sql = "SELECT * FROM usuario WHERE idusuario = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $usuario->getIdUsuario());
				
				//executar a frase sql no BD
				$stm->execute();
				//fechamos a conexao
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		function alterar($usuario)
		{
			$sql = "UPDATE usuario SET nome = ?, email = ?, perfil = ? , sexo =?, celular = ?, telefone = ?, logradouro =?, numero = ?, complemento = ?, bairro = ?, cidade = ?, cep = ? WHERE idusuario = ?";
			try
			{
				
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $usuario->getNome());
				$stm->bindValue(2, $usuario->getEmail());
				$stm->bindValue(3, $usuario->getPerfil());
				$stm->bindValue(4, $usuario->getSexo());
				$stm->bindValue(5, $usuario->getCelular());
				$stm->bindValue(6, $usuario->getTelefone());
				$stm->bindValue(7, $usuario->getLogradouro());
				$stm->bindValue(8, $usuario->getNumero());
				$stm->bindValue(9, $usuario->getComplemento());
				$stm->bindValue(10, $usuario->getBairro());
				$stm->bindValue(11, $usuario->getCidade());
				$stm->bindValue(12, $usuario->getCep());
				$stm->bindValue(13, $usuario->getIdUsuario());
				
				//executar a frase sql no BD
				$stm->execute();
				$this->db = null;
			}
			catch (PDOException $e)
			{
				$this->db = null;
				return "Problema ao Alterar Funcionário";
			}
		}
		function buscarTodosUsuariosModalidade($usuario)
		{
			
			$sql = "SELECT professor.*, usuario.* FROM professor, usuario, usuario_modalidade  WHERE professor.usuario_idusuario = idusuario AND usuario_modalidade.usuario_idusuario = idusuario AND modalidade_idmodalidade = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario->getModalidade()[0]->getId());
				
				$stm->execute();
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				//die($e->getMessage());
				die("Problema");
			}
		}//buscarTodos
		function buscarModalidadesUmUsuario($usuario)
		{
			$sql = "SELECT * FROM usuario_modalidade WHERE usuario_idusuario = ?";
			try
			{
				//preparando a frase SQL
				$stm = $this->db->prepare($sql);
				//substituindo os pontos de interrogação pelo conteudo do objeto usuario
				$stm->bindValue(1, $usuario->getIdUsuario());
				
				//executar a frase sql no BD
				$stm->execute();
				//fechamos a conexao
				$resultado = $stm->fetchAll(PDO::FETCH_OBJ);
				$this->db = null;
				return $resultado;
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
	}//class
?>