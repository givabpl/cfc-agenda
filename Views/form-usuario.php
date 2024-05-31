<?php
	require_once "cabecalho.php";
?>
	<div class="content">
	  <div class="container">
	  <div><?php echo $mensagem;?></div>
		<h1>Cadastro de Gerência</h1>
		<form action="#" method="POST">
			<div class="mb-3">
				<label for="nome" class="form-label">Nome</label>
				<input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($_POST['nome'])?$_POST['nome']:''?>">
				<div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
			</div>
			<br>
			
			<div class="mb-3">
				<label for="email" class="form-label">E-mail</label>
				<input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''?>">
				<div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
			</div>
			<br>
			<div class="mb-3">
				<label for="senha" class="form-label">Senha</label>
				<input type="password" class="form-control" id="senha" name="senha">
				<div style="color:red"><?php echo $msg[2] != ""?$msg[2]:'';?></div>
			</div>
			<br>
			<div class="mb-3">
				<label for="confirma" class="form-label">Confirma a Senha</label>
				<input type="password" class="form-control" id="confirma" name="confirma">
				<div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
			</div>
			<br>
			
			<input class="btn btn-primary" type="submit" value="Cadastrar">
		</form>
	  </div>
	</div>
<?php
	require_once "rodape.html";
?>