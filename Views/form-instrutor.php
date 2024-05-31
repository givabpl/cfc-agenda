<?php
    require_once "cabecalho.php";
?>

<div class="content">
    <div class="container">
        <form class="form-control" action="#" method="POST">
            <div class="mb-3">
                <label for="nome_instrutor" class="form-label">Nome do instrutor</label>
                <input type="text" class="form-control" id="nome_instrutor" name="nome_instrutor" value="<?php echo isset($_POST['nome_instrutor']) ? $_POST['nome_instrutor'] : '' ?>">
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria do Aluno</label>
                <select name="categoria" id="categoria">
                    <option value="0">Escolha uma categoria</option>
                    <?php
                    // buscar as categorias no BD
                    $categoriaDAO = new categoriaDAO();
                    $retorno = $categoriaDAO->buscar_categorias();
                    foreach ($retorno as $dado) {
                        if (isset($_POST["categoria"]) && $_POST["categoria"] == $dado->idcategoria) {
                            echo "<option value='{$dado->idcategoria}' selected>{$dado->descritivo}</option>";
                        } else {
                            echo "<option value='{$dado->idcategoria}'>{$dado->descritivo}</option>";
                        }
                    } // fim foreach
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[4] != "" ? $msg[4] : ''; ?></div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="celular_instrutor" class="form-label">Celular do instrutor</label>
                <input type="text" class="form-control" id="celular_instrutor" name="celular_instrutor" value="<?php echo isset($_POST['celular_instrutor']) ? $_POST['celular_instrutor'] : '' ?>">
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="obs_instrutor" class="form-label">Observação</label>
                <textarea class="form-control" id="obs_instrutor" name="obs_instrutor"><?php echo isset($_POST['obs_instrutor']) ? $_POST['obs_instrutor'] : '' ?></textarea>
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Cadastrar">
        </form>
    </div>
</div>