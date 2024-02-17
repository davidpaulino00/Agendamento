<?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/modalidade.class.php";
	require_once "../models/modalidadeDAO.class.php";
	require_once "../models/faixa.class.php";
	require_once "../models/faixaDAO.class.php";
	
	$id_modalidade = 0;
	$descritivo = "";
	if($_GET)
	{
		$id_modalidade = $_GET["id"];
		
		//buscar dados modalidade
		$modalidade = new modalidade($_GET["id"]);
		
		$modalidadeDAO = new modalidadeDAO();
		$ret = $modalidadeDAO->buscarUmaModalidade($modalidade);
		
		$descritivo = $ret[0]->descritivo;
	}
	if($_POST)
	{
		$erro =0;
		//fazer a validação
		
		if($erro == 0)
		{
			
			$modalidade = new modalidade($id_modalidade);
			
			$faixa = new faixa(null, $_POST["descritivo"], $_POST["sequencia"], $modalidade);
			$faixaDAO = new faixaDAO();
			$retorno = $faixaDAO->inserir($faixa);
			header("Location:listarfaixa.php?msg=$retorno&id=$id_modalidade");
		}
			
	}//ifpost
?>
<div class="content">
	<div class="container">
			
		<form action="#" method="POST">
			<div class="row justify-content-center align-items-center">	
				<h2>Faixa</h2>
			</div><br><br>
			<div class="box">
			<input type="hidden" name="id" value="<?php echo $id_modalidade;?>">
			<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="modalidade" class="col-sm-2 col-form-label col-form-label-lg">Modalidade</label>
						<div class="col-sm-6">
							<input type="text" name="modalidade"  class="form-control form-control-lg" id="modalidade" placeholder="" value="<?php echo $descritivo?>" disabled>
						</div>
					</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="inicio" class="col-sm-2 col-form-label col-form-label-lg">Descritivo:</label>
						<div class="col-sm-6">
							<input type="text" name="descritivo" required class="form-control form-control-lg" id="descritivo">
						</div>
					</div>
					<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="fim" class="col-sm-2 col-form-label col-form-label-lg">Sequencia:</label>
						<div class="col-sm-6">
							<input type="text" name="sequencia" required class="form-control form-control-lg" id="sequencia" >
						</div>
					</div>
					
				
				
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