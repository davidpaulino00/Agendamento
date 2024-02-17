 <html>
 <?php
	require_once "cabecalho.php";
	require_once "funcao_acesso.php";
	if(!verificaAutorizacao())
		header("location:home.php");
?>
 <div class="content">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<h2>Lista de Alunos</h2><br><br>
				</div><br><br>
				
				<table class="table table-striped"  width="50%" id="aluno">
				
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
						require_once "../models/alunoDAO.class.php";
						
						//buscar produtos no BD
						$alunoDAO = new alunoDAO();
					
						$retorno = $alunoDAO->buscarTodosAlunos();
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
								echo "<td style='text-align:center'><a class='btn btn-warning btn-sm' href='edit_aluno.php?id={$dado->idaluno}&titulo=Aluno'>Alterar</a>&nbsp;&nbsp;";
								if($dado->situacao == "S")
								{
									echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_usuario.php?id={$dado->idusuario}&sit=N&pag=aluno'>Inativar</a>";
									
								}
								else
								{
									echo "<a class='btn btn-danger btn-sm' href='atualizar_situacao_usuario.php?id={$dado->idusuario}&sit=S&pag=aluno'>Ativar</a>";
								}
								
								echo "&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='detalhesAluno.php?id={$dado->idaluno}'>Detalhes</a>";
								if($dado->situacao == "N")
								{
									echo "&nbsp;&nbsp;<a class='btn btn-success btn-sm disabled' href='#' >Matricular</a></td>";
								}
								else
								{
								
									echo "&nbsp;&nbsp;<a class='btn btn-success btn-sm' href='listarMatricula.php?id={$dado->idaluno}'>Matricular</a></td>";
								}
								echo "</tr>";
							}
						}
					?>
					</form>
					</tbody>
				</table>
				<br><a href="form_aluno.php?titulo=Aluno" class="btn btn-lg btn-success">Novo Aluno</a>
			</div>
		</div>
		<script type="text/javascript" src="../lib/jquery-latest.js"></script>	
		<script type="text/javascript" src="../lib/jquery.quicksearch.js"></script>
		<script>
		$(document).ready(function()
		{ 
			 
			$("#aluno tbody tr").quicksearch({
				labelText: 'Procurar: ',
				attached: '#aluno',
				position: 'before',
				delay: 100,
				loaderText: 'Carregando...',
				onAfter: function() {
					if ($("#aluno tbody tr:visible").length != 0) {
						$("#aluno").trigger("update");
						$("#aluno").trigger("appendCache");
						
					}
				}
			});
		});
  </script>
	</body>
</html>