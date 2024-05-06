<?php
    require "src/conexao-bd.php";
    require "src/Modelo/Aluno.Class.php";
    require "src/Repositorio/AlunoRepositorio.php";

    if(isset($_POST['id_aluno'])) {
        $id_aluno = $_POST['id_aluno'];

        $alunoRepositorio = new AlunoRepositorio($pdo);
        $alunoRepositorio->deletar($id_aluno);

        header("Location: admin-alunos.php");
    } 
?>