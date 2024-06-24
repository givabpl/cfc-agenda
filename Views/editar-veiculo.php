<?php
    require_once "cabecalho.php";

    /*
        $veiculoController = new veiculoController();

        if ($_POST) {
            $veiculoController->alterar();
        } else {
            $veiculoDAO = new veiculoDAO();
            $veiculo = $veiculoDAO->buscar_um_veiculo($_GET['id']);
        }
    */
?>

<div class="content">
    <div class="container">
        <form class="form-control" action="#" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $veiculo->getIdVeiculo(); ?>">

            <br><br>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria do Veículo</label>
                <select name="categoria" id="categoria">
                    <option value="0">Escolha uma categoria</option>
                    <?php
                    $categoriaDAO = new categoriaDAO();
                    $retorno = $categoriaDAO->buscar_categorias();
                    foreach ($retorno as $dado) {
                        if ($veiculo->getCategoriaVeiculo() == $dado->id_categoria) {
                            echo "<option value='{$dado->id_categoria}' selected>{$dado->descritivo}</option>";
                        } else {
                            echo "<option value='{$dado->id_categoria}'>{$dado->descritivo}</option>";
                        }
                    }
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[2] != "" ? $msg[2] : ''; ?></div>
            </div>

            <br><br>

            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $veiculo->getModelo(); ?>">
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>

            <br><br>

            <div class="mb-3">
                <label for="cor" class="form-label">Cor</label>
                <input type="text" class="form-control" id="cor" name="cor" value="<?php echo $veiculo->getCor(); ?>">
                <div style="color:red">
                    <?php echo $msg[1] != "" ? $msg[1] : ''; ?>
                </div>
            </div>

            <br><br>

            <input class="btn btn-primary" type="submit" value="Alterar">
        </form>
    </div>
</div>