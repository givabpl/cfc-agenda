<?php
// conexão bd
require "src/conexao-bd.php";
// classes
require "src/Modelo/Aluno.Class.php";
require "src/Repositorio/AlunoRepositorio.php";

$alunoRepositorio = new AlunoRepositorio($pdo);
$alunos = $alunoRepositorio->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Alunos</title>
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

<h1>Alunos</h1>
<section class="container-table">
    <table>
      <thead>
        <tr>
          <th>Aluno</th>
          <th>Categorias</th>
          <th>Observação</th>
          <th>Aulas Restantes</th>
          <th colspan="2">Ação</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($alunos as $aluno): ?>
          <tr>
            <td><?= $aluno->getNome() ?></td>
            <td><?= $aluno->getCategorias() ?></td>
            <td><?= $aluno->getObservacao() ?></td>
            <td><?= $aluno->getAulasRestantes() ?></td>

            <td><a class="botao-editar" href="editar-aluno.php?id=<?= $aluno->getId() ?>">Editar</a></td>

            <td>
              <form action="deletar-aluno.php" method="post">
                <input type="hidden" name="id_aluno" value="<?= $aluno->getId() ?>">
                <input type="submit" class="botao-excluir" value="Deletar">
              </form>
            </td>
              
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <a class="botao-cadastrar" href="cadastrar-aluno.php">Cadastrar aluno</a>
</section>
</body>
</html>

