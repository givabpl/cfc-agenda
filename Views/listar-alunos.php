<?php
	require_once "cabecalho.php";
?>
	<div class="content">
		<div class="container">
			<?php
				if(isset($_GET["msg"]))
				{
					echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
				}
			?>
	  
			<br><br><h1 class="row justify-content-center align-items-center">Alunos</h1><br>
			<table class="table table-striped">
				<tr>
					<th>Categoria</th>
					<th>AR's</th>
					<th>Nome</th>
					<th>Celular</th>
					<th>Observações</th>
					<th>Ações</th>
				</tr>
				<?php
					foreach($alunos as $dado)
					{
						echo "<tr>
								<td>{$dado->categoria}</td>
								<td>{$dado->aulas_restantes}</td>
								<td>{$dado->nome_aluno}</td>
								<td>{$dado->celular_aluno}</td>
								<td>{$dado->obs_aluno}</td>
								<td>
									<a class='btn btn-warning' href='index.php?controle=alunoController&metodo=alterar&id={$dado->id_aluno}'>Alterar</a>
									&nbsp;&nbsp;
									<a class='btn btn-danger' href='index.php?controle=alunoController&metodo=excluir&id={$dado->id_aluno}'>Excluir</a>
									
									</td></tr>";
						}
				?>
			</table>

			<br>
			<a  class="btn btn-primary" href="index.php?controle=alunoController&metodo=inserir">Novo Aluno</a>&nbsp;&nbsp;&nbsp;
			<a  class="btn btn-primary" href="index.php?controle=alunoController&metodo=gerar-pdf">Lista de Alunos</a>
	</div>
</div>
<?php
	require_once "rodape.html";
?>