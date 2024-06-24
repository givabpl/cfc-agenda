<?php
    require_once "cabecalho.php";
?>

<div class="content">
    <div class="container">
        <form class="form-control" action="#" method="POST">
            <input type="hidden" name="id" value="<?php echo $instrutor->getIdInstrutor(); ?>">
            <br><br>
            <div class="mb-3">
                <label for="nome_instrutor" class="form-label">Nome do instrutor</label>
                <input type="text" class="form-control" id="nome_instrutor" name="nome_instrutor" value="<?php echo $instrutor->getNomeInstrutor(); ?>">
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria do instrutor</label>
                <select name="categoria" id="categoria">
                    <option value="0">Escolha uma categoria</option>
                    <?php
                        $categoriaDAO = new categoriaDAO();
                        $retorno = $categoriaDAO->buscar_categorias();
                        foreach ($retorno as $dado) {
                            if ($aluno->getCategoriaAluno() == $dado->id_categoria) {
                                echo "<option value='{$dado->id_categoria}' selected>{$dado->descritivo}</option>";
                            } else {
                                echo "<option value='{$dado->id_categoria}'>{$dado->descritivo}</option>";
                            }
                        }
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[4] != "" ? $msg[4] : ''; ?></div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="celular_instrutor" class="form-label">Celular do instrutor</label>
                <input type="text" class="form-control" id="celular_instrutor" name="celular_instrutor" value="<?php echo $instrutor->getCelularInstrutor(); ?>">
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="obs_instrutor" class="form-label">Observação</label>
                <textarea class="form-control" id="obs_instrutor" name="obs_instrutor"><?php echo $instrutor->getObsInstrutor(); ?></textarea>
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>
            <br><br>
            <input class="btn btn-primary" type="submit" value="Alterar">
        </form>
    </div>
</div>