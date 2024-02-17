<html>
 <?php
	require_once "cabecalho.php";
?>
 <div class="content">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<h2>Lista de Frequencia</h2><br><br>
				</div><br><br>
				
				<table class="table table-striped"  width="50%" id="frequencia">
				
					<thead>
						<tr>
							
						
							<th style='text-align:center'>Matricula </th>
							<th style='text-align:center'>Presenca</th>
							<th style='text-align:center'>Data aula </th>
							<th style='text-align:center'>Ações</th>
							
							
					  </tr>
					</thead>
					<tbody>
					<?php
						require_once "../models/conexao.class.php";
						require_once "../models/frequenciaDAO.class.php";
						
						//buscar produtos no BD
						$frequenciaDAO = new frequenciaDAO();
					
						$retorno = $frequenciaDAO->buscarTodosFrequencia();
			foreach($retorno as $dado)
			
			{
				echo "<tr>";
				
				echo "<td>{$dado->matricula_idmatricula}</td>";
				if($dado->presenca == "P")
					$presenca = "P";
				else
					$presenca = "F";
				
				echo "<td style='text-align:center;'>$presenca</td>";
                		
				echo "<td>{$dado->data_aula}</td>";
					echo "<td style='text-align:center;' ><a class='btn btn-warning btn-sm' href='edit_frequencia.php?id={$dado->idfrequencia}'>Alterar</a>&nbsp;&nbsp;";
					if($dado->presenca == "P")
					{
						echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_frequencia.php?id={$dado->idfrequencia}'>Presenca</a>";
						
					}
					else
					{
						echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_frequencia.php?id={$dado->idhorario}'>Falta</a>";
					}
					
				
			
				
				$presenca = "";
				
					
				echo "</td></tr>";
			}
							?>
</html>