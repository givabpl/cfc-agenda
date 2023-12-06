<?php
require "src/conexao-bd.php";
require "src/Modelo/Agendamento.Class.php";
require "src/Modelo/Aluno.Class.php";
require "src/Modelo/Instrutor.Class.php";
require "src/Modelo/Veiculo.Class.php";

require "src/Repositorio/VeiculoRepositorio.php";
require "src/Repositorio/AgendamentoRepositorio.php";
require "src/Repositorio/AlunoRepositorio.php";
require "src/Repositorio/InstrutorRepositorio.php";


$alunoRepositorio = new ALunoRepositorio($pdo);
$alunos = $alunoRepositorio->buscarTodos();

$veiculoRepositorio = new VeiculoRepositorio($pdo);
$veiculos = $veiculoRepositorio->buscarTodos();

$instrutorRepositorio = new InstrutorRepositorio($pdo);
$instrutores = $instrutorRepositorio->buscarTodos();

if (isset($_POST['cadastro']))
    {
        $agendamento = new Agendamento(null,
            $_POST['id_aluno'],
            $_POST['nome_aluno'], 
            $_POST['data_aula'], 
            $_POST['hora_inicio'],
            $_POST['hora_conclusao'],
            $_POST['id_instrutor'],
            $_POST['nome_instrutor'],
            $_POST['id_veiculo'], 
            $_POST['categoria'], 
            $_POST['modelo']
        );

      $agendamentoRepositorio = new AgendamentoRepositorio($pdo);
      $agendamentoRepositorio->salvar($agendamento);
      
      header("Location: admin.php");
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
        <h1>Novo Agendamento</h1>
        <img class= "ornaments" src="img/ornaments-cfc.png" alt="ornaments">
    </section>

    <section class="container-form">
        <form method="post">

            <label for="id_aluno">Id Aluno:</label>
        
            <select name="id_aluno" id="aluno">
                <!-- Loop foreach para gerar as opções -->
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno->getId(); ?>">
                        <?= $aluno->getId(); ?>
                    </option>
                <?php endforeach; ?>
                <!-- Fim do loop foreach -->
            </select>

            <label for="nome_aluno">Nome Aluno:</label>
            <select name="nome_aluno" id="aluno">
                <!-- Loop foreach para gerar as opções -->
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno->getId(); ?>">
                        <?= $aluno->getNome(); ?>
                    </option>
                <?php endforeach; ?>
                <!-- Fim do loop foreach -->
            </select>

            <label for="data">Data:</label>
            <input type="date" name="data_aula" id="data_aula" required>

            <label for="hora_inicio">Hora Início:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" required>

            <label for="hora_conclusao">Hora Conclusão:</label>
            <input type="time" name="hora_conclusao" id="hora_conclusao" required>


            <label for="id_aluno">Id Instrutor:</label>
        
            <select name="id_instrutor" id="instrutor">
                <!-- Loop foreach para gerar as opções -->
                <?php foreach ($instrutores as $instrutor): ?>
                    <option value="<?= $instrutor->getIdInstrutor(); ?>">
                        <?= $instrutor->getIdInstrutor(); ?>
                    </option>
                <?php endforeach; ?>
                <!-- Fim do loop foreach -->
            </select>

            <label for="id_instrutor">Instrutor:</label>
            <select name="nome_instrutor" id="instrutor">
                <!-- Loop foreach para gerar as opções -->

                <?php foreach ($instrutores as $instrutor): ?>
                    <option value="<?= $instrutor->getIdInstrutor(); ?>">
                        <?= $instrutor->getNome(); ?>
                    </option>
                <?php endforeach; ?>
                <!-- Fim do loop foreach -->
            </select>
  
            <label for="id_veiculo">Id Veiculo:</label>
        
            <select name="id_veiculo" id="veiculo">
                <!-- Loop foreach para gerar as opções -->
                <?php foreach ($veiculos as $veiculo): ?>
                    <option value="<?= $veiculo->getIdVeiculo(); ?>">
                        <?= $veiculo->getIdVeiculo(); ?>
                    </option>
                <?php endforeach; ?>
                <!-- Fim do loop foreach -->
            </select>

            <label for="veiculo">Categoria:</label>
            <select name="categoria" id="veiculo">
                <!-- Loop foreach para gerar as opções -->
                <?php foreach ($veiculos as $veiculo): ?>
                    <option value="<?= $veiculo->getIdVeiculo(); ?>">
                        <?= $veiculo->getCategoria(); ?>
                    </option>
                <?php endforeach; ?>
                <!-- Fim do loop foreach -->
            </select>

            <label for="veiculo">Veículo:</label>
            <select name="modelo" id="veiculo">
                <!-- Loop foreach para gerar as opções --> <!-- produto loja-->
                <?php foreach ($veiculos as $veiculo): ?>
                    <option value="<?= $veiculo->getIdVeiculo(); ?>"> 
                        <?= $veiculo->getModelo(); ?>
                    </option>
                <?php endforeach; ?>
                <!-- Fim do loop foreach -->
            </select>

            
            <input type="submit" name="cadastro" class="botao-cadastrar" value="Agendar"/>
        </form>
    </section>
</main>

</body>
</html>