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
	  
		<br><br><h1 class="row justify-content-center align-items-center">Veículos</h1><br>
		<table class="table table-striped">
			<tr>
                <th>Categoria</th>
				<th>Modelo</th>
				<th>Cor</th>
			</tr>
			<?php
				
				
				foreach($veiculos as $dado)
				{
					echo "<tr>
							<td>{$dado->categoria}</td>
							<td>{$dado->modelo}</td>
                            <td>{$dado->cor}</td>
							<td>
								<a class='btn btn-warning' href='index.php?controle=veiculoController&metodo=alterar&id={$dado->id_veiculo}'>Alterar</a>
								&nbsp;&nbsp;
								<a class='btn btn-danger' href='index.php?controle=veiculoController&metodo=excluir&id={$dado->id_veiculo}'>Excluir</a>
								
								</td></tr>";
					}
			?>
		</table>
		<br>
		<a  class="btn btn-primary" href="index.php?controle=veiculoController&metodo=inserir">Novo Veículo</a>&nbsp;&nbsp;&nbsp;
		<a  class="btn btn-primary" href="index.php?controle=veiculoController&metodo=gerar-pdf">Lista de Veículos</a>
		
	</div>
</div>
<?php
	require_once "rodape.html";
?>