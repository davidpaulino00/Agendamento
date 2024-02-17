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
		if($_POST["faixa_cor"])
		{
			echo "<script>alert('Preencha a faixa')</script>";
			$erro++;
		}
		if($erro == 0)
		{
			require_once "../models/conexao.class.php";
			require_once "../models/usuario.class.php";
			require_once "../models/usuarioDAO.class.php";
			require_once "../models/faixaDAO.class.php";
			require_once "../models/faixa.class.php";
			$usuario = new usuario(null,null,null,$_POST["email"],$_POST["senha"] ,$_POST["faixa_cor"]);
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
				<h2>Cadastro</h2><br>
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
					
					<label>Faixa:</label>
					<select id="faixa_cor">
					<option value="Escolha">Selecione a faixa</option>
					<option value="Branca">Branca</option>
					    <option value="Amarela">Amarela</option>
					    <option value="Laranja">Laranja</option>
					    <option value="Verde">Verde</option>
					    <option value="Azul">Azul</option>
						<option value="Marrom">Marrom</option>
						<option value="Faixa preta 1°DAN">Faixa preta 1°DAN</option>
						<option value="Faixa preta 2°DAN">Faixa preta 2°DAN</option>
						<option value="Faixa preta 3°DAN">Faixa preta 3°DAN</option>
						<option value="Faixa preta 4°DAN">Faixa preta 4°DAN</option>
						<option value="Faixa preta 5°DAN">Faixa preta 5°DAN</option>
						<option value="Faixa Branca e Vermelha 6°DAN">Faixa Branca e Vermelha 6°DAN</option>
						<option value="Faixa Branca e Vermelha 7°DAN">Faixa Branca e Vermelha 7°DAN</option>
						<option value="Faixa Branca e Vermelha 8°DAN">Faixa Branca e Vermelha 8°DAN</option>
						<option value="Faixa Branca e Vermelha 9°DAN">Faixa Branca e Vermelha 9°DAN</option>
						<option value="Faixa Vermelha 10°DAN">Faixa Vermelha 10°DAN</option>
						
				</select>
					<br>
					<br><input type="submit" value="Enviar" class="btn btn-lg btn-success">
				</div>
					
					
				</form>
			</div>
		</div>
	</body>
</html>