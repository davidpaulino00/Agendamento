	<?php
	
		if($_POST)
		{	
			$erro = false;
			
			//verificar o preenchimento dos campos
			if(!$erro)
			{
				require_once "../models/conexao.class.php";
				require_once "../models/usuario.class.php";
				require_once "../models/professor.class.php";
				require_once "../models/professorDAO.class.php";
				require_once "../models/modalidade.class.php";
				require_once "../models/faixa.class.php";
				
				$professor = new professor(null, $_POST["curriculo"], null, null, $_POST["nome"], $_POST["email"], md5($_POST["senha"]), $_POST["perfil"], $_POST["sexo"], $_POST["celular"], $_POST["telefone"], $_POST["logradouro"],$_POST["numero"], $_POST["complemento"],$_POST["bairro"],$_POST["cidade"],"SP",$_POST["cep"], "S", "Professor");
				
				$faixas = $_POST["faixa"];
				
				foreach($_POST["modalidade"] as $ind=>$dado)
				{
					$modalidade = new modalidade($dado);
					$faixa = new faixa();
					for($x=0; $x<count($faixas); $x++)
					{
						if($faixas[$x] != 0)
						{
							$faixa->setId($faixas[$x]);
							$faixas[$x] = 0;
							break;
						}
					}
					
					$modalidade->setFaixa($faixa);
					$professor->setModalidade($modalidade);
				}
				$professorDAO = new professorDAO();
				$professorDAO->inserir($professor);
				//header("Location:listarProfessores.php");
				
			}
			
		}
		require_once "form_usuario.php";
	?>
	<div class="form-group col-md-12">
		<fieldset class="row border p-3">
		<legend class="w-auto px-2">Modalidades</legend>
	
	<?php
		require_once "../models/conexao.class.php";
		require_once "../models/modalidadeDAO.class.php";
		require_once "../models/modalidade.class.php";
		$modalidadeDAO = new modalidadeDAO();
		$mod = $modalidadeDAO->buscarModalidades();
		if(is_array($mod))
		{
			
			foreach($mod as $dado)
			{
				$modalidade = new modalidade($dado->idmodalidade);
				$modalidadeDAO = new modalidadeDAO();
				$faixas = $modalidadeDAO->buscarFaixasModalidade($modalidade);
				if(is_array($faixas) && count($faixas) > 0)
				{
				?>
					
					<div class="form-group col-md-2">
					
					<div class='form-check form-check-inline'>
						<input type='checkbox' class='form-check-input' name = 'modalidade[]' value='<?php echo$dado->idmodalidade;?>'>
						<label class='form-check-label'><?php echo $dado->descritivo;?></label>
					</div></div>
					<div class="form-group col-md-4">
					<label>Faixas:</label>
					<select name='faixa[]'>
					<option value="0">Escolha a Faixa do <?php echo $dado->descritivo;?> </option>
					<?php
					foreach($faixas as $faixa)
					{
						echo "<option value='{$faixa->idfaixa}'>{$faixa->descritivo}</option>";
					}
					
					echo "</select></div>";
				}
				
				
			}
		}
		
	?>
	</fieldset></div>
	<div class="form-group col-md-12">
		<label for="curriculo">Currículo</label>
		<textarea class="form-control" id="curriculo" name="curriculo" ></textarea>
	</div>

  <input type="submit" class="btn btn-success" value="Cadastrar">
</div></form>
</div>
</div>

<body>
</html>

