 <html>
 <?php
	require_once "cabecalho.php";
?>
 <div class="content">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<h2>Lista de Funcionários</h2><br><br>
				</div><br><br>
				
				<table class="table table-striped"  width="50%" id="funcionario">
				
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
						require_once "../models/usuarioDAO.class.php";
						require_once "../models/usuario.class.php";
						
						//buscar produtos no BD
						$usuario = new usuario();
						$usuario->setTipo("Funcionário");
						$usuarioDAO = new usuarioDAO();
					
						$retorno = $usuarioDAO->buscarTodosFuncionarios($usuario);
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
								echo "<td style='text-align:center'><a class='btn btn-warning btn-sm' href='edit_funcionario.php?id={$dado->idusuario}&titulo=Funcionário'>Alterar</a>&nbsp;&nbsp;";
								if($dado->situacao == "S")
								{
									echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_usuario.php?id={$dado->idusuario}&sit=N&&pag=funcionario'>Inativar</a>";
									
								}
								else
								{
									echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_usuario.php?id={$dado->idusuario}&sit=S&pag=funcionario'>Ativar</a>";
								}
								
								
								echo "</tr>";
							}
						}
					?>
					</form>
					</tbody>
				</table>
				<br><a href="form_funcionario.php?titulo=Funcionário" class="btn btn-lg btn-success">Novo Funcionário</a>
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#funcionario tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#funcionario',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#funcionario tbody tr:visible").length != 0) {
						$("#funcionario").trigger("update");
						$("#funcionario").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>