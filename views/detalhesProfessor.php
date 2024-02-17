	<?php
		require_once "../models/conexao.class.php";
		require_once "../models/usuario.class.php";
		require_once "../models/usuarioDAO.class.php";
		require_once "../models/professor.class.php";
		require_once "../models/professorDAO.class.php";
		require_once "../models/modalidadeDAO.class.php";
		require_once "../models/modalidade.class.php";
		require_once "../models/faixa.class.php";
		if($_GET)
		{
			$professor = new professor($_GET["id"]);
			$professorDAO = new professorDAO();
			$ret = $professorDAO->buscarUmProfessor($professor);
			//buscar dados usuario_modalidade
			$usuario = new usuario($ret[0]->usuario_idusuario);
			$usuarioDAO = new usuarioDAO();
			$retorno = $usuarioDAO->buscarModalidadesUmUsuario($usuario);
			
		}
	
		if($_POST)
		{	
			
			$erro = false;
			//verificar o preenchimento dos campos
			
			if(!$erro)
			{
				
				$professor = new professor($_POST["idprofessor"],$_POST["curriculo"], $_POST["idusuario"], null, $_POST["nome"], $_POST["email"], null, $_POST["perfil"], $_POST["sexo"], $_POST["celular"], $_POST["telefone"], $_POST["logradouro"],$_POST["numero"], $_POST["complemento"],$_POST["bairro"],$_POST["cidade"],"SP",$_POST["cep"]);
				
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
				$professorDAO->alterar($professor);
				
				header("Location:listarProfessores.php");
				
			}
			
		}
		require_once "detalhesProfessores.php";
	?>
	<input type="hidden" class="form-control"  name="idprofessor" value="<?php echo $ret[0]->idprofessor;?>">
	
	<div class="form-group col-md-12">
		<fieldset class="row border p-3">
		<legend class="w-auto px-2">Modalidades</legend>
	
	<?php
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
					echo "<div class='form-group col-md-2'>					
					<div class='form-check form-check-inline' readonly >";
					$encontrou = false;
					$ind = 0;
					foreach($retorno as $indice=>$item)
					{
						if($item->modalidade_idmodalidade == $dado->idmodalidade)
						{
							$encontrou = true;
							$ind = $indice;
						}
					}	
					if($encontrou)
				    {
						echo "<input type='checkbox' class='form-check-input' name = 'modalidade[]' value='{$dado->idmodalidade}' checked readonly>";
					}
					else
					{
						echo "<input type='checkbox' class='form-check-input' name = 'modalidade[]' value='{$dado->idmodalidade}' readonly>";
					}
						
						echo "<label class='form-check-label'>{$dado->descritivo}</label>
						</div></div>
						<div class='form-group col-md-4'>
						<label>Faixas:</label>
						<select name='faixa[]'>";
					if(!$encontrou)
					{
						echo "<option value='0'>Escolha a Faixa do {$dado->descritivo} </option> readonly";
					}
					
					foreach($faixas as $faixa)
					{
						if($faixa->idfaixa == $retorno[$ind]->faixa_idfaixa)
						{
							echo "<option value='{$faixa->idfaixa}' selected>{$faixa->descritivo}</option> readonly";
						}
						else
						{
							echo "<option value='{$faixa->idfaixa}'>{$faixa->descritivo}</option> readonly";
						}
						
					}
					
					
					echo "</select></div>";
				}
				
				
			}
		}
		
	?>
	</fieldset></div>
	<div class="form-group col-md-12">
		<label for="curriculo">Currículo</label>
		<textarea class="form-control" id="curriculo" name="curriculo" ><?php echo $ret[0]->curriculo;?></textarea>
	</div>

<?php
		echo "<&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='btn btn-primary btn-lg' href='ListarAlunos.php'>Voltar</a>";
  ?>
</div></form>
</div>
</div>
<body>
</html>
