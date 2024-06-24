<?php
    require_once "cabecalho.php";
?>

<div class="content">
    <div class="container">
        <form class="form-control" action="#" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $aluno->getIdAluno(); ?>">

            <br><br>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria do Aluno</label>
                <select name="categoria" id="categoria">
                    <option value="0">Escolha uma categoria</option>
                    <?php
                    $categoriaDAO = new categoriaDAO();
                    $retorno = $categoriaDAO->buscar_categorias();
                    foreach ($retorno as $dado) {
                        if ($aluno->getCategoriaAluno() == $dado->idcategoria) {
                            echo "<option value='{$dado->idcategoria}' selected>{$dado->descritivo}</option>";
                        } else {
                            echo "<option value='{$dado->idcategoria}'>{$dado->descritivo}</option>";
                        }
                    }
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[4] != "" ? $msg[4] : ''; ?></div>
            </div>
            
            <br><br>

            <div class="mb-3">
                <label for="aulas_restantes" class="form-label">Aulas Restantes</label>
                <input type="number" class="form-control" name="aulas_restantes" id="aulas_restantes" value="<?php echo $aluno->getAulasRestantes(); ?>">
                <div style="color:red">
                    <?php echo $msg[1] != "" ? $msg[1] : ''; ?>
                </div>
            </div>
            
            <br><br>
            
            <div class="mb-3">
                <label for="nome_aluno" class="form-label">Nome do aluno</label>
                <input type="text" class="form-control" id="nome_aluno" name="nome_aluno" value="<?php echo $aluno->getNomeAluno(); ?>">
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>

            <br><br>
            
            <div class="mb-3">
                <label for="celular_aluno" class="form-label">Celular do aluno</label>
                <input type="text" class="form-control" id="celular_aluno" name="celular_aluno" value="<?php echo $aluno->getCelularAluno(); ?>">
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="obs_aluno" class="form-label">Observação</label>
                <textarea class="form-control" id="obs_aluno" name="obs_aluno"><?php echo $aluno->getObsAluno(); ?></textarea>
                <div style="color:red">
                    <?php echo $msg[0] != "" ? $msg[0] : ''; ?>
                </div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem" onchange="mostrar(this)" accept="image/png, image/jpeg">
                <div style="color:red"><?php echo $msg[5] != "" ? $msg[5] : ''; ?></div>
            </div>
            <br><br>
            <div class="mb-3">
                <?php if ($aluno->getImagem()): ?>
                    <img src="<?php echo $aluno->getImagem(); ?>" id="img" alt="Imagem do Aluno" style="width: 100px; height: auto;">
                <?php else: ?>
                    <img src="" id="img" alt="Pré-visualização da imagem">
                <?php endif; ?>
            </div>
            <br><br>
            <input class="btn btn-primary" type="submit" value="Alterar">
        </form>
    </div>
</div>

<script>
function mostrar(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('img').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
