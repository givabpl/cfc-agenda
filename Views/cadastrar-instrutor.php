<?php
// conexão bd
require "src/conexao-bd.php";
// classes
require "src/Modelo/Instrutor.Class.php";
// 
require "src/Repositorio/InstrutorRepositorio.php";
    // Verifica se o formulário foi enviado
    if (isset($_POST['cadastro']))
    {
        $instrutor = new Instrutor( null,
            $_POST['nome_instrutor'], 
            $_POST['categorias_instrutor'], 
            $_POST['observacao']
        );

      $instrutorRepositorio = new InstrutorRepositorio($pdo);
      $instrutorRepositorio->salvar($instrutor);
      
      header("Location: admin-instrutores.php");
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
    <title>Cadastrar Instrutor</title>
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
        <h1>Cadastro de Instrutores</h1>
        <img class= "ornaments" src="img/ornaments-cfc.png" alt="ornaments">
    </section>
    <section class="container-form">
        <form method="post">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome_instrutor" placeholder="Digite o nome do instrutor" required>
            
            <div class="container-select">
                <div>
                    <h4>Categorias</h4>
                </div>
                <div>
                    <input type="radio" id="a" name="categorias_instrutor" value="A" checked>
                    <label for="a">A</label>
                </div>
                <div>
                    <input type="radio" id="b" name="categorias_instrutor" value="B">
                    <label for="b">B</label>
                </div>
                <div>
                    <input type="radio" id="b" name="categorias_instrutor" value="AB">
                    <label for="ab">AB</label>
                </div>
            </div>
            <label for="observacao">Observação</label>
            <input type="text" id="observacao" name="observacao" placeholder="Digite uma observação"><br>

            <input type="submit" name="cadastro" class="botao-cadastrar" value="Cadastrar instrutor"/>
        </form>
    
    </section>
</main>

</body>
</html>