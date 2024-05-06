<?php
// Conexão ao banco de dados
require "src/conexao-bd.php";
require "src/Modelo/Agendamento.Class.php";
require "src/Repositorio/AgendamentoRepositorio.php";

// instância do repositório de agendamentos
$agendamentoRepositorio = new AgendamentoRepositorio($pdo);
$agendamentos = $agendamentoRepositorio->buscarTodos();

?>

<!-- HTML para exibir os agendamentos -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/body.css">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Agenda</title>
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
    
    <section class="container-table">
        <table>
            <thead>
            <tr>
                <th>Aluno</th>
                <th>Data</th>
                <th>Hora Início</th>
                <th>Hora Conclusão</th>
                <th>Instrutor</th>
                <th>Veículo</th>
                <th>Categoria</th>
                <th>Modelo</th>
                <th colspan="2">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($agendamentos as $agendamento): ?>
                <tr>
                    <td><?= $agendamento->getAluno()->getNome(); ?></td>
                    <td><?= $agendamento->getDataAula(); ?></td>
                    <td><?= $agendamento->getHoraInicio(); ?></td>
                    <td><?= $agendamento->getHoraConclusao(); ?></td>
                    <td><?= $agendamento->getInstrutor()->getNome(); ?></td>
                    <td><?= $agendamento->getVeiculo()->getModelo(); ?></td>
                    <td><?= $agendamento->getVeiculo()->getCategoria(); ?></td>
                    <td><?= $agendamento->getVeiculo()->getModelo(); ?></td>
                    <td><a class="botao-editar" href="editar-agendamento.php?id=<?= $agendamento->getIdAgendamento() ?>">Editar</a></td>
                    <td>
                        <form action="deletar-agendamento.php" method="post">
                            <input type="hidden" name="id_agendamento" value="<?= $agendamento->getIdAgendamento() ?>">
                            <input type="submit" class="botao-excluir" value="Deletar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a class="botao-cadastrar" href="criar-agendamento.php">Novo Agendamento</a>
    </section>
</body>
</html>
