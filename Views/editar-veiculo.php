<?php
  require "src/conexao-bd.php";
  require "src/Modelo/Veiculo.Class.php";
  require "src/Repositorio/VeiculoRepositorio.php";

  $veiculoRepositorio = new VeiculoRepositorio($pdo);

  if (isset($_POST['editar'])) {
    $veiculo = new Veiculo($_POST['id_veiculo'], $_POST['modelo'], $_POST['categoria']);

    $veiculoRepositorio->atualizar($veiculo);
    header("Location: admin-veiculos.php");
} else {
    $veiculo = $veiculoRepositorio->buscar($_GET['id']);
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
    <title>Editar Veículo</title>
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
        <h1>Editar Veículo</h1>
        <img class= "ornaments" src="img/ornaments-cfc.png" alt="ornaments">
    </section>
    <section class="container-form">

        <form method="post" >
            <label for="modelo">Modelo</label>
            <input type="text" id="nome" name="modelo" placeholder="Digite o nome do veículo" value="<?= $veiculo->getModelo() ?>" required>
            <div class="container-select">
                <div>
                    <h4>Categoria</h4>
                </div>
                <div>
                    <input type="radio" id="a" name="categoria" value="A" <?= $veiculo->getCategoria() == "A"? "checked" : "" ?>>
                    <label for="a">A</label>
                </div>
                <div>
                    <input type="radio" id="b" name="categoria" value="B" <?= $veiculo->getCategoria() == "B"? "checked" : "" ?>>
                    <label for="b">B</label>
                </div>
            </div>

            <input type="hidden" name="id_veiculo" value="<?= $veiculo->getIdVeiculo()?>">
            <input type="submit" name="editar" class="botao-cadastrar"  value="Editar veículo"/>
        
        </form>

    </section>
</main>
</body>
</html>