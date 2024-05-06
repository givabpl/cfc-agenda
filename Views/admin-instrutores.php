<?php
// conexão bd
require "src/conexao-bd.php";
// classes
require "src/Modelo/Instrutor.Class.php";
// 
require "src/Repositorio/InstrutorRepositorio.php";

$instrutorRepositorio = new InstrutorRepositorio($pdo);
$instrutores = $instrutorRepositorio->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Instrutores</title>
</head>
<body>
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

<h1>Instrutores</h1>
<section class="container-table">
    <table>
      <thead>
        <tr>
          <th>Instrutor</th>
          <th>Categorias</th>
          <th>Observação</th>
          <th colspan="2">Ação</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($instrutores as $instrutor): ?>
          <tr>
            <td><?= $instrutor->getNome() ?></td>
            <td><?= $instrutor->getCategorias() ?></td>
            <td><?= $instrutor->getObservacao() ?></td>

            <td><a class="botao-editar" href="editar-instrutor.php?id=<?= $instrutor->getIdInstrutor() ?>">Editar</a></td>

            <td>
              <form action="deletar-instrutor.php" method="post">
                <input type="hidden" name="id_instrutor" value="<?= $instrutor->getIdInstrutor() ?>">
                <input type="submit" class="botao-excluir" value="Deletar">
              </form>
            </td>
              
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <a class="botao-cadastrar" href="cadastrar-instrutor.php">Cadastrar instrutor</a>
</section>
</body>
</html>

