<?php
	require_once "cabecalho.php";
?>
<div class="content">
	  <div class="container">
		<h1>Identificação</h1><br>
		<form action="#" method="POST">
			<div class="mb-3">
				<label for="email" class="form-label">E-mail</label>
				<input type="email" class="form-control" id="email" name="email">
				<div style="color:red"><?php echo $msg1 != ""?$msg1:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="senha" class="form-label">Senha</label>
				<input type="password" class="form-control" id="senha" name="senha">
				<div style="color:red"><?php echo $msg2 != ""?$msg2:'';?></div>
			</div>
			<input class="btn btn-primary" type="submit" value="Enviar">
		</form>
	  </div>
	</div>
<?php
	require_once "rodape.html";
?>