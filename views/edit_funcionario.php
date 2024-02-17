	<?php
		require_once "../models/conexao.class.php";
		require_once "../models/usuario.class.php";
		require_once "../models/usuarioDAO.class.php";
		if($_GET)
		{
			$usuario = new usuario($_GET["id"]);
			$usuarioDAO = new usuarioDAO();
			$ret = $usuarioDAO->buscarUmUsuario($usuario);
			
		}
	
		if($_POST)
		{	
			
			$erro = false;
			//verificar o preenchimento dos campos
			
			if(!$erro)
			{
				
				$usuario = new usuario($_POST["idusuario"], null, $_POST["nome"], $_POST["email"], null, $_POST["perfil"], $_POST["sexo"], $_POST["celular"], $_POST["telefone"], $_POST["logradouro"],$_POST["numero"], $_POST["complemento"],$_POST["bairro"],$_POST["cidade"],"SP",$_POST["cep"]);
				
				
				$usuarioDAO = new usuarioDAO();
				$usuarioDAO->alterar($usuario);
				
				header("Location:listarFuncionarios.php");
				
			}
			
		}
		require_once "edit_usuario.php";
	?>
	
  <input type="submit" class="btn btn-success" value="Alterar">
</form>
</div>
</div>
<body>
</html>
