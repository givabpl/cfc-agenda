<?php

    if(!isset($_SESSION))
        session_start(); 

    require_once "Models/Conexao.class.php";
	require_once "Models/Aluno.class.php";
	require_once "Models/alunoDAO.class.php";

    class alunoController {     


        // Deletar aluno
        /* Anteriormente, usamos o método query() para fazer a busca dos dados, 
            mas agora queremos trabalhar com instruções preparadas, ou seja, queremos 
            prepará-las antes de enviá-las, pois ainda enviaremos um parâmetro como ID. */



        // Salvar aluno
        public function inserir()
        {
			$msg = array("","","","","","","");
			if($_POST)
			{
				$erro = false;
                if(empty($_POST["aulas_restantes"]))
				{
					$msg[0] = "Preencha as aulas restantes";
					$erro = true;
				}
				if(empty($_POST["nome_aluno"]))
				{
					$msg[1] = "Preencha o nome";
					$erro = true;
				}
                if(empty($_POST["categoria_aluno"]))
				{
					$msg[2] = "Selecione pelo menos uma categoria";
					$erro = true;
				}
                if(empty($_POST["celular_aluno"]))
				{
					$msg[3] = "Preencha o celular";
					$erro = true;
				}
                if(empty($_POST["obs_aluno"]))
				{
					$msg[4] = "";
					$erro = true;
				}
                if(empty($_POST["email_aluno"]))
				{
					$msg[5] = "Preencha o email";
					$erro = true;
				}
                if(empty($_POST["senha_aluno"]))
				{
					$msg[6] = "Preencha a senha";
					$erro = true;
				}
                if(!$erro)
				{
					$aluno = new Aluno(aulas_restantes:$_POST["aulas_restantes"], nome_aluno:$_POST["nome_aluno"], categoria_aluno:$_POST["categoria_aluno"], celular_aluno:$_POST["celular_aluno"], obs_aluno:$_POST["obs_aluno"], email_aluno:$_POST["email_aluno"], senha_aluno:md5($_POST["senha_aluno"]));
					
					$alunoDAO = new alunoDAO();
					$alunoDAO->inserir($aluno);
					header("location:index.php?controle=alunoController&metodo=listar&msg=$ret");
				}
                require_once "Views/form_aluno.php";
            }
        }

        // Buscar aluno
        public function buscar_alunos()
		{
			$alunoDAO = new alunoDAO();
			$retorno = $alunoDAO->buscar_alunos();
			return $retorno;
		}
        public function listar()
		{
			if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Administrador")
			{
				header("location:index.php");
			}//if isset
			$alunoDAO = new alunoDAO();
			$retorno = $alunoDAO->buscar_alunos();
			require_once "views/listar_alunos.php";
		}

        public function excluir()
		{
			if(isset($_GET["id"]))
			{
				$aluno = new Aluno($_GET["id"]);
				$alunoDAO = new alunoDAO();
				$ret = $alunoDAO->excluir_aluno($aluno);
				header("location:index.php?controle=alunoController&metodo=listar&msg=$ret");
			}
		}

        // Atualizar aluno
        public function alterar()
        {
            if(isset($_GET["id"]))
			{
				$aluno = new Aluno($_GET["id"]);
				$alunoDAO = new alunoDAO();
				$retorno = $alunoDAO->buscar_um_aluno($aluno);
			}
			
			$msg = array("","","","","","","");
			if($_POST)
			{
				$erro = false;
                if(empty($_POST["aulas_restantes"]))
				{
					$msg[0] = "Preencha as aulas restantes";
					$erro = true;
				}
				if(empty($_POST["nome_aluno"]))
				{
					$msg[1] = "Preencha o nome";
					$erro = true;
				}
                if(empty($_POST["categoria_aluno"]))
				{
					$msg[2] = "Selecione pelo menos uma categoria";
					$erro = true;
				}
                if(empty($_POST["celular_aluno"]))
				{
					$msg[3] = "Preencha o celular";
					$erro = true;
				}
                if(empty($_POST["obs_aluno"]))
				{
					$msg[4] = "";
					$erro = true;
				}
                if(empty($_POST["email_aluno"]))
				{
					$msg[5] = "Preencha o email";
					$erro = true;
				}
                if(empty($_POST["senha_aluno"]))
				{
					$msg[6] = "Preencha a senha";
					$erro = true;
				}
                if(!$erro)
				{
					$aluno = new Aluno(aulas_restantes:$_POST["aulas_restantes"], nome_aluno:$_POST["nome_aluno"], categoria_aluno:$_POST["categoria_aluno"], celular_aluno:$_POST["celular_aluno"], obs_aluno:$_POST["obs_aluno"], email_aluno:$_POST["email_aluno"], senha_aluno:md5($_POST["senha_aluno"]));
					
					$alunoDAO = new alunoDAO();
					$alunoDAO->inserir($aluno);
					header("location:index.php?controle=alunoController&metodo=listar&msg=$ret");
				}
                require_once "Views/edit_aluno.php";
            }
			
        }

        public function gerar_pdf()
		{
			//buscar dados para o pdf
			$alunoDAO = new alunoDAO();
			$retorno = $alunoDAO->buscar_alunos();
			require_once "views/aluno_pdf.php";
		}
    }

