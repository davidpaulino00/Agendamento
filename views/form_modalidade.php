<?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/modalidade.class.php";
	require_once "../models/modalidadeDAO.class.php";
	
	if($_POST)
	{
		$erro =0;
		if($_POST["descritivo"] == "")
		{
			echo "<script>alert('Descritivo deve ser preenchido');</script>";
			$erro++;
		}
		else
		{
			$modalidade = new modalidade(null, $_POST["descritivo"]);
			$modalidadeDAO = new modalidadeDAO();
			$ret = $modalidadeDAO->verificarModalidade($modalidade);
			if(count($ret) > 0)
			{
				echo "<script>alert('Modalidade já cadastrada');</script>";
				$erro++;
			}
		}
		
		if($erro == 0)
		{
			
			$modalidade = new modalidade(null, $_POST["descritivo"],"S");
			$modalidadeDAO = new modalidadeDAO();
			$retorno = $modalidadeDAO->inserir($modalidade);
			header("Location:listarModalidade.php?msg=$retorno");
		}
			
	}//ifpost
?>
<div class="content">
	<div class="container">
			
		<form action="#" method="POST">
			<div class="row justify-content-center align-items-center">	
				<h2>Modalidade</h2>
			</div><br><br>
			<div class="box">
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="descritivo" class="col-sm-2 col-form-label col-form-label-lg">Descritivo:</label>
						<div class="col-sm-6">
							<input type="text" name="descritivo" required class="form-control form-control-lg" id="descritivo" placeholder="" value="<?php if($_POST)echo $_POST['descritivo'];?>">
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