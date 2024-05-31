<?php

    if(!isset($_SESSION))
        session_start(); 

    require_once "Models/Conexao.class.php";
    require_once "Models/Instrutor.class.php";
    require_once "Models/instrutorDAO.class.php";

    class InstrutorController {

        // Salvar instrutor
        public function inserir()
        {
            $msg = array("","","","");
            if($_POST)
            {
                $erro = false;
    
                if(empty($_POST["nome_instrutor"]))
                {
                    $msg[0] = "Preencha o nome";
                    $erro = true;
                }
                if(empty($_POST["categoria"]))
                {
                    $msg[1] = "Selecione pelo menos uma categoria";
                    $erro = true;
                }
                if(empty($_POST["celular_instrutor"]))
                {
                    $msg[2] = "Preencha o celular";
                    $erro = true;
                }
                if(empty($_POST["obs_instrutor"]))
                {
                    $msg[3] = "";
                    $erro = true;
                }
                if(!$erro)
                {
                    $categoriaDAO = new categoriaDAO();
					$categoria = $categoriaDAO->buscar_uma_categoria($_POST["categoria"]);

                    $instrutor = new Instrutor(
                        nome_instrutor:$_POST["nome_instrutor"], 
                        categoria:$categoria,
                        celular_instrutor:$_POST["celular_instrutor"], 
                        obs_instrutor:$_POST["obs_instrutor"]);
                    
                    $instrutorDAO = new instrutorDAO();
                    $ret = $instrutorDAO->inserir($instrutor);
                    header("location:index.php?controle=instrutorController&metodo=listar&msg=$ret");
                }
                require_once "Views/form_instrutor.php";
            }
        }

        // Buscar instrutor
        public function buscar_instrutores()
        {
            $instrutorDAO = new instrutorDAO();
            $retorno = $instrutorDAO->buscar_instrutores();
            return $retorno;
        }

        public function listar_instrutores()
        {
            if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Administrador")
            {
                header("location:index.php");
            }//if isset
            $instrutorDAO = new instrutorDAO();
            $retorno = $instrutorDAO->buscar_instrutores();
            require_once "views/listar_instrutores.php";
        }

        public function excluir()
        {
            if(isset($_GET["id"]))
            {
                $instrutorDAO = new instrutorDAO();
                $ret = $instrutorDAO->excluir($_GET["id"]);
                header("location:index.php?controle=instrutorController&metodo=listar&msg=$ret");
            }
        }

        // Atualizar instrutor
        public function alterar()
        {
            if(isset($_GET["id"]))
            {
                $instrutorDAO = new instrutorDAO();
                $instrutor = $instrutorDAO->buscar_um_instrutor($_GET["id"]);
            }
            
            $msg = array("","","","");
            if($_POST)
            {
                $erro = false;
                if(empty($_POST["nome_instrutor"]))
                {
                    $msg[0] = "Preencha o nome";
                    $erro = true;
                }
                if(empty($_POST["categoria"]))
                {
                    $msg[1] = "Selecione pelo menos uma categoria";
                    $erro = true;
                }
                if(empty($_POST["celular_instrutor"]))
                {
                    $msg[2] = "Preencha o celular";
                    $erro = true;
                }
                if(empty($_POST["obs_instrutor"]))
                {
                    $msg[3] = "";
                    $erro = true;
                }
                if(!$erro)
                {
                    $categoriaDAO = new categoriaDAO();
					$categoria = $categoriaDAO->buscar_uma_categoria($_POST["categoria"]);

                    $instrutor = new Instrutor(
                        nome_instrutor:$_POST["nome_instrutor"], 
                        categoria:$categoria, 
                        celular_instrutor:$_POST["celular_instrutor"], 
                        obs_instrutor:$_POST["obs_instrutor"]);
                    
                    $instrutorDAO = new instrutorDAO();
                    $ret = $instrutorDAO->inserir($instrutor);
                    header("location:index.php?controle=instrutorController&metodo=listar&msg=$ret");
                }
                require_once "Views/edit-instrutor.php";
            }
        }

        public function gerar_pdf()
        {
            //buscar dados para o pdf
            $instrutorDAO = new instrutorDAO();
            $retorno = $instrutorDAO->buscar_instrutores();
            require_once "views/instrutor_pdf.php";
        }
    }
