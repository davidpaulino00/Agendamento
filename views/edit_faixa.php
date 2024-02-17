<?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/faixa.class.php";
	require_once "../models/faixaDAO.class.php";
	require_once "../models/modalidade.class.php";
	if($_GET)
	{
		$faixa = new faixa($_GET["id"]);
		$faixaDAO = new faixaDAO();
		$ret = $faixaDAO->buscarUmaFaixa($faixa);
		$id_modalidade=$ret[0]->modalidade_idmodalidade;
	}
	if($_POST)
	{
		$erro =0;
		if($_POST["descritivo"] == "")
		{
			echo "<script>alert('Descritivo deve ser preenchido');</script>";
			$erro++;
		}
		if($_POST["sequencia"] == "")
		{
			echo "<script>alert('sequencia deve ser preenchido');</script>";
			$erro++;
		}
		
		else
		{
			$modalidade= new modalidade($id_modalidade);
			$faixa = new faixa(null, $_POST["descritivo"],null,$modalidade);
			$faixaDAO = new faixaDAO();
			$ret = $faixaDAO->verificarFaixa($faixa);
			if(count($ret) > 0)
			{
				echo "<script>alert('faixa já cadastrada');</script>";
				$erro++;
			}
		}
		
		if($erro == 0)
		{
			
			$faixa = new faixa($_POST["id"], $_POST["descritivo"], $_POST["sequencia"]);
			$faixaDAO = new faixaDAO();
			$retorno = $faixaDAO->alterar($faixa);
			header("Location:listarfaixa.php?msg=$retorno&id=$id_modalidade");
		}
			
	}//ifpost
?>
<div class="content">
	<div class="container">
			
		<form action="#" method="POST">
		<input type="hidden" name="id" value="<?php echo $ret[0]->idfaixa;?>">
			<div class="row justify-content-center align-items-center">	
				<h2>Faixa</h2>
			</div><br><br>
			<div class="box">
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="descritivo" class="col-sm-2 col-form-label col-form-label-lg">Descritivo:</label>
						<div class="col-sm-6">
							<input type="descritivo" name="descritivo" required class="form-control form-control-lg" id="descritivo" placeholder="" value="<?php if($_POST)echo $_POST['descritivo'];else echo $ret[0]->descritivo;?>">
						</div>
					</div>
				</div>
					<div class = "form-group">
						<div class="row justify-content-center align-items-center">
						<label for="sequencia" class="col-sm-2 col-form-label col-form-label-lg">Sequencia:</label>
						<div class="col-sm-6">
							<input type="sequencia" name="sequencia" required class="form-control form-control-lg" id="sequencia" placeholder="" value="<?php if($_POST)echo $_POST['sequencia'];else echo $ret[0]->sequencia;?>">
						</div>
					</div>
					</div>
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

