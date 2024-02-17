<?php
	if(!isset($_SESSION))
		session_start();
?>
<!doctype html>
<html>
	<head>
		<title>Academia Krav Magá</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
	<link href='../flipping_gallery-master/flipping_gallery.css'
		rel='stylesheet' type='text/css'>
	
	<script type="text/javascript"
			src="http://code.jquery.com/jquery-1.9.1.js">
	</script>
	<script type="text/javascript"
			src="../flipping_gallery-master/jquery.flipping_gallery.js">
	</script>

	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-light" style="margin-bottom: 50px;background-color:#000080;">
	
		<div class="collapse navbar-collapse" id="navbarSupportedContent">	
		<ul class='navbar-nav mr-auto'>
		
			<li class='nav-item'>
				<a href='home.php' class='nav-link' style='color:white'>Home</a>
			</li>
			<li class='nav-item'>
				<a href='sobre.php' class='nav-link' style='color:white'>Sobre</a>
			</li>
			<li class='nav-item'>
				<a href='galeria.php' class='nav-link' style='color:white'>Galeria de Fotos</a>
			</li>
			<li class='nav-item'>
				<a href='horario.php' class='nav-link' style='color:white'>Horários</a>
			</li>
						
		</ul>
		<?php
			if(isset($_SESSION["perfil"]))
			{
				if($_SESSION["perfil"] == "Administrador")
				{
					echo "<ul class='navbar-nav mr-auto'>
						
						<li class='nav-item'>
							<a href='listarAulaTeste.php' class='nav-link' style='color:white'>Aulas Teste</a>
						</li>
						<li class='nav-item'>
							<a href='listarModalidade.php' class='nav-link' style='color:white'>Modalidades</a>
						</li>
						<div class='my-2 my-lg-0'>
					 
					  <li class='nav-item dropdown'>
						<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='color:white'>
						  Usuários
						</a>
						<div class='dropdown-menu' aria-labelledby='navbarDropdown'>
						  <a class='dropdown-item' href='ListarAlunos.php'>Alunos</a>
						  <a class='dropdown-item' href='ListarProfessores.php'>Professores</a>
						  <a class='dropdown-item' href='ListarFuncionarios.php'>Funcionários</a>
						  
						</div>
					</li>
						
					</div>	
					</ul>";
				}//admin
				if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Professor")
				{
					echo "<ul class='navbar-nav mr-auto'>
						
						<li class='nav-item'>
							<a href='form_frequencia.php' class='nav-link' style='color:white'> Frequência</a>
						</li></ul>";
				}//fim do perfilAdministrador
				if($_SESSION["perfil"] == "Aluno" )
				{
					echo "<ul class='navbar-nav mr-auto'>
						
						<li class='nav-item'>
							<a href='frequencia.php' class='nav-link' style='color:white'> Consulta Frequência</a>
						</li></ul>";
				}//fim do perfilAdministrador
				
				
								
				echo "<div class='my-2 my-lg-0'>
					  <ul class='navbar-nav mr-auto'>
					  <li class='nav-item dropdown'>
						<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='color:white'>
						  Meu Perfil
						</a>
						<div class='dropdown-menu' aria-labelledby='navbarDropdown'>
						 
						  <a class='dropdown-item' href='alterar_senha.php'>Trocar Senha</a>
						  
						</div>
					</li>
					 
						<li class='nav-item'>
							<a href='logout.php' class='nav-link' style='color:white'>Sair</a>
						</li></ul></div>";
			}
			else
			{
				echo "<div class='collapse navbar-collapse justify-content-end'>
					  <ul class='navbar-nav'>
					  
						
						<li class='nav-item '>
							<a href='login.php'class='nav-link' style='color:white'>Entrar</a>
						</li>
						
					</ul>";
			}
		?>
	</nav>