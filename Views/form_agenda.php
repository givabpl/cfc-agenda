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
                <img class="ornaments" src="img/ornaments-cfc.png" alt="ornaments">
            </section>

            <section class="container-form">
                <form method="post">

                    <label for="id_aluno">Aluno:</label>
                    <select name="id_aluno" id="aluno">
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

                    <label for="id_instrutor">Instrutor:</label>
                    <select name="id_instrutor" id="instrutor">
                        <!-- Loop foreach para gerar as opções -->
                        <?php foreach ($instrutores as $instrutor): ?>
                            <option value="<?= $instrutor->getIdInstrutor(); ?>">
                                <?= $instrutor->getNome(); ?>
                            </option>
                        <?php endforeach; ?>
                        <!-- Fim do loop foreach -->
                    </select>

                    <label for="id_veiculo">Veículo:</label>
                    <select name="id_veiculo" id="veiculo">
                        <!-- Loop foreach para gerar as opções -->
                        <?php foreach ($veiculos as $veiculo): ?>
                            <option value="<?= $veiculo->getIdVeiculo(); ?>">
                                <?= $veiculo->getModelo(); ?>
                            </option>
                        <?php endforeach; ?>
                        <!-- Fim do loop foreach -->
                    </select>

                    <label for="categoria">Categoria:</label>
                    <select name="categoria" id="categoria">
                        <!-- Loop foreach para gerar as opções -->
                        <?php foreach ($veiculos as $veiculo): ?>
                            <option value="<?= $veiculo->getCategoria(); ?>">
                                <?= $veiculo->getCategoria(); ?>
                            </option>
                        <?php endforeach; ?>
                        <!-- Fim do loop foreach -->
                    </select>

                    <input type="submit" name="cadastro" class="botao-cadastrar" value="Agendar"/>
                </form>
            </section>
        </main>

    </body>