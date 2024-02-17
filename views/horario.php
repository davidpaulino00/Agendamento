 <html>
 <?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/horarioDAO.class.php";
						
	//buscar agenda de aulas teste no BD
	$horarioDAO = new horarioDAO();
	$retorno = $horarioDAO->buscarHorarios();
	//var_dump($retorno);
?>
 <div class="content">
			<div class="container">
			 <?php
				if(is_array($retorno) && count($retorno) > 0)
				{
					$horario = array();
					$x = 0;
					foreach($retorno as $dado)
					{
						$horai = explode(":", $dado->horario_inicio);
						$horaf = explode(":", $dado->horario_fim);
						$horario[$x]["horai"] = $horai[0];
						$horario[$x]["horaf"] = $horaf[0];
						$horario[$x]["sem"] = $dado->dia_semana;
						$horario[$x]["prof"] = $dado->nome;
						$horario[$x]["mod"] = $dado->descritivo;
						$x++;
					}
					/*echo "<pre>";
					var_dump($horario);
					echo "</pre>";*/
			?>
				<div class="row justify-content-center align-items-center">
				<h2>Horários</h2></div><br><br>
				
				<table class="table table-striped table-bordered table-hover">
				
					<thead>
						<tr>
						    <th>Hora</th>
							<th>Segunda-Feira</th>
							<th>Terça-Feira</th>
							<th>Quarta-Feira</th>
							<th>Quinta-Feira</th>
							<th>Sexta-Feira</th>				
							<th>Sábado</th>					
					  </tr>
					</thead>
					<tbody>
					<?php
						for($lin=6; $lin<=22; $lin++)
					    {
							$y = array();
							//echo "<tr>								  <td>$lin:00</td>";
							
													
						    foreach($horario as $ind=>$dado)
							{
								if($dado["horai"] == $lin)
								{
									$y[] = $ind;
															
								}
								
								
							}
							//se quiser que apareça todos os horários mesmo que em banco tirar linha 69,70,71 e 96 e descomentar linha 55
							if(count($y) > 0)
							{
								echo "<tr>
								  <td>$lin:00</td>";
							for($z=1; $z<7; $z++)
							{
								$oi = "";
								
								for($k=0; $k < count($y); $k++)
								{
									if($z == $horario[$y[$k]]["sem"])
									{
										if($oi != "")
											$oi.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										$oi.= $horario[$y[$k]]["mod"];
										
									}
									
								}
								
									if($oi !="")
										echo "<td style='background-color:#E6E6FA;text-align:center;font-weight: bold;'>$oi</td>";
									else
										echo "<td>$oi</td>";
																
							}
							echo "</tr>";
							}
						}
							
						
					?>
					
					</tbody>
				</table>
				<?php
				}
				else
				{
					echo "<div class='row justify-content-center align-items-center'><h2>Não há horário cadastrado</h2></div>";
				}
				?>
			</div>
		</div>
	</body>
</html>