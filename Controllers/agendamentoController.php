<?php
    date_default_timezone_set("America/Sao_Paulo");
    if(!isset($_SESSION))
    {
        session_start();
    }
    require_once "models/Conexao.class.php";
    require_once "models/Agendamento.class.php";
    require_once "models/agendamentoDAO.class.php";
    require_once "models/Aluno.class.php";
    require_once "models/alunoDAO.class.php";
    require_once "models/Veiculo.class.php";
    require_once "models/veiculoDAO.class.php";
    require_once "models/Instrutor.class.php";
    require_once "models/instrutorDAO.class.php";
    require_once "Models/Usuario.class.php";
    require_once "Models/Itens.class.php";

    class agendamentoController 
    {
        public function ciar_agendamento()
        {
            if(isset($_SESSION["idusuario"]))
            {
                $usuario = new Usuario($_SESSION["idusuario"]);
                $
            }
            return new Agendamento
            (
                $dados['id_agendamento'],
                $dados['id_aluno'],
                $dados['nome_aluno'],
                $dados['data_aula'],
                $dados['hora_inicio'],
                $dados['hora_conclusao'],
                $dados['id_instrutor'],
                $dados['nome_instrutor'],
                $dados['id_veiculo'],
                $dados['categoria'],
                $dados['modelo']
            );
        }   
    }

