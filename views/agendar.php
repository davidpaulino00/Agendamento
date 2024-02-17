<?php
	date_default_timezone_set('America/Sao_Paulo');
	require_once 'cabecalho.php';
	require_once '../models/conexao.class.php';
	require_once '../models/modalidadeDAO.class.php';
	require_once '../models/aula_testeDAO.class.php';
	require_once '../models/aula_teste.class.php';
	require_once '../models/horario.class.php';
	require_once '../models/horarioDAO.class.php';
	require_once '../models/modalidade.class.php';
	$msg = "";
	if($_POST)
	{
		//validação
		$erro = 0;
		if($_POST["nome"] == "")
		{
			echo "<script>alert('Nome é Obrigatório')</script>";
			$erro++;
		}
		if(!isset($_POST["sexo"]))
		{
			echo "<script>alert('Informe o sexo')</script>";
			$erro++;
		}
		if($_POST["email"] == "")
		{
			echo "<script>alert('e-Mail é Obrigatório')</script>";
			$erro++;
		}
		if($_POST["celular"] == "" && $_POST["telefone"] == "")
		{
			echo "<script>alert('Informe pelo menos um Telefone')</script>";
			$erro++;
		}
		if($_POST["modalidade"] == 0)
		{
			echo "<script>alert('Escolha uma modalidade')</script>";
			$erro++;
		}
		if($_POST["horario"] == 0)
		{
			echo "<script>alert('Escolha um horário de aula')</script>";
			$erro++;
		}
		else if($_POST["data_aula"] == "")
		{
			echo "<script>alert('Informe a data da aula')</script>";
			$erro++;
		}
		else if($_POST["data_aula"] <= date("Y-m-d"))
		{	
			echo "<script>alert('Agende uma data futura')</script>";
			$erro++;
		}
		else
		{
			$horario = new horario($_POST["horario"]);
			$horarioDAO = new horarioDAO();
			$retorno = $horarioDAO->buscarUmHorario($horario);
			$diasemana = array('Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado');
			$diasemana_numero = date('w', strtotime($_POST["data_aula"]));
			if($diasemana_numero != $retorno[0]->dia_semana)
			{
				echo "<script>alert('Data inválida. Verifique o dia da semana.')</script>";
				$erro++;
			}
			else
			{
				$modalidade = new modalidade($_POST["modalidade"]);
				$horario->setModalidade($modalidade);
				$aula_teste = new aula_teste(null, null, null, $horario, null, null, $_POST["email"], null, "S");
				$aula_testeDAO = new aula_testeDAO();
				$agenda = $aula_testeDAO->verificarAgenda($aula_teste);
				if(count($agenda) > 0)
				{
					echo "<script>alert('Aula teste realizada anteriormente')</script>";
					$erro++;
				}
			}
		}
			
		if($erro == 0)
		{
			$horario = new horario($_POST["horario"]);
			$aula_teste = new aula_teste(null, $_POST["nome"], $_POST["sexo"], $horario, $_POST["celular"], $_POST["telefone"], $_POST["email"], $_POST["data_aula"], $_POST["observacao"], "S");
			$aula_testeDAO = new aula_testeDAO();
			$msg = $aula_testeDAO->inserir($aula_teste);
		}
		
	}
