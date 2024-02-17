	<?php
		require_once "../models/conexao.class.php";
		require_once "../models/usuario.class.php";
		require_once "../models/aluno.class.php";
		require_once "../models/alunoDAO.class.php";
		if($_GET)
		{
			$aluno = new aluno($_GET["id"]);
			$alunoDAO = new alunoDAO();
			$ret = $alunoDAO->buscarUmAluno($aluno);
		}
	
		if($_POST)
		{	
			$erro = false;
			//verificar o preenchimento dos campos
			
			if(!$erro)
			{
				
				$aluno = new aluno($_POST["idaluno"], $_POST["lesao"], $_POST["descricao_lesao"], $_POST["deficiencia"], $_POST["descricao_deficiencia"], $_POST["idusuario"], null, $_POST["nome"], $_POST["email"], null, "Aluno", $_POST["sexo"], $_POST["celular"], $_POST["telefone"], $_POST["logradouro"],$_POST["numero"], $_POST["complemento"],$_POST["bairro"],$_POST["cidade"],"SP",$_POST["cep"], null);
				
				
				$alunoDAO = new alunoDAO();
				$alunoDAO->alterar($aluno);
				header("Location:listarAlunos.php");
				
			}
			
		}
		require_once "edit_usuario.php";
	?>
	<input type="hidden" class="form-control"  name="idaluno" value="<?php echo $ret[0]->idaluno;?>">
	<div class="form-group col-md-6">
		<label>Lesão</label><br>
		<div class="form-check form-check-inline">
		  <?php
			if($ret[0]->lesao == "S")
			{
				echo "<input class='form-check-input' type='radio' name='lesao' id='sim' value='S' checked>";
			}
			else
			{
				echo "<input class='form-check-input' type='radio' name='lesao' id='sim' value='S'>";
			}
		  ?>
			<label class="form-check-label" for="sim">Sim</label>
		</div>
		<div class="form-check form-check-inline">
		  <?php
			if($ret[0]->lesao == "N")
			{
				echo "<input class='form-check-input' type='radio' name='lesao' id='nao' value='N' checked>";
			}
			else
			{
				echo "<input class='form-check-input' type='radio' name='lesao' id='nao' value='N'>";
			}
		  ?>
			<label class="form-check-label" for="nao">Não</label>
		</div>
</div>
	<div class="form-group col-md-6">
		<label for="descricao_lesao">Descrição da lesão</label><br>
		<input type="text" class="form-control" id="descricao_lesao" placeholder="" name="descricao_lesao" value="<?php echo $ret[0]->descricao_lesao;?>">
    </div>
    <div class="form-group col-md-6">
		<label>Deficiência</label><br>
		<div class="form-check form-check-inline">
			<?php
				if($ret[0]->deficiencia == "S")
				{
				 echo "<input class='form-check-input' type='radio' name='deficiencia' id='defs' value='S' checked>";
				}
				else
				{
					echo "<input class='form-check-input' type='radio' name='deficiencia' id='defs' value='S'";
				}
			?>
			<label class="form-check-label" for="defs">Sim</label>
		</div>
		<div class="form-check form-check-inline">
			<?php
				if($ret[0]->deficiencia == "N")
				{
				 echo "<input class='form-check-input' type='radio' name='deficiencia' id='defn' value='N' checked>";
				}
				else
				{
					echo "<input class='form-check-input' type='radio' name='deficiencia' id='defn' value='N'>";
				}
				
			?>
				<label class="form-check-label" for="defn">Não</label>
		</div>
	</div>
	<div class="form-group col-md-6">
      <label for="descricao_deficiencia">Descrição da deficiência</label><br>
      <input type="text" class="form-control" id="descricao_deficiencia" placeholder="" name="descricao_deficiencia" value="<?php echo $ret[0]->descricao_deficiencia;?>">
    </div>
</div>

  <input type="submit" class="btn btn-success" value="Alterar">
</form>
</div>
</div>
<body>
</html>
