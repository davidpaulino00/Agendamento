<?php
	require_once "cabecalho.php";
	if(!isset($_SESSION["perfil"]) || $_SESSION["perfil"] != "Administrador")
	{
		header("location:home.php");
	}
?>
<div class="content">
			<div class="container">
			<div class="row justify-content-center align-items-center">
					<h2><?php if(isset($_GET["titulo"])) echo $_GET["titulo"];?></h2><br><br>
				</div><br><br>
<form action="#" method="POST">
  <div class="form-row">
	<div class="form-group col-md-6">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" placeholder="" name="nome" required>
    </div>
	<div class="form-group col-md-2">
	</div>
	
	<div class="form-group col-md-4">
		<label>Sexo</label><br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo" id="sexof" value="F">
			<label class="form-check-label" for="sexof">Feminino</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="sexo" id="sexom" value="M">
			<label class="form-check-label" for="sexom">Masculino</label>
		</div>
	</div>

    <div class="form-group col-md-8">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="" name="email" required>
    </div>
	<?php
		if(isset($_GET["titulo"]) && $_GET["titulo"] == "Professor")
		{
			echo "<div class='form-group col-md-4'>
					  <label for='perfil'>Perfil</label><br>
					  <select class='form-control' name='perfil' id='perfil'>
						<option selected>Professor</option>
						<option>Administrador</option>
					  </select>
				 </div>";
		}
		if(isset($_GET["titulo"]) && $_GET["titulo"] == "Funcionário")
		{
			echo "<div class='form-group col-md-4'>
					  <label for='perfil'>Perfil</label><br>
					  <select class='form-control' name='perfil' id='perfil'>
						<option selected>Funcionário</option>
						<option>Administrador</option>
					  </select>
				 </div>";
		}
	?>
    <div class="form-group col-md-6">
      <label for="senha">Senha</label>
      <input type="password" class="form-control" id="senha" placeholder="" name="senha" required>
    </div>
	<div class="form-group col-md-6">
      <label for="confirma">Confirma a Senha</label>
      <input type="password" class="form-control" id="confirma" placeholder="" name="confirma" required>
    </div>
  <div class="form-group col-md-6">
      <label for="celular">Celular</label>
      <input type="text" class="form-control" id="celular" placeholder="" name="celular">
    </div>
	<div class="form-group col-md-6">
      <label for="telefone">Telefone</label>
      <input type="text" class="form-control" id="telefone" placeholder="" name="telefone">
    </div>
  <div class="form-group col-md-6">
    <label for="logradouro">Endereço</label>
    <input type="text" class="form-control" id="logradouro" placeholder="" name="logradouro" required>
  </div>
  <div class="form-group col-md-2">
    <label for="numero">Número</label>
    <input type="text" class="form-control" id="numero" placeholder="" name="numero" required>
  </div>
  <div class="form-group col-md-6">
      <label for="complemento">Complemento</label>
      <input type="text" class="form-control" id="complemento" placeholder="" name="complemento">
    </div>
	<div class="form-group col-md-6">
      <label for="bairro">Bairro</label>
      <input type="text" class="form-control" id="bairro" placeholder="" name="bairro" required>
    </div>
  <div class="form-group col-md-6">
      <label for="cidade">Cidade</label>
      <input type="text" class="form-control" id="cidade" name="cidade" required>
    </div>
    <div class="form-group col-md-4">
      <label for="uf">Estado</label>
      <input type="text" class="form-control" id="uf" name="uf" value="São Paulo" readonly>
    </div>
    <div class="form-group col-md-2">
      <label for="cep">CEP</label>
      <input type="text" class="form-control" id="cep" name="cep" required>
    </div>
	
  