?>
<div class="content">
	<div class="container">
	<div class="row justify-content-center align-items-center"><?php echo $msg;?>
		
	</div>
	<div class="row justify-content-center align-items-center">
		<h2>Agendar Aula Teste</h2>
	</div><br>
		<form action="#" method="POST">
			
			<div class="box">
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Nome:</label>
						<div class="col-sm-6">
							<input type="text" name="nome"  class="form-control form-control-lg" id="nome" placeholder="" value="<?php if($_POST) echo $_POST['nome'];?>" required>
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
					
						<label class="col-sm-2 col-form-label col-form-label-lg">Sexo:</label>
						
					<div class="col-sm-2">
						<?php
							if($_POST && isset($_POST["sexo"]) && $_POST["sexo"] == "F")
								echo "<input type='radio' name='sexo' value='F'  id='sexo' checked>";
							else
								echo "<input type='radio' name='sexo' value='F'  id='sexo'>";
						?>
							<label for="sexo">Feminino</label>
					</div>
					<div class="col-sm-4">
					<?php
						if($_POST && isset($_POST["sexo"]) && $_POST["sexo"] == "M")
								echo "<input type='radio' name='sexo' value='M'  id='sexo' checked>";
							else
								echo "<input type='radio' name='sexo' value='M'  id='sexo'>";
							
						?>
							<label for="sexo">Masculino</label>
						
					</div>	
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="email" class="col-sm-2 col-form-label col-form-label-lg">e-Mail:</label>
						<div class="col-sm-6">
							<input type="email" name="email"  class="form-control form-control-lg" id="email" placeholder="" value="<?php if($_POST) echo $_POST['email'];?>" required>
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="celular" class="col-sm-2 col-form-label col-form-label-lg">Celular:</label>
						<div class="col-sm-6">
							<input type="text" name="celular"  class="form-control form-control-lg" id="celular" placeholder="" value="<?php if($_POST) echo $_POST['celular'];?>">
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="telefone" class="col-sm-2 col-form-label col-form-label-lg">Telefone:</label>
						<div class="col-sm-6">
							<input type="text" name="telefone" class="form-control form-control-lg" id="telefone" placeholder="" value="<?php if($_POST) echo $_POST['telefone'];?>">
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">	
				
				<label for="modalidade" class="col-sm-2 col-form-label col-form-label-lg">Modalidade:</label>
				<div class="col-sm-6">
				<select name="modalidade" id="modalidade">
				<option value="0">Escolha uma Modalidade</option>
				<?php
					$modalidadeDAO = new modalidadeDAO();
					$ret = $modalidadeDAO->buscarTodasModalidades();
					
					if(is_array($ret))
					{
						foreach($ret as $dado)
						{
							echo "<option value='{$dado->idmodalidade}'>{$dado->descritivo}</option>";
						}
					}
				?>
				</select>
				</div>
				</div>
				</div>
				<div class = "form-group">
					<div  class="row justify-content-center align-items-center">
					<label for='horario' class='col-sm-2 col-form-label col-form-label-lg' id='l1' style='display:none'>Horário:</label>
					
					<div class="col-sm-6">
					<!--não quebrar essa linha abaixo<-->
					
					<select  name="horario" id="horario" style="display:none"><option value="0">Escolha um Horário</option></select>
					</div>
					</div>
					</div>
					<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="data_aula" class="col-sm-2 col-form-label col-form-label-lg">Data da Aula:</label>
						<div class="col-sm-6">
							<input type="date" name="data_aula" class="form-control form-control-lg" id="data_aula" placeholder="" value="<?php if($_POST) echo $_POST['data_aula'];?>" required>
						</div>
					</div>
				</div>
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="observacao" class="col-sm-2 col-form-label col-form-label-lg">Observação:</label>
						<div class="col-sm-6">
							<textarea class="form-control form-control-lg" name="observacao"><?php if($_POST) echo $_POST['observacao'];?></textarea>
						</div>
					</div>
				</div>
					<div class = "form-group">
					<div class="row justify-content-center align-items-center">

					<input type="submit" name="enviar"class = "btn btn-md btn-success col-sm-2" value = "Enviar">
					
				</div>
			</div>
		</form>
	</div>
</div>
	<script type="text/javascript" src="../lib/jquery.js"></script>
	<script>
	
	$(function(){
		$('#modalidade').change(function(){
		//Pega id da modalidade

		var idmodalidade = $(this).val();
		if(idmodalidade == 0)
		{
			limpar();
			alert("escolha uma modalidade");
		}
		else
		{
			//Função ajax
			$.ajax({
				type:"GET",
				url:"buscarHorario.php",
				data:"id=" + idmodalidade,
				dataType:"json",
				success:function(horario){
					
					limpar();
					document.getElementById("l1").style = "display:inline";
					document.getElementById("horario").style = "display:inline";
					var diasemana = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
					for(var x=0; x<horario.length;x++)
					{
						var option = document.createElement("option");
						option.setAttribute("value", horario[x].idhorario);
						option.appendChild(document.createTextNode(diasemana[horario[x].dia_semana] + " - Das " + horario[x].horario_inicio + " às " + horario[x].horario_fim));
						document.getElementById("horario").appendChild(option);
					}
				},
				error:function(){
					alert("Falha!!!");
				}
			});
		}
	});
});
function limpar()
{
		var filhos = document.getElementById("horario").childNodes.length;
		if(filhos > 1)
		{
			for(var x=0; x<filhos-1; x++)
			{
				var elem = document.getElementById("horario").lastChild;
				document.getElementById("horario").removeChild(elem);
			}
			document.getElementById("l1").style = "display:none";
			document.getElementById("horario").style = "display:none";
		}
}
	</script>
	</body>
</html>