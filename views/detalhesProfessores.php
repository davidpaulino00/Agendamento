<?php
	require_once "cabecalho.php";
?>
<div class="content">
			<div class="container">
			<div class="row justify-content-center align-items-center">
					<h2><?php if(isset($_GET["titulo"])) echo $_GET["titulo"];?></h2><br><br>
				</div><br><br>
				<h2>Detalhes Do Professor</h2>
				<br><br>
<form action="#" method="POST">
	
<input type="hidden" class="form-control"  name="idusuario" value="<?php echo $ret[0]->idusuario;?>">
  <div class="form-row">
  
	<div class="form-group col-md-6">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" placeholder="" name="nome" value="<?php echo $ret[0]->nome;?>" required readonly>
    </div>
	<div class="form-group col-md-2">
	</div>
	<div class="form-group col-md-4">
		<label>Sexo</label><br>
		<div class="form-check form-check-inline" readonly>
		<?php
			if($ret[0]->sexo == "F")
			{
					echo "<input class='form-check-input' type='radio' name='sexo' id='sexof' value='F' checked>";
			}
			else
			{
				echo "<input class='form-check-input' type='radio' name='sexo' id='sexof' value='F'>";
			}
		?>
			<label class="form-check-label" for="sexof">Feminino</label>
		</div>

		<div class="form-check form-check-inline" readonly>

			<?php
				if($ret[0]->sexo == "M")
				{
					echo "<input class='form-check-input' type='radio' name='sexo' id='sexom' value='M' checked>";
				}
				else
				{
					 echo "<input class='form-check-input' type='radio' name='sexo' id='sexom' value='M'>";
				}
			?>
 
			<label class="form-check-label" for="sexom">Masculino</label>
	  </div>
</div>

    <div class="form-group col-md-8">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="" name="email" value="<?php echo $ret[0]->email;?>" required readonly>
    </div>
    <?php
		if(isset($_GET["titulo"]) && $_GET["titulo"] == "Professor")
		{
			echo "<div class='form-group col-md-4'>
					  <label for='perfil'>Perfil</label><br>
					  <select class='form-control' name='perfil' id='perfil'>";
					  if($ret[0]->perfil == "Professor")
						echo "<option selected>Professor</option>";
					  else
						 echo "<option>Professor</option>"; 
					  if($ret[0]->perfil == "Administrador")
						echo "<option selected>Administrador</option>";
					  else
						 echo "<option >Administrador</option>"; 
					  echo "</select>
				 </div>";
		}
		if(isset($_GET["titulo"]) && $_GET["titulo"] == "Funcionário")
		{
			echo "<div class='form-group col-md-4'>
					  <label for='perfil'>Perfil</label><br>
					  <select class='form-control' name='perfil' id='perfil'>";
					  if($ret[0]->perfil == "Funcionário")
						echo "<option selected>Funcionário</option>";
					  else
						 echo "<option>Funcionário</option>"; 
					  if($ret[0]->perfil == "Administrador")
						echo "<option selected>Administrador</option>";
					  else
						 echo "<option >Administrador</option>"; 
					  echo "</select>
				 </div>";
		}
	?>
  <div class="form-group col-md-6">
      <label for="celular">Celular</label>
      <input type="text" class="form-control" id="celular" placeholder="" name="celular" value="<?php echo $ret[0]->celular;?>" readonly>
    </div>
	<div class="form-group col-md-6">
      <label for="telefone">Telefone</label>
      <input type="text" class="form-control" id="telefone" placeholder="" name="telefone" value="<?php echo $ret[0]->telefone;?>" readonly>
    </div>
  <div class="form-group col-md-6">
    <label for="logradouro">Endereço</label>
    <input type="text" class="form-control" id="logradouro" placeholder="" name="logradouro" value="<?php echo $ret[0]->logradouro;?>" required readonly>
  </div>
  <div class="form-group col-md-2">
    <label for="numero">Número</label>
    <input type="text" class="form-control" id="numero" placeholder="" name="numero" value="<?php echo $ret[0]->numero;?>" required readonly>
  </div>
  <div class="form-group col-md-6">
      <label for="complemento">Complemento</label>
      <input type="text" class="form-control" id="complemento" placeholder="" name="complemento" value="<?php echo $ret[0]->complemento;?>"readonly>
    </div>
	<div class="form-group col-md-6">
      <label for="bairro">Bairro</label>
      <input type="text" class="form-control" id="bairro" placeholder="" name="bairro" value="<?php echo $ret[0]->bairro;?>" required readonly>
    </div>
  <div class="form-group col-md-6">
      <label for="cidade">Cidade</label>
      <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $ret[0]->cidade;?>" required readonly>
    </div>
    <div class="form-group col-md-4">
      <label for="uf">Estado</label>
      <input type="text" class="form-control" id="uf" name="uf" value="São Paulo" readonly readonly>
    </div>
    <div class="form-group col-md-2">
      <label for="cep">CEP</label>
      <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $ret[0]->cep;?>" required readonly>
    </div>
	
  