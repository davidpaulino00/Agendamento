<?php
	require_once "../models/conexao.class.php";
	require_once "../models/usuario.class.php";
	require_once "../models/usuarioDAO.class.php";
	require_once "cabecalho.php";
	
	$usuario = new usuario($_SESSION["id"]);
	$usuarioDAO = new usuarioDAO();
	$ret = $usuarioDAO->buscarUmUsuario($usuario);
	if($_POST)
	{
		
		$erro = 0;
		if($_POST["nome"] == "")
		{
			echo "<script>alert('Preencha o nome')</script>";
			$erro++;
		}
		if($_POST["email"] == "")
		{
			echo "<script>alert('Preencha o e-mail')</script>";
			$erro++;
		}	
		
		if($erro == 0)
		{
			
			$usuario = new usuario($_SESSION["id"], $_POST["nome"], $_POST["email"]);
			$usuarioDAO = new usuarioDAO();
			$usuarioDAO->alterar($usuario);
			header("location:index.php");
			
		}
	}
?>
		<div class="content">
			<div class="container">
				<h2>Usuário</h2><br><br>
				<form action="#" method="POST">
					<div class="form-group">
						<label>Nome:</label>
						<input type="text" name="nome" value="<?php echo $ret[0]->nome;
						 ?>" required>
					</div>
					<div class="form-group">
						<label>E-mail:</label>
						<input type="email" name="email" value="<?php echo $ret[0]->email;
						 ?>" required>
					</div>
					
					<br><input type="submit" value="Enviar" class="btn btn-lg btn-success">
				</form>
			</div>
		</div>
	</body>
</html>