<?php
    require_once "cabecalho.php";
?>

<div class="content">
    <div class="container">
        <form class="form-control" action="#" method="POST" enctype="multipart/form-data">
            <br><br>
            
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria do Veículo</label>
                <select name="categoria" id="categoria">
                    <option value="0">Escolha uma categoria</option>
                    <?php
						//buscar as categorias no BD
						$categoriaDAO = new categoriaDAO();
						$retorno = $categoriaDAO->buscar_categorias();
						foreach($retorno as $dado)
						{
							if(isset($_POST["categoria"]) && $_POST["categoria"] == $dado->id_categoria)
							{
								echo "<option value='		{$dado->id_categoria}' selected>{$dado->descritivo}</option>";
							}
							else
							{
								echo "<option value='		{$dado->id_categoria}'>{$dado->descritivo}</option>";
							}
						}//fim foreach
					?>
                </select>
                <div style="color:red"><?php echo $msg[0] != "" ? $msg[0] : ''; ?></div>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo isset($_POST['modelo']) ? $_POST['modelo'] : '' ?>">
                <div style="color:red">
                    <?php echo $msg[1] != "" ? $msg[1] : ''; ?>
                </div>
            </div>
            <br><br>
            <div class="mb-3">
                <label for="cor" class="form-label">Cor</label>
                <input type="text" class="form-control" id="cor" name="cor" value="<?php echo isset($_POST['cor']) ? $_POST['cor'] : '' ?>">
                <div style="color:red">
                    <?php echo $msg[2] != "" ? $msg[2] : ''; ?>
                </div>
            </div>
            <br><br>
            
            <br><br>
            <input class="btn btn-primary" type="submit" value="Cadastrar">
        </form>
    </div>
</div>
<?php
    require_once "rodape.html";
?>