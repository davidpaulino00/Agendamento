<?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/aluno.class.php";
	require_once "../models/alunoDAO.class.php";
	
	if($_GET)
	{
		$alunos = new alunos($_GET["id"], null, null,null,null,null,null,null,null,
		null,null,null,null,null,null,null,null, null);
		$alunoDAO = new alunoDAO();
		$retorno = $alunoDAO->buscarUmAluno($alunos);
	}
	if($_POST)
	{
		$erro = 0;
		if($_POST["nome"] == "")
		{
			echo "<script>alert('Preencha o nome')</script>";
			$erro++;
		}
		if($_POST["lesao"])
		{
			$erro++;
			
		}	
		if($_POST["descricao_lesao"])
		{
			
			$erro++;
		}
		if($_POST["deficiencia"])
		{
			$erro++;
			
		}	
		if($_POST["descricao_deficiencia"])
		{
			$erro++;
			
		}
		if($_POST["tel1"] == "")
		{
			echo "<script>alert('Preencha o logradouro')</script>";
			$erro++;
		}
		if($_POST["tel2"])
		{
			
		}
		if($_POST["logradouro"] == "")
		{
			echo "<script>alert('Preencha o logradouro')</script>";
			$erro++;
		}
		
		if($_POST["numero"] == "")
		{
			echo "<script>alert('Preencha o numro')</script>";
			$erro++;
		}
		if($_POST["bairro"]== "")
		{
			echo "<script>alert('preencha o bairro')</script>";
			$erro++;
		}
		if($_POST["cidade"] == "")
		{
			echo "<script>alert('Preencha a Cidade')</script>";
			$erro++;
		}
		if($_POST["uf"] == "")
		{
			echo "<script>alert('Preencha a Cidade')</script>";
			$erro++;
		}
		if($_POST["vencimento"] == "")
		{
			echo "<script>alert('Preencha a Cidade')</script>";
			$erro++;
		}
		if($_POST["datam"] == "")
		{
			echo "<script>alert('Preencha a Cidade')</script>";
			$erro++;
		}
		if($_POST["email"] == "")
		{
			echo "<script>alert('Preencha a Cidade')</script>";
			$erro++;
		}
		if($_POST["senha"] == "")
		{
			echo "<script>alert('Preencha a Cidade')</script>";
			$erro++;
		}
		else
		{
			//acertar objeto
			$aluno = new aluno($_POST["id"],$_POST["nome"], $_POST["tel1"], $_POST["logradouro"],
			$_POST["numero"],$_POST["bairro"],$_POST["cidade"]);
			$alunoDAO = new alunoDAO();
			//mudar o método
			$alunoDAO->alterar($aluno);
			header("Location:listaralunos.php");
		}
	}
?>
		<div class="content">
			<div class="container">
			<link href="estilo.css" rel="stylesheet">
			<div class="box">
				<h2>Cadastro Aluno</h2><br>
				<form action="#" method="POST">
				
						<label>Nome:</label>
						<input type="text" name="nome" value="<?php if($_POST) 
							echo $_POST['nome'];
						 ?>" required>
					<div class="form-group">
						<label>Telefone:</label>
						<input type="tel1" name="tel1" value="<?php if($_POST) 
							echo $_POST['tel1'];
						 ?>" required>
					</div>
					<div class="form-group">
							<label>logradouro:</label>
							<input type="logradouro" name="logradouro" value="<?php if($_POST) 
							echo $_POST['logradouro'];
						 ?>" required>
					</div>
					<div class="form-group">
						<label>Numero:</label>
							<input type="numero" name="numero" value="<?php if($_POST) 
							echo $_POST['numero'];
						 ?>" required>
				    </div>
					
					<div class="form-group">
						<label>Bairro:</label>
							<input type="bairro" name="bairro" value="<?php if($_POST) 
							echo $_POST['bairro'];
						 ?>" required>
				    </div>
					<div class="form-group">
						<label>Cidade:</label>
							<input type="cidade" name="cidade" value="<?php if($_POST) 
							echo $_POST['cidade'];
						 ?>" required>
				    </div>
					
					
					<br>
					<br><input type="submit" value="Enviar" class="btn btn-lg btn-success">
				</div>
					
					
				</form>
			</div>
		</div>
	</body>
</html>