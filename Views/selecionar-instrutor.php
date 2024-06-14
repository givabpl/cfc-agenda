<?php
	require_once "cabecalho.php";
?>
	<div class="content">
	  <div class="container">
	    <?php
			if(isset($_GET["msg"]))
			{
				echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
			}
	    ?>
	  
		<br><br>
        
        <h1 class="row justify-content-center align-items-center">Agendamentos</h1>

        <div class="mb-3">
            <label for="instrutor" class="form-label">Instrutor</label>
            <select name="instrutor" id="instrutor">
                <option value="0">Selecione um instrutor</option>
                <?php
                // buscar instrutores no BD
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
            <input class="btn btn-primary" type="submit" value="Ver agenda do instrutor">
	</div>
</div>
<?php
	require_once "rodape.html";
?>