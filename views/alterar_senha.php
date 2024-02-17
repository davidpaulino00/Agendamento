<?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/usuario.class.php";
	require_once "../models/usuarioDAO.class.php";
	
	if($_POST)
	{
		$erro =0;
		if($_POST["senha"] == "")
		{
			echo "<script>alert('Nova Senha deve ser preenchida');</script>";
			$erro++;
		}
		if($_POST["confirma"] == "")
		{
			echo "<script>alert('Confirma a Senha deve ser preenchida');</script>";
			$erro++;
		}
		if($_POST["senha"] !== $_POST["confirma"])
		{
			echo "<script>alert('Senhas não conferem');</script>";
			$erro++;
		}	
	
		if($erro == 0)
		{
			
			$usuario = new usuario($_SESSION["id"], null,null, null,md5($_POST["senha"]));
			$usuarioDAO = new usuarioDAO();
			$retorno = $usuarioDAO->atualizarSenha($usuario);
			
				header("Location:home.php");
		}
	}//ifpost
?>
<div class="content">
	<div class="container">
			<div class = "form-group">
					<div class="row justify-content-center align-items-center">
			<h2>Trocar Senha</h2>
			</div><br><br>
		<form action="#" method="POST">
			
			<div class="box">
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="senha" class="col-sm-2 col-form-label col-form-label-lg">Nova Senha:</label>
						<div class="col-sm-6">
							<input type="password" name="senha" required class="form-control form-control-lg" id="senha" placeholder="Nova Senha">
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
						<label class="col-sm-2 col-form-label col-form-label-lg">Confirma Senha:</label>
						<div class="col-sm-6">
						<input type="password" name="confirma" required class="form-control form-control-lg" id="confirma" placeholder="Digite novamente a nova senha">
						</div>
					</div>
				</div>
				<div class="row justify-content-center align-items-center">
					<input type="submit" class = "btn btn-lg btn-success col-sm-2" value = "Alterar">
				</div>
			</div>
		</form>
	</div>
</div>
	
	</body>
</html>