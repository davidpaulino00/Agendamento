	<?php
	
		if($_POST)
		{	
			$erro = false;
			//verificar o preenchimento dos campos
			if(!$erro)
			{
				require_once "../models/conexao.class.php";
				require_once "../models/usuario.class.php";
				require_once "../models/aluno.class.php";
				require_once "../models/alunoDAO.class.php";
				$aluno = new aluno(null, $_POST["lesao"], $_POST["descricao_lesao"], $_POST["deficiencia"], $_POST["descricao_deficiencia"], null, null, $_POST["nome"], $_POST["email"], md5($_POST["senha"]), "Aluno", $_POST["sexo"], $_POST["celular"], $_POST["telefone"], $_POST["logradouro"],$_POST["numero"], $_POST["complemento"],$_POST["bairro"],$_POST["cidade"],"SP",$_POST["cep"], "S", "Aluno");
				
				
				$alunoDAO = new alunoDAO();
				$alunoDAO->inserir($aluno);
				header("Location:listarAlunos.php");
				
			}
			
		}
		require_once "form_usuario.php";
		
	?>
	<div class="form-group col-md-6">
	<label>Lesão</label><br>
	<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="lesao" id="sim" value="S">
  <label class="form-check-label" for="sim">Sim</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="lesao" id="nao" value="N">
  <label class="form-check-label" for="nao">Não</label>
</div>
</div>
	<div class="form-group col-md-6">
      <label for="descricao_lesao">Descrição da lesão</label><br>
      <input type="text" class="form-control" id="descricao_lesao" placeholder="" name="descricao_lesao">
    </div>
    	<div class="form-group col-md-6">
	<label>Deficiência</label><br>
	<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="deficiencia" id="defs" value="S">
  <label class="form-check-label" for="defs">Sim</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="deficiencia" id="defn" value="N">
  <label class="form-check-label" for="defn">Não</label>
</div>
</div>
	<div class="form-group col-md-6">
      <label for="descricao_deficiencia">Descrição da deficiência</label><br>
      <input type="text" class="form-control" id="descricao_deficiencia" placeholder="" name="descricao_deficiencia">
    </div>
</div>

  <input type="submit" class="btn btn-success" value="Cadastrar">
</form>
</div>
</div>
<body>
</html>
