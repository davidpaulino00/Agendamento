<?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/usuario.class.php";
	require_once "../models/usuarioDAO.class.php";
	
	if($_POST)
	{
		$erro =0;
		if($_POST["email"] == "")
		{
			echo "<script>alert('Usuário deve ser preenchido');</script>";
			$erro++;
		}
		if($_POST["senha"] == "")
		{
			echo "<script>alert('Senha deve ser preenchida');</script>";
			$erro++;
		}
		if($erro == 0)
		{
			//autenticar o usuário
			$usuario = new usuario(null, null,null, $_POST["email"],md5($_POST["senha"]));
			$usuario->setSituacao("S");
			$usuarioDAO = new usuarioDAO();
			$retorno = $usuarioDAO->autenticacao($usuario);
			
			if(count($retorno) > 0)
			{
				//guardar os dados do usuário na sessão
				if(!isset($_SESSION))
				{
					session_start();
				}
				$_SESSION["id"] = $retorno[0]->idusuario;
				$_SESSION["nome"] = $retorno[0]->nome;
				$_SESSION["perfil"] = $retorno[0]->perfil;
				header("Location:home.php");
			}
			else
			{
				//credenciais erradas
				echo "<script>alert('Usuário/Senha não conferem');</script>";
			}
			
			
			
		}
	}//ifpost
?>
<div class="content">
	<div class="container">
			
		<form action="#" method="POST">
			<div class="row justify-content-center align-items-center">	
				<img src="../imagens/usuario1.png">
			</div><br><br>
			<div class="box">
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="usuario" class="col-sm-2 col-form-label col-form-label-lg">Usuário:</label>
						<div class="col-sm-6">
							<input type="email" name="email" required class="form-control form-control-lg" id="usuario" placeholder="Seu e-mail">
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
						<label class="col-sm-2 col-form-label col-form-label-lg">Senha:</label>
						<div class="col-sm-6">
						<input type="password" name="senha" required class="form-control form-control-lg" id="usuario" placeholder="Sua senha">
						</div>
					</div>
				</div>
				
					<br>
				<div class="row justify-content-center align-items-center">
					<input type="submit" class = "btn btn-lg btn-success col-sm-2" value = "Enviar">
				</div>
			</div>
		</form>
	</div>
</div>
	
	</body>
</html>