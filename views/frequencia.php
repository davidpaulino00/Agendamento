<html>
 <?php
	require_once "cabecalho.php";
?>
 <div class="content">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<h2>Lista de Frequência</h2><br><br>
				</div><br><br>
				
				<table class="table table-striped"  width="50%" id="frequencia">
				
					<thead>
						<tr>
							
						
							<th style='text-align:center'>Modalidade </th>
							<th style='text-align:center'>Data aula </th>
							<th style='text-align:center'>Presença</th>
	
					  </tr>
					</thead>
					<tbody>
					<?php
						require_once "../models/conexao.class.php";
						require_once "../models/frequenciaDAO.class.php";
						require_once "../models/usuario.class.php";
						require_once "../models/aluno.class.php";
						
						//buscar produtos no BD
						$aluno= new aluno (null,null,null,null,null,$_SESSION['id']);
						
						
						$frequenciaDAO = new frequenciaDAO();
					
						$retorno = $frequenciaDAO->buscarFrequenciaModalidade($aluno);
			foreach($retorno as $dado)
			
			{
				echo "<tr>";
				
				echo "<td>{$dado->descritivo}</td>";
				
				
				$data = explode("-", $dado->data_aula);
				$dataA = $data[2] . "/" . $data[1] . "/" . $data[0];
				echo "<td style='text-align:center;'>{$dataA}</td>";
				
				if($dado->presenca == "S")
					$presenca = "Sim";
				else
					$presenca = "Não";
				
				echo "<td style='text-align:center;'>$presenca</td>";
                		
				
					
				
				echo "</tr>";
			}
							?>
		</div>
	</div>
	<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#frequencia tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#frequencia',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#frequencia tbody tr:visible").length != 0) {
						$("#frequencia").trigger("update");
						$("#frequencia").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>