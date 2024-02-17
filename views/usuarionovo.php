<?php
	require_once "cabecalho.php";
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
		if($_POST["senha"] == "")
		{
			echo "<script>alert('Preencha a senha')</script>";
			$erro++;
		}
		if($_POST["confirmarSenha"] == "")
		{
			echo "<script>alert('Preencha a confirmação da senha')</script>";
			$erro++;
		}
		if($_POST["senha"] != $_POST["confirmarSenha"])
		{
			echo "<script>alert('Senhas não conferem')</script>";
			$erro++;
		}
		
		if($erro == 0)
		{
			require_once "../models/conexao.class.php";
			require_once "../models/usuario.class.php";
			require_once "../models/usuarioDAO.class.php";
			
			$usuario = new usuario(null, $_POST["nome"], $_POST["email"] ,null, $_POST["senha"]);
			$usuarioDAO = new usuarioDAO();
			$usuarioDAO->inserir($usuario);
			header("location:login.php");
			
		}
	}
?>
		<div class="content">
			<div class="container">
			<link href="estilo.css" rel="stylesheet">
			<div class="box">
				<h2>Cadastro de Usuário</h2><br>
				<form action="#" method="POST">
				
						<label>Nome:</label>
						<input type="text" name="nome" value="<?php if($_POST) 
							echo $_POST['nome'];
						 ?>" required>
					<div class="form-group">
						<label>E-mail:</label>
						<input type="email" name="email" value="<?php if($_POST) 
							echo $_POST['email'];
						 ?>" required>
					</div>
					<div class="form-group">
						<label>Senha:</label>
						<input type="password" name="senha" required>
					</div>
					<div class="form-group">
						<label>Confirmar a Senha:</label>
						<input type="password" name="confirmarSenha" required>
					</div>
					
				</select>
					<br>
					<br><input type="submit" value="Enviar" class="btn btn-lg btn-success">
				</div>
					
					
				</form>
			</div>
		</div>
	</body>
</html>