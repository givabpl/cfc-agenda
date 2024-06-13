<?php

    if(!isset($_SESSION))
        session_start(); 

    require_once "Models/Conexao.class.php";
    require_once "Models/Instrutor.class.php";
    require_once "Models/instrutorDAO.class.php";
    require_once "Models/Categoria.class.php";
	require_once "Models/categoriaDAO.class.php";

    class InstrutorController {

        // Salvar instrutor
        public function inserir()
        {
            $msg = array("","","","");
            if($_POST)
            {
                $erro = false;
                if(empty($_POST["categoria"]))
                {
                    $msg[0] = "Selecione pelo menos uma categoria";
                    $erro = true;
                }
                if(empty($_POST["nome_instrutor"]))
                {
                    $msg[1] = "Preencha o nome";
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

                    $instrutor = new Instrutor(categoria:$categoria,nome_instrutor:$_POST["nome_instrutor"], celular_instrutor:$_POST["celular_instrutor"], obs_instrutor:$_POST["obs_instrutor"]);
                    
                    $instrutorDAO = new instrutorDAO();
                    $ret = $instrutorDAO->inserir($instrutor);
                    header("location:index.php?controle=instrutorController&metodo=listar&msg=$ret");
                }
            }
            require_once "Views/form-instrutor.php";
        }

        // Buscar instrutor
        public function buscar()
        {
            $instrutorDAO = new instrutorDAO();
            $retorno = $instrutorDAO->buscar_instrutores();
            return $retorno;
        }

        public function listar()
        {
            if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Secretaria")
            {
                header("location:index.php");
            }//if isset
            $categoriaDAO = new categoriaDAO();
            $instrutorDAO = new instrutorDAO();
            $instrutores = $instrutorDAO->buscar_instrutores_categorias();
            require_once "views/listar-instrutores.php";
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
                if(empty($_POST["categoria"]))
                {
                    $msg[0] = "Selecione pelo menos uma categoria";
                    $erro = true;
                }
                if(empty($_POST["nome_instrutor"]))
                {
                    $msg[1] = "Preencha o nome";
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

                    $instrutor = new Instrutor(categoria:$categoria,nome_instrutor:$_POST["nome_instrutor"], celular_instrutor:$_POST["celular_instrutor"], obs_instrutor:$_POST["obs_instrutor"]);
                    
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
            require_once "views/instrutor-pdf.php";
        }
    }
