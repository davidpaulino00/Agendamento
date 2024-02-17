<?php
	date_default_timezone_set('America/Sao_Paulo');
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/modalidade.class.php";
	require_once "../models/modalidadeDAO.class.php";
	require_once "../models/usuario.class.php";
	require_once "../models/aluno.class.php";
	require_once "../models/alunoDAO.class.php";
	require_once "../models/matriculaDAO.class.php";
	require_once "../models/matricula.class.php";
	require_once "../models/horario.class.php";
	require_once "../models/professor.class.php";
	require_once "../models/frequencia.class.php";
	require_once "../models/frequenciaDAO.class.php";
	
	
	if($_POST)
	{
		
		$erro =0;
		
		if($_POST["dataaula"] == "")
		{
			echo "<script>alert('Data da Aula deve ser preenchida');</script>";
			$erro++;
		}
		if($_POST["modalidade"]  == 0)
		{
			echo "<script>alert('Escolha uma modalidade');</script>";
			$erro++;
		}
		if($_POST["horario"]  == 0)
		{
			echo "<script>alert('Escolha um horário');</script>";
			$erro++;
		}
		
		if($erro == 0)
		{
			if(strtotime($_POST["dataaula"]) > strtotime(date("Y-m-d")))
			{
				echo "<script>alert('A data da aula não pode ser maior que a data do dia');</script>";
				$erro++;
			}
		}
		if($erro == 0)
		{
			//gravar frequencia
			$frequencia = new frequencia(null, $_POST["dataaula"]);
			
			foreach($_POST["idmatricula"] as $dado)
			{
				$presente = false;
				if(isset($_POST["presenca"]))
				{
					foreach($_POST["presenca"] as $p)
					{
						if($dado == $p)
						{
							$presente = true;
							break;
						}
					}
				}
				if($presente)
				{
					$frequencia->setPresenca("S");
				}
				else
				{
					$frequencia->setPresenca("N");
				}
				
				$matricula = new matricula($dado);
				$frequencia->setMatricula($matricula);
				$frequenciaDAO= new frequenciaDAO();
				$frequenciaDAO->excluir($frequencia);
				$retorno = $frequenciaDAO->inserir($frequencia);
			}
		}
			
	}//ifpost
	
?>
<div class="content">
	<div class="container">
	<div  class="row justify-content-center align-items-center">
		<div style="color:green"><?php if($_POST && $erro == 0) echo "<h3>$retorno</h3>";?></div>
	</div>
		<form action="#" method="POST">
			
			<div class="row justify-content-center align-items-center">	
				<h2>Frequência</h2>
			</div><br><br>
			<div class="box">
				<div class = "form-group">
					<div class="row justify-content-center align-items-center">
  
						<label for="dataaula" class="col-sm-2 col-form-label col-form-label-lg">Data da Aula:</label>
						<div class="col-sm-6">
							<input type="date" name="dataaula" required class="form-control form-control-lg" id="dataaula" placeholder="" >
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
					if($_SESSION["perfil"] == "Administrador")
					{
						$ret = $modalidadeDAO->buscarTodasModalidades();
					}
					else if($_SESSION["perfil"] == "Professor")
					{
						$professor = new professor(null, null, $_SESSION["id"]);
						$ret = $modalidadeDAO->buscarTodasModalidadesProfessor($professor);
					}
					
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
				
				
			</div>
			
			<!--não quebrar a linha 90-->	
			<table class="table table-striped table-bordered"  id="alunos"><thead><tr id="th"></tr></thead><tbody id="td"></tbody></table>
			<br><br><input class='btn btn-success btn-lg'type="submit" value="Enviar">
		</form>
	</div>
</div>
	<script type="text/javascript" src="../lib/jquery.js"></script>
	<script>
	var idmodalidade = 0;
	var idhorario = 0;
	$(function(){
		$('#modalidade').change(function(){
		//Pega id da modalidade

		idmodalidade = $(this).val();
		var dataaula = document.getElementById("dataaula").value;
		if(dataaula == "")
		{
			alert("Preencha a Data da aula");
			location.reload();
		}
		else if(idmodalidade == 0)
		{
			limpar("horario");
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
					
					limpar("horario");
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
			
			$('#horario').change(function(){
				//Pega id da horario

				idhorario = $(this).val();
				var dataaula = document.getElementById("dataaula").value;
				if(dataaula == "")
				{
					
					alert("Preencha a Data da aula");
					location.reload();
				}else if(idhorario == 0)
				{
					limpar("alunos");
					alert("escolha um horário");
				}
				else
				{
				$.ajax({
				type:"GET",
				url:"buscarAlunos.php",
				data:"idm=" + idmodalidade + "&idh=" + idhorario + "&dataaula=" + dataaula,
				dataType:"json",
				success:function(alunos){
					
					limpar("alunos");
					if(alunos.length > 0)
					{
						var th1 = document.createElement("th");
						var texth1 = document.createTextNode("Alunos");
						th1.appendChild(texth1);
						
						var th2 = document.createElement("th");
						var texth2 = document.createTextNode("Presença");
						th2.appendChild(texth2);
						document.getElementById("th").appendChild(th1);
						document.getElementById("th").appendChild(th2);
						
						for(var x=0; x<alunos.length;x++)
						{
							var tr = document.createElement("tr");
							var td1 = document.createElement("td");
							var texto = document.createTextNode(alunos[x].nome);
							td1.appendChild(texto);
							
							var td2 = document.createElement("td");
							var input = document.createElement("input");
							input.setAttribute("type", "checkbox");
							input.setAttribute("name", "presenca[]");
							input.setAttribute("value", alunos[x].idmatricula);
							if(alunos.keys("presenca"))
								if(alunos[x].presenca == "S")
									input.setAttribute("checked", true);
							
							td2.appendChild(input);
							
							
							var input2 =  document.createElement("input");
							
							input2.setAttribute("value", alunos[x].idmatricula);
							input2.setAttribute("type", "hidden");
							input2.setAttribute("name", "idmatricula[]");
							
							tr.appendChild(input2);
							
							tr.appendChild(td1);
							tr.appendChild(td2);
							document.getElementById("td").appendChild(tr);
							
							
						}
					}
				},
				error:function(){
					alert("Falha!!!");
				}
			});
		}
	});
});

function limpar(qual)
{
	if(qual == "horario")
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
	if(qual == "alunos")
	{
		var filhosth = document.getElementById("th").childNodes.length;
		
		for(var x=0; x<filhosth; x++)
		{
				var elem = document.getElementById("th").lastChild;
				document.getElementById("th").removeChild(elem);
		}
		var filhostd = document.getElementById("td").childNodes.length;
		for(var x=0; x<filhostd; x++)
		{
				var elem = document.getElementById("td").lastChild;
				document.getElementById("td").removeChild(elem);
		}	
		
		
	}
}

	</script>
	</body>
</html>