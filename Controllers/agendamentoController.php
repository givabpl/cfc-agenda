<?php
    if(!isset($_SESSION))
        session_start();
    
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
    require_once "Models/usuarioDAO.class.php";

    class agendamentoController
    {
        // INSERIR 
        public function inserir()
        {
            $msg = array("", "", "", "", "");
            if ($_POST) {
                $erro = false;
                if (empty($_POST["aluno"])) {
                    $msg[0] = "Selecione um aluno";
                    $erro = true;
                }
                if (empty($_POST["instrutor"])) {
                    $msg[1] = "Selecione um instrutor";
                    $erro = true;
                }
                if (empty($_POST["veiculo"])) {
                    $msg[2] = "Selecione um veículo";
                    $erro = true;
                }
                if (empty($_POST["data_ag"])) {
                    $msg[3] = "Selecione uma data";
                    $erro = true;
                }
                if (empty($_POST["horario"])) {
                    $msg[4] = "Selecione um horário";
                    $erro = true;
                }
    
                if (!$erro) 
                {
                    $alunoDAO = new alunoDAO();
                    $instrutorDAO = new instrutorDAO();
                    $veiculoDAO = new veiculoDAO();
    
                    $aluno = $alunoDAO->buscar_um_aluno($_POST["aluno"]);
                    $instrutor = $instrutorDAO->buscar_um_instrutor($_POST["instrutor"]);
                    $veiculo = $veiculoDAO->buscar_um_veiculo($_POST["veiculo"]);
    
                    $agendamento = new Agendamento( aluno: $aluno, instrutor: $instrutor, veiculo: $veiculo, data_ag: $_POST["data_ag"], horario: $_POST["horario"]
                    );
    
                    $agendamentoDAO = new agendamentoDAO();
                    $ret = $agendamentoDAO->criar_agendamento($agendamento);
                    header("location:index.php?controle=agendamentoController&metodo=listar&msg=$ret");
                }
            }
            require_once "Views/form-agenda.php";
        }
    
        // BUSCAR
        public function buscar_agendamentos()
        {
            $agendamentoDAO = new agendamentoDAO();
            $retorno = $agendamentoDAO->buscar_agendamentos();
            return $retorno;
        }
    
        // LISTAR
        public function listar()
        {
            if (!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Secretaria") {
                header("location:index.php");
            }
            $alunoDAO = new alunoDAO();
            $instrutorDAO = new instrutorDAO();
            $veiculoDAO = new veiculoDAO();
            $agendamentoDAO = new agendamentoDAO();
            $retorno = $agendamentoDAO->buscar_agendamentos();
            require_once "Views/listar-agendamentos.php";
        }

        // EXCLUIR
        public function excluir()
        {
            if (isset($_GET["id"])) 
            {
                $agendamentoDAO = new agendamentoDAO();
                $ret = $agendamentoDAO->excluir_agendamento($_GET["id"]);
                header("location:index.php?controle=agendamentoController&metodo=listar&msg=$ret");
            }
        }

        // ALTERAR
        public function alterar()
        {
            if (isset($_GET["id"])) {
                $agendamentoDAO = new agendamentoDAO();
                $agendamento = $agendamentoDAO->buscar_agendamento_por_id($_GET["id"]);
            }

            $msg = array("", "", "", "", "");
            if ($_POST) {
                $erro = false;
                if (empty($_POST["aluno"])) {
                    $msg[0] = "Selecione um aluno";
                    $erro = true;
                }
                if (empty($_POST["instrutor"])) {
                    $msg[1] = "Selecione um instrutor";
                    $erro = true;
                }
                if (empty($_POST["veiculo"])) {
                    $msg[2] = "Selecione um veículo";
                    $erro = true;
                }
                if (empty($_POST["data_ag"])) {
                    $msg[3] = "Selecione uma data";
                    $erro = true;
                }
                if (empty($_POST["horario"])) {
                    $msg[4] = "Selecione um horário";
                    $erro = true;
                }

                if (!$erro) {
                    $alunoDAO = new alunoDAO();
                    $aluno = $alunoDAO->buscar_um_aluno($_POST["aluno"]);

                    $instrutorDAO = new instrutorDAO();
                    $instrutor = $instrutorDAO->buscar_um_instrutor($_POST["instrutor"]);

                    $veiculoDAO = new veiculoDAO();
                    $veiculo = $veiculoDAO->buscar_um_veiculo($_POST["veiculo"]);

                    $agendamento = new Agendamento(
                        aluno: $aluno,
                        instrutor: $instrutor,
                        veiculo: $veiculo,
                        data_ag:$_POST["data_ag"],
                        horario:$_POST["horario"]
                    );

                    $agendamentoDAO = new agendamentoDAO();
                    $ret = $agendamentoDAO->atualizar_agendamento($agendamento);
                    header("location:index.php?controle=agendamentoController&metodo=listar&msg=$ret");
                }
            }
            require_once "Views/editar-agendamento.php";
        }
    }