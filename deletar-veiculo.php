<?php
    require "src/conexao-bd.php";
    require "src/Modelo/Veiculo.Class.php";
    require "src/Repositorio/VeiculoRepositorio.php";

    if(isset($_POST['id_veiculo'])) {
        $id_veiculo = $_POST['id_veiculo'];

        $veiculoRepositorio = new VeiculoRepositorio($pdo);
        $veiculoRepositorio->deletar($id_veiculo);

        header("Location: admin-veiculos.php");
    } 
?>