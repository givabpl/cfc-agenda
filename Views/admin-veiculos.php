<?php
// conexão bd
require "src/conexao-bd.php";
// classes
require "src/Modelo/Veiculo.Class.php";
// 
require "src/Repositorio/VeiculoRepositorio.php";

$veiculoRepositorio = new VeiculoRepositorio($pdo);
$veiculos = $veiculoRepositorio->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Veículos</title>
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

<h1>Veículos</h1>
<section class="container-table">
    <table>
      <thead>
        <tr>
          <th>Modelo</th>
          <th>Categoria</th>
          <th colspan="2">Ação</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($veiculos as $veiculo): ?>
          <tr>
            <td><?= $veiculo->getModelo() ?></td>
            <td><?= $veiculo->getCategoria() ?></td>

            <td><a class="botao-editar" href="editar-veiculo.php?id=<?= $veiculo->getIdVeiculo() ?>">Editar</a></td>

            <td>
              <form action="deletar-veiculo.php" method="post">
                <input type="hidden" name="id_veiculo" value="<?= $veiculo->getIdVeiculo() ?>">
                <input type="submit" class="botao-excluir" value="Deletar">
              </form>
            </td>
              
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a class="botao-cadastrar" href="cadastrar-veiculo.php">Cadastrar veículo</a>
</section>
</body>
</html>

