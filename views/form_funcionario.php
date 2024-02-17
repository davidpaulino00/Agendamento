	<?php
	
		if($_POST)
		{	
			$erro = false;
			//verificar o preenchimento dos campos
			if(!$erro)
			{
				require_once "../models/conexao.class.php";
				require_once "../models/usuario.class.php";
				require_once "../models/usuarioDAO.class.php";
				
				$usuario = new usuario(null, null, $_POST["nome"], $_POST["email"], md5($_POST["senha"]), $_POST["perfil"], $_POST["sexo"], $_POST["celular"], $_POST["telefone"], $_POST["logradouro"],$_POST["numero"], $_POST["complemento"],$_POST["bairro"],$_POST["cidade"],"SP",$_POST["cep"], "S", "Funcionário");
								
				$usuarioDAO = new usuarioDAO();
				$usuarioDAO->inserir($usuario);
				header("Location:listarFuncionarios.php");
				
			}
			
		}
		require_once "form_usuario.php";
	?>
	

  <input type="submit" class="btn btn-success" value="Cadastrar">
</form>
</div>
</div>
<body>
</html>
