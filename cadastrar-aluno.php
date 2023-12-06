<?php
// conexão bd
require "src/conexao-bd.php";
// classes
require "src/Modelo/Aluno.Class.php";
require "src/Repositorio/AlunoRepositorio.php";
    // Verifica se o formulário foi enviado
    if (isset($_POST['cadastro']))
    {
        $aluno = new Aluno(null,
            $_POST['nome_aluno'], 
            $_POST['categorias_aluno'], 
            $_POST['observacao'],
            $_POST['aulas_restantes']
        );

      $alunoRepositorio = new AlunoRepositorio($pdo);
      $alunoRepositorio->salvar($aluno);
      
      header("Location: admin-alunos.php");
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
    <title>Cadastrar Aluno</title>
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
        <h1>Cadastro de Alunos</h1>
        <img class= "ornaments" src="img/ornaments-cfc.png" alt="ornaments">
    </section>
    <section class="container-form">
        <form method="post">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome_aluno" placeholder="Digite o nome do aluno" required>
            <div class="container-select">
                <div>
                    <h4>Categorias</h4>
                </div>
                <div>
                    <input type="radio" id="a" name="categorias_aluno" value="A" checked>
                    <label for="a">A</label>
                </div>
                <div>
                    <input type="radio" id="b" name="categorias_aluno" value="B">
                    <label for="b">B</label>
                </div>
            </div>
            <label for="observacao">Observação</label>
            <input type="text" id="observacao" name="observacao" placeholder="Digite uma observação"><br>

            <label for="aulas_restantes">Aulas Restantes</label>
            <input type="number" value="20" name="aulas_restantes">

            <input type="submit" name="cadastro" class="botao-cadastrar" value="Cadastrar aluno"/>
        </form>
    
    </section>
</main>

</body>
</html>