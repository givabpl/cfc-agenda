<?php
    require_once "cabecalho.php";
?>

<div class="content">
    <div class="container">
        <form class="form-control" action="" method="POST" enctype="multipart/form-data">
            <br><br>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria do Aluno</label>
                <select name="categoria" id="categoria">
                    <option value="0">Escolha uma categoria</option>
                    <?php
                    // buscar as categorias no BD
                    $categoriaDAO = new categoriaDAO();
                    $retorno = $categoriaDAO->buscar_categorias();
                    
                    foreach ($retorno as $dado) 
                    {
                        if (isset($_POST["categoria"]) && $_POST["categoria"] == $dado->id_categoria) 
                        {
                            echo "<option value='{$dado->id_categoria}' selected>{$dado->descritivo}</option>";
                        } else 
                        {
                            echo "<option value='{$dado->id_categoria}'>{$dado->descritivo}</option>";
                        }
                    } // fim foreach
                    ?>
                </select>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="aulas_restantes" class="form-label">Aulas Restantes</label>
                <input type="number" class="form-control" name="aulas_restantes" id="aulas_restantes" value="<?php echo isset($_POST['aulas_restantes']) ? $_POST['aulas_restantes'] : '' ?>">
                <div style="color:red">
                    <?php echo $msg[1] != "" ? $msg[1] : ''; ?>
                </div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="nome_aluno" class="form-label">Nome do aluno</label>
                <input type="text" class="form-control" id="nome_aluno" name="nome_aluno" value="<?php echo isset($_POST['nome_aluno']) ? $_POST['nome_aluno'] : '' ?>">
                <div style="color:red">
                    <?php echo $msg[2] != "" ? $msg[2] : ''; ?>
                </div>
            </div>
            
            <br><br>
            <div class="mb-3">
                <label for="celular_aluno" class="form-label">Celular do aluno</label>
                <input type="text" class="form-control" id="celular_aluno" name="celular_aluno" value="<?php echo isset($_POST['celular_aluno']) ? $_POST['celular_aluno'] : '' ?>">
                <div style="color:red">
                    <?php echo $msg[3] != "" ? $msg[4] : ''; ?>
                </div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="obs_aluno" class="form-label">Observação</label>
                <textarea class="form-control" id="obs_aluno" name="obs_aluno"><?php echo isset($_POST['obs_aluno']) ? $_POST['obs_aluno'] : '' ?></textarea>
                <div style="color:red">
                    <?php echo $msg[4] != "" ? $msg[4] : ''; ?>
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
                <img src="" id="img" alt="Pré-visualização da imagem" style="width:170px;height:170px;">
            </div>
            <br><br>
            <input class="btn btn-primary" type="submit" value="Cadastrar">
        </form>
    </div>
</div>
<?php
    require_once "rodape.html";
?>

<script>
    function mostrar(img)
    {
        if(img.files  && img.files[0])
        {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#img')
                .attr('src', e.target.result)
                .width(170)
                .height(170);
            };
            reader.readAsDataURL(img.files[0]);
        }
    }
	</script>
