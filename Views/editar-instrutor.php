<?php
  require "src/conexao-bd.php";
  require "src/Modelo/Instrutor.Class.php";
  require "src/Repositorio/InstrutorRepositorio.php";

  $instrutorRepositorio = new InstrutorRepositorio($pdo);

  if (isset($_POST['editar'])) {
    $instrutor = new Instrutor($_POST['id_instrutor'], $_POST['nome_instrutor'], $_POST['categorias_instrutor'], $_POST['observacao']);

    $instrutorRepositorio->atualizar($instrutor);
    header("Location: admin-instrutores.php");
    } else {
        $instrutor = $instrutorRepositorio->buscar($_GET['id']);
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
    <title>Editar Instrutor</title>
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
        <h1>Editar Instrutor</h1>
        <img class= "ornaments" src="img/ornaments-cfc.png" alt="ornaments">
    </section>
    <section class="container-form">

        <form method="post" enctype="multipart/form-data">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome_instrutor" placeholder="Digite o nome do instrutor" value="<?= $instrutor->getNome() ?>" required>
            <div class="container-select">
                <div>
                    <h4>Categorias</h4>
                </div>
                <div>
                    <input type="radio" id="a" name="categorias_instrutor" value="A" <?= $instrutor->getCategorias() == "A"? "checked" : "" ?>>
                    <label for="a">A</label>
                </div>
                <div>
                    <input type="radio" id="b" name="categorias_instrutor" value="B" <?= $instrutor->getCategorias() == "B"? "checked" : "" ?>>
                    <label for="b">B</label>
                </div>
                <div>
                    <input type="radio" id="b" name="categorias" value="AB" <?= $instrutor->getCategorias() == "AB"? "checked" : "" ?>>
                    <label for="ab">AB</label>
                </div>
            </div>
            <label for="obnservacao">Observação</label>
            <input type="text" id="observacao" name="observacao" placeholder="Digite uma observação" value="<?= $instrutor->getObservacao() ?>"><br>

            <input type="hidden" name="id_instrutor" value="<?= $instrutor->getIdInstrutor()?>">
            <input type="submit" name="editar" class="botao-cadastrar"  value="Editar instrutor"/>
        
        </form>

    </section>
</main>
</body>
</html>