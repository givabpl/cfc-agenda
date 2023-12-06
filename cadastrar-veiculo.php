<?php
// conexão bd
require "src/conexao-bd.php";
// classes
require "src/Modelo/Veiculo.Class.php";
require "src/Repositorio/VeiculoRepositorio.php";
    // Verifica se o formulário foi enviado
    if (isset($_POST['cadastro']))
    {
        $veiculo = new Veiculo( null,
            $_POST['modelo'], 
            $_POST['categoria']
        );

      $veiculoRepositorio = new VeiculoRepositorio($pdo);
      $veiculoRepositorio->salvar($veiculo);
      
      header("Location: admin-veiculos.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/form.css">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Cadastrar Veículo</title>
</head>
<body>
<main>
    <header>
            <nav>
                <ul>
                    <li>
                        <a href="admin.php">
                            <img src="img/cfc-agenda-logo.png" alt="logo cfc agenda">
                        </a>
                    </li>
                    <li><a href="admin-alunos.php">Alunos</a></li>
                    <li><a href="admin-instrutores.php">Instrutores</a></li>
                    <li><a href="admin-veiculos.php">Veículos</a></li>
                </ul>
            </nav>
    </header>

    <section class="container-admin-banner">
        <img src="img/logo-cfc-agenda-horizontal.png" class="logo-admin" alt="logo-cfc-agenda">
        <h1>Cadastro de Veículos</h1>
        <img class= "ornaments" src="img/ornaments-cfc.png" alt="ornaments">
    </section>
    <section class="container-form">
        <form method="post">

            <label for="modelo">Modelo</label>
            <input type="text" id="nome" name="modelo" placeholder="Digite o modelo do veículo" required>
            <div class="container-select">
                <div>
                    <h4>Categoria</h4>
                </div>
                <div>
                    <input type="radio" id="a" name="categoria" value="A" checked>
                    <label for="a">A</label>
                </div>
                <div>
                    <input type="radio" id="b" name="categoria" value="B">
                    <label for="b">B</label>
                </div>
            </div>

            <input type="submit" name="cadastro" class="botao-cadastrar" value="Cadastrar veículo"/>
        </form>
    
    </section>
</main>

</body>
</html>