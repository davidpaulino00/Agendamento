<html>
 <?php
	require_once "cabecalho.php";
	require_once "../models/conexao.class.php";
	require_once "../models/usuario.class.php";
	require_once "../models/usuarioDAO.class.php";
	require_once "../models/faixaDAO.class.php";
	require_once "../models/faixa.class.php";
?>
 <div class="content">
			<div class="container">
			 
				<h2>Usuários</h2><br><br>
				
				<table class="table-striped" width="60%"  id="usuario">
				
					<thead>
						<tr>
							<th>Nome :  </th>
							<th>E-mail : </th>
							<th>Senha :  </th>
							
							<th>Perfil :  </th>
							
							
							<th style='text-align:center'>Ações</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						require_once "../models/conexao.class.php";
						require_once "../models/usuarioDAO.class.php";
						//buscar produtos no BD
						$usuarioDAO = new usuarioDAO();
					
						$retorno = $usuarioDAO->buscarTodosUsuario();
						if(count($retorno) > 0)
						{
							foreach($retorno as $dado)
							{
								echo "<tr>";
								echo "<td>{$dado->nome}</td>";
								
								echo "<td>{$dado->email}</td>";
								
								echo "<td>{$dado->senha}</td>";
								
								
								
								
								
							    echo "<td>{$dado->perfil}</td>";
								
								
								
								echo "<td><a class='btn btn-warning btn-sm' href='alterarUsuario.php?id={$dado->idusuario}'>Alterar</a></td>";

								echo "</tr>";
							}
						}
					?>
					</form>
					</tbody>
				</table>
				<br><a href="usuarionovo.php" class="btn btn-lg btn-success">Novo Usuário</a>
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#usuario tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#usuario',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#usuario tbody tr:visible").length != 0) {
						$("#usuario").trigger("update");
						$("#usuario").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>