<?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/frequencia.class.php";
	require_once "../models/frequenciaDAO.class.php";
	if($_GET)
	{
		$frequencia = new frequencia($_GET["id"]);
		$frequenciaDAO = new frequenciaDAO();
		$ret = $frequenciaDAO->buscarUmafrequencia($frequencia);
	}
	if($_POST)
	{
		$erro =0;
		if($_POST["presenca"] == "")
		{
			echo "<script>alert('Descritivo deve ser preenchido');</script>";
			$erro++;
		}
		if($_POST["data_aula"] == "")
		{
			echo "<script>alert('Descritivo deve ser preenchido');</script>";
			$erro++;
		}
		else
		{
			$frequencia = new frequencia(null, $_POST["presenca"],$_POST["data_aula"]);
			$frequenciaDAO = new frequenciaDAO();
			$ret = $frequenciaDAO->verificarfrequencia($frequencia);
			if(count($ret) > 0)
			{
				echo "<script>alert('frequencia jรก cadastrada');</script>";
				$erro++;
			}
		}
		
		if($erro == 0)
		{
			
			$frequencia = new frequencia($_POST["id"],null, $_POST["presenca"],$_POST["data_aula"]);
			$frequenciaDAO = new frequenciaDAO();
			$retorno = $frequenciaDAO->alterar($frequencia);
			header("Location:listarFrequencia.php?msg=$retorno");
		}
			
	}//ifpost
?>
<div class="content">
	<div class="container">
			
		<form action="#" method="POST">
		<input type="hidden" name="id" value="<?php echo $ret[0]->idfrequencia;?>">
			<div class="row justify-content-center align-items-center">	
				<h2>frequencia</h2>
			</div><br><br>
			<div class="box">
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
					
						<label for="descritivo" class="col-sm-2 col-form-label col-form-label-lg">Presenca:</label>
						<div class="col-sm-6">
							<input type="descritivo" name="descritivo" required class="form-control form-control-lg" id="descritivo" placeholder="" value="<?php if($_POST)echo $_POST['presenca'];else echo $ret[0]->presenca;?>">
						</div>
						<label for="descritivo" class="col-sm-2 col-form-label col-form-label-lg">Data aula:</label>
						<div class="col-sm-6">
							<input type="descritivo" name="descritivo" required class="form-control form-control-lg" id="descritivo" placeholder="" value="<?php if($_POST)echo $_POST['data_aula'];else echo $ret[0]->data_aula;?>">
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