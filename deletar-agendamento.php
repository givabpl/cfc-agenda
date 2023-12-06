<?php
    require "src/conexao-bd.php";
    require "src/Modelo/Agendamento.Class.php";
    require "src/Repositorio/AgendamentoRepositorio.php";

    if(isset($_POST['id_agendamento'])) {
        $id_agendamento = $_POST['id_agendamento'];

        $agendamentoRepositorio = new AgendamentoRepositorio($pdo);
        $agendamentoRepositorio->deletar($id_agendamento);

        header("Location: admin.php");
    } 
?>