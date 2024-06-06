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
	  
		<br><br><h1 class="row justify-content-center align-items-center">Instrutores</h1><br>
		<table class="table table-striped">
			<tr>
                <th>Categoria</th>
				<th>Nome</th>
				<th>Celular</th>
                <th>Observações</th>
				<th>Ações</th>
			</tr>
			<?php
				
				
				foreach($instrutores as $dado)
				{
					echo "<tr>
							<td>{$dado->categoria}</td>
							<td>{$dado->nome_instrutor}</td>
                            <td>{$dado->celular_instrutor}</td>
                            <td>{$dado->obs_instrutor}</td>
							<td>
								<a class='btn btn-warning' href='index.php?controle=instrutorController&metodo=alterar&id={$dado->id_instrutor}'>Alterar</a>
								&nbsp;&nbsp;
								<a class='btn btn-danger' href='index.php?controle=instrutorController&metodo=excluir&id={$dado->id_instrutor}'>Excluir</a>
								
								</td></tr>";
					}
			?>
		</table>
		<br>
		<a  class="btn btn-primary" href="index.php?controle=instrutorController&metodo=inserir">Novo Instrutor</a>&nbsp;&nbsp;&nbsp;
		<a  class="btn btn-primary" href="index.php?controle=instrutorController&metodo=gerar-pdf">Lista de Instrutores</a>
		
	</div>
</div>
<?php
	require_once "rodape.html";
?>