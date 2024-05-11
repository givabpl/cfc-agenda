<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>CFC Agenda</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">	
		<ul class='navbar-nav mr-auto'>
			<li class='nav-item'>
				<a href='index.php' class='nav-link'>Home</a>
			</li> 		
		</ul>
		<?php
			if(isset($_SESSION["id"]))
			{
				echo "<ul class='navbar-nav mr-auto'>
				
					  <li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=alunoController&metodo=listar'>Alunos</a>
				  </li>
				  
				  <li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=instrutorController&metodo=listar'>Instrutores</a>
				  </li>

                  <li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=veiculoController&metodo=listar'>Veículos</a>
				  </li>

                  <li class='nav-item bg-green'>
				  <a class='nav-link' href='index.php?controle=agendaController&metodo=inserir'>Novo Agendamento</a>
				  </li>

				  <li class='nav-item'>
                  <a class='nav-link' href='javascript:void(0)' onclick='signOut()'>Sair</a>
                  </li></ul>";
				  echo "<div class='my-2 my-lg-0'>
					  <ul class='navbar-nav mr-auto'>
					  <li class='nav-item'>
					  <span class='nav-link'>
					  Olá, {$_SESSION['nome']}
					  </span></li></ul></div>";
			}
			else
			{
				 echo "<div class='collapse navbar-collapse justify-content-end'>
					  <ul class='navbar-nav'>
						<li class='nav-item'>
							<span class='nav-link'><div id='meu-botao'></div></span>
						</li>
					</ul>
				</div>";
			}
			?>	
		</div>
	</nav>
</body>
</html>
