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
		if($erro == 0)
		{
			require_once "../models/conexao.class.php";
			require_once "../models/aluno.class.php";
			require_once "../models/alunoDAO.class.php";
			
			$alunos = new alunos(null, $_POST["nome"], $_POST["lesao"] ,$_POST["descricao_lesao"], $_POST["deficiencia"] ,$_POST["descricao_deficiencia"],
			$_POST["tel1"] ,$_POST["tel2"],$_POST["logradouro"], $_POST["numero"], $_POST["bairro"], $_POST["cidade"],$_POST["uf"] ,$_POST["vencimento"],
			$_POST["datam"] ,$_POST["email"],$_POST["senha"], "A");
			$alunoDAO = new alunoDAO();
			$alunoDAO->inserir($alunos);
			header("location:login.php");
			
		}
	}
?>
		<div class="content">
			<div class="container">
			<link href="estilo.css" rel="stylesheet">
			<div class="box">
				<h2>Cadastro Aluno</h2><br>
				<form action="#" method="POST">
				        <p>
						<label>Nome:</label>
						<input type="text" name="nome" value="<?php if($_POST) 
							echo $_POST['nome'];
						 ?>" required>
					
						 <label>Lesão:</label>
						 <input type="text" name="lesao" value="<?php if($_POST) 
							echo $_POST['lesao'];
						 ?>">
						 
						 <label>Descrção da lesão:</label>
						  <input type="text" name="descricao_lesao" value="<?php if($_POST) 
							echo $_POST['lesao'];
						 ?>">
						 </p>
						 <br> <br>
						 <p>
						 <label>Deficiencia:</label>
						 <input type="text" name="deficiencia" value="<?php if($_POST) 
							echo $_POST['deficiencia'];
						 ?>">
						 <label>Descrção da deficiencia:</label>
						  <input type="text" name="descricao_deficiencia" value="<?php if($_POST) 
							echo $_POST['descricao_deficiencia'];
						 ?>">
						<label>Telefone1:</label>
						<input type="tel1" name="tel1" value="<?php if($_POST) 
							echo $_POST['tel1'];
						 ?>" >
						 </p>
					<br> <br>
					    <p>
						<label>Telefone2:</label>
						<input type="tel2" name="tel2" value="<?php if($_POST) 
							echo $_POST['tel2'];
						 ?>" >
					
					
							<label>Logradouro:</label>
							<input type="logradouro" name="logradouro" value="<?php if($_POST) 
							echo $_POST['logradouro'];
						 ?>" required>
					
					
						<label>Numero:</label>
							<input type="numero" name="numero" value="<?php if($_POST) 
							echo $_POST['numero'];
						 ?>" required>
						 </p>
				  <br> <br>
					
					<p>
						<label>Bairro:</label>
							<input type="bairro" name="bairro" value="<?php if($_POST) 
							echo $_POST['bairro'];
						 ?>" required>
				   
					
						<label>Cidade:</label>
							<input type="cidade" name="cidade" value="<?php if($_POST) 
							echo $_POST['cidade'];
						 ?>" required>
				 
					
						<label>Uf:</label>
							<input type="uf" name="uf" value="<?php if($_POST) 
							echo $_POST['uf'];
						 ?>" required>
						 </p>
				   <br> <br>
				        <p>
						<label>Data de Vencimento:</label>
							<input type="vencimento" name="vencimento" value="<?php if($_POST) 
							echo $_POST['vencimento'];
						 ?>" required>
				    
					
						<label>Data da Matricula:</label>
							<input type="datam" name="datam" value="<?php if($_POST) 
							echo $_POST['datam'];
						 ?>" required>
				    
					
						<label>E-mail:</label>
							<input type="email" name="email" value="<?php if($_POST) 
							echo $_POST['email'];
						 ?>" required>
				   
					
						<label>Senha:</label>
							<input type="senha" name="senha" value="<?php if($_POST) 
							echo $_POST['senha'];
						 ?>" required>
						
				    </p>
					
					<br> <br>
					<br><input type="submit" value="Enviar" class="btn btn-lg btn-success">
				</div>
					
					
				</form>
			</div>
		</div>
	</body>
</html>