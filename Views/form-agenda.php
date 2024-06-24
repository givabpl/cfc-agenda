<?php
    require_once "cabecalho.php";
?>

<div class="content">
    <div class="container">
        <form class="form-control" action="" method="POST">
            <br><br>
            <div class="mb-3">
                <label for="aluno" class="form-label">Aluno</label>
                <select name="aluno" id="aluno">
                    <option value="0">Escolha um aluno</option>
                    <?php
                    // buscar as alunos no BD
                    $alunoDAO = new alunoDAO();
                    $retorno = $alunoDAO->buscar_alunos();
                    
                    foreach ($retorno as $dado) 
                    {
                        if (isset($_POST["aluno"]) && $_POST["aluno"] == $dado->id_aluno) 
                        {
                            echo "<option value='{$dado->id_aluno}' selected>{$dado->nome_aluno}</option>";
                        } else 
                        {
                            echo "<option value='{$dado->id_aluno}'>{$dado->nome_aluno}</option>";
                        }
                    } // fim foreach
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>

            <br>

            <div class="mb-3">
                <label for="instrutor" class="form-label">Instrutor</label>
                <select name="instrutor" id="instrutor">
                    <option value="0">Escolha um instrutor</option>
                    <?php
                    // buscar instutores no BD
                    $instrutorDAO = new instrutorDAO();
                    $retorno = $instrutorDAO->buscar_instrutores();
                    
                    foreach ($retorno as $dado) 
                    {
                        if (isset($_POST["instrutor"]) && $_POST["instrutor"] == $dado->id_instrutor) 
                        {
                            echo "<option value='{$dado->id_instrutor}' selected>{$dado->nome_instrutor}</option>";
                        } else 
                        {
                            echo "<option value='{$dado->id_instrutor}'>{$dado->nome_instrutor}</option>";
                        }
                    } 
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>

            <br>

            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" id="data" name="data" class="form-control" required>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>

            <br>

            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora de Início</label>
                <select name="hora_inicio" id="hora_inicio" class="form-control" required>
                    <option value="">Escolha a hora de início</option>
                    <?php
                    foreach ($horariosDisponiveis as $horario) {
                        echo "<option value='{$horario->getHora()}'>{$horario->getHora()}</option>";
                    }
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>

            <br><br>

            <!-- Hora de Fim -->
            <div class="mb-3">
                <label for="hora_fim" class="form-label">Hora de Fim</label>
                <select name="hora_fim" id="hora_fim" class="form-control" required>
                    <option value="">Escolha a hora de fim</option>
                    <?php
                    foreach ($horariosDisponiveis as $horario) {
                        echo "<option value='{$horario->getHora()}'>{$horario->getHora()}</option>";
                    }
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>

            <br>


            <div class="mb-3">
                <label for="veiculo" class="form-label">Veículo</label>
                <select name="veiculo" id="veiculo">
                    <option value="0">Escolha um veículo</option>
                    <?php
                    // buscar as alunos no BD
                    $veiculoDAO = new veiculoDAO();
                    $retorno = $veiculoDAO->buscar_veiculos();
                    
                    foreach ($retorno as $dado) 
                    {
                        if (isset($_POST["veiculo"]) && $_POST["veiculo"] == $dado->id_veiculo) 
                        {
                            echo "<option value='{$dado->id_veiculo}' selected>{$dado->modelo}</option>";
                        } else 
                        {
                            echo "<option value='{$dado->id_veiculo}'>{$dado->modelo}</option>";
                        }
                    } // fim foreach
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>

            <br>

            <div class="mb-3">
                <label for="datahora_inicio" class="form-label">Data e Hora de Início</label>
                <input type="datetime-local" id="datahora_inicio" name="datahora_inicio" class="form-control" required>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>

            <br>

            <div class="mb-3">
                <label for="datahora_fim" class="form-label">Data e Hora de Fim</label>
                <input type="datetime-local" id="datahora_fim" name="datahora_fim" class="form-control" required>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>

            <input class="btn btn-primary" type="submit" value="Agendar">
        </form>
    </div>
</div>
<?php
    require_once "rodape.html";
?>
