 <html>
 <?php
	require_once "cabecalho.php";
?>
 <div class="content">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<h2>Lista de Professores</h2><br><br>
				</div><br><br>
				
				<table class="table table-striped"  width="50%" id="professor">
				
					<thead>
						<tr>
							
							<th>Nome </th>
							<th style='text-align:center'>Telefone </th>
							<th style='text-align:center'>E-mail </th>
							<th style='text-align:center'>Situação </th>
							<th style='text-align:center'>Ações</th>
							
					  </tr>
					</thead>
					<tbody>
					<?php
						require_once "../models/conexao.class.php";
						require_once "../models/professorDAO.class.php";
						
						//buscar produtos no BD
						$professorDAO = new professorDAO();
					
						$retorno = $professorDAO->buscarTodosProfessores();
						if(count($retorno) > 0)
						{
							foreach($retorno as $dado)
							{
								echo "<tr>";
								echo "<td>{$dado->nome}</td>";	
								if($dado->celular == "")
								{
									echo "<td style='text-align:center'>{$dado->telefone}</td>";
								}
								else
								{
									echo "<td style='text-align:center'>{$dado->celular}</td>";
								}
								echo "<td style='text-align:center'>{$dado->email}</td>";
								if($dado->situacao == "S")
								{
									echo "<td style='text-align:center'>Ativo</td>";
								}
								else
								{
									echo "<td style='text-align:center'>Inativo</td>";
								}
								echo "<td style='text-align:center'><a class='btn btn-warning btn-sm' href='edit_professor.php?id={$dado->idprofessor}&titulo=Professor'>Alterar</a>&nbsp;&nbsp;";
								if($dado->situacao == "S")
								{
									echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_usuario.php?id={$dado->idusuario}&sit=N&pag=professor'>Inativar</a>";
									
								}
								else
								{
									echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_usuario.php?id={$dado->idusuario}&sit=S&pag=professor'>Ativar</a>";
								}
								
								echo "&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='detalhesProfessor.php?id={$dado->idprofessor}'>Detalhes</a></td>";
								echo "</tr>";
							}
						}
					?>
					</form>
					</tbody>
				</table>
				<br><a href="form_professor.php?titulo=Professor" class="btn btn-lg btn-success">Novo Professor</a>
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#professor tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#professor',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#professor tbody tr:visible").length != 0) {
						$("#professor").trigger("update");
						$("#professor").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>