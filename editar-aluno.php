<?php
  require "src/conexao-bd.php";
  require "src/Modelo/Aluno.Class.php";
  require "src/Repositorio/AlunoRepositorio.php";

  $alunoRepositorio = new AlunoRepositorio($pdo);

  if (isset($_POST['editar'])) {
    $aluno = new Aluno($_POST['id_aluno'], $_POST['nome_aluno'], $_POST['categorias_aluno'], $_POST['observacao'], $_POST['aulas_restantes']);

    $alunoRepositorio->atualizar($aluno);
    header("Location: admin-alunos.php");
    } else {
        $aluno = $alunoRepositorio->buscar($_GET['id']);
    }
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/form.css">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Editar Aluno</title>
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
        <h1>Editar Aluno</h1>
        <img class= "ornaments" src="img/ornaments-cfc.png" alt="ornaments">
    </section>
    <section class="container-form">

        <form method="post">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome_aluno" placeholder="Digite o nome do aluno" value="<?= $aluno->getNome() ?>" required>
            <div class="container-select">
                <div>
                    <h4>Categorias</h4>
                </div>
                <div>
                    <input type="radio" id="a" name="categorias_aluno" value="A" <?= $aluno->getCategorias() == "A"? "checked" : "" ?>>
                    <label for="a">A</label>
                </div>
                <div>
                    <input type="radio" id="b" name="categorias_aluno" value="B" <?= $aluno->getCategorias() == "B"? "checked" : "" ?>>
                    <label for="b">B</label>
                </div>
            </div>
            <label for="obnservacao">Observação</label>
            <input type="text" id="observacao" name="observacao" placeholder="Digite uma observação" value="<?= $aluno->getObservacao() ?>"><br>

            <label for="aulas_restantes">Aulas Restantes</label>
            <input type="number" value="20" name="aulas_restantes">

            <input type="hidden" name="id_aluno" value="<?= $aluno->getId()?>">
            <input type="submit" name="editar" class="botao-cadastrar"  value="Editar aluno"/>
        
        </form>

    </section>
</main>
</body>
</html>