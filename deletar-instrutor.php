<?php
    require "src/conexao-bd.php";
    require "src/Modelo/Instrutor.Class.php";
    require "src/Repositorio/InstrutorRepositorio.php";

    if(isset($_POST['id_instrutor'])) {
        $id_instrutor = $_POST['id_instrutor'];

        $instrutorRepositorio = new InstrutorRepositorio($pdo);
        $instrutorRepositorio->deletar($id_instrutor);

        header("Location: admin-instrutores.php");
    } 
?>