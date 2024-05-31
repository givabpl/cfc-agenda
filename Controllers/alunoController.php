<?php

    if(!isset($_SESSION))
        session_start(); 

    require_once "Models/Conexao.class.php";
	require_once "Models/Aluno.class.php";
	require_once "Models/alunoDAO.class.php";

    class alunoController {     

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
				if(empty($_POST["categoria"]))
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

				// Processar o upload da imagem
				$imagem = null;
				if(isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["imagem"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

					// Verificar se é uma imagem real
					$check = getimagesize($_FILES["imagem"]["tmp_name"]);
					if($check !== false) {
						if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
							$imagem = $target_file;
						} else {
							$msg[5] = "Desculpe, houve um erro ao enviar seu arquivo.";
							$erro = true;
						}
					} else {
						$msg[5] = "O arquivo não é uma imagem.";
						$erro = true;
					}
				}

				if(!$erro)
				{
					$categoriaDAO = new categoriaDAO();
					$categoria = $categoriaDAO->buscar_uma_categoria($_POST["categoria"]);

					$aluno = new Aluno(
						aulas_restantes: $_POST["aulas_restantes"], 
						nome_aluno: $_POST["nome_aluno"], 
						categoria: $categoria, 
						celular_aluno: $_POST["celular_aluno"], 
						obs_aluno: $_POST["obs_aluno"], 
						imagem: $_POST["imagem"]
					);
					
					$alunoDAO = new alunoDAO();
					$ret = $alunoDAO->inserir($aluno);
					header("location:index.php?controle=alunoController&metodo=listar&msg=$ret");
				}
				require_once "Views/form-aluno.php";
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
			if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Secretaria")
			{
				header("location:index.php");
			}//if isset
			$alunoDAO = new alunoDAO();
			$retorno = $alunoDAO->buscar_alunos();
			require_once "views/listar-alunos.php";
		}

        public function excluir()
		{
			if(isset($_GET["id"]))
			{
				$alunoDAO = new alunoDAO();
				$ret = $alunoDAO->excluir_aluno($_GET["id"]);
				header("location:index.php?controle=alunoController&metodo=listar&msg=$ret");
			}
		}

        // Atualizar aluno
       public function alterar()
		{
			if(isset($_GET["id"]))
			{
				$alunoDAO = new alunoDAO();
				$aluno = $alunoDAO->buscar_um_aluno($_GET["id"]);
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

				// Processar o upload da imagem
				$imagem = $aluno->getImagem(); // manter a imagem existente por padrão
				if(isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
					$target_dir = "uploads/";
					$target_file = $target_dir . basename($_FILES["imagem"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

					// Verificar se é uma imagem real
					$check = getimagesize($_FILES["imagem"]["tmp_name"]);
					if($check !== false) {
						if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
							$imagem = $target_file;
						} else {
							$msg[5] = "Desculpe, houve um erro ao enviar seu arquivo.";
							$erro = true;
						}
					} else {
						$msg[5] = "O arquivo não é uma imagem.";
						$erro = true;
					}
				}

				if(!$erro)
				{
					$categoriaDAO = new categoriaDAO();
					$categoria = $categoriaDAO->buscar_uma_categoria($_POST["categoria"]);

					$aluno = new Aluno(
						aulas_restantes:$_POST["aulas_restantes"], 
						nome_aluno:$_POST["nome_aluno"], 
						categoria:$categoria, 
						celular_aluno:$_POST["celular_aluno"], 
						obs_aluno:$_POST["obs_aluno"], 
						imagem:$_POST["imagem"]);

					$alunoDAO = new alunoDAO();
					$ret = $alunoDAO->alterar_aluno($aluno);
					header("location:index.php?controle=alunoController&metodo=listar&msg=$ret");
				}
				require_once "Views/editar-aluno.php";
			}
		}


        public function gerar_pdf()
		{
			//buscar dados para o pdf
			$alunoDAO = new alunoDAO();
			$retorno = $alunoDAO->buscar_alunos();
			require_once "views/aluno-pdf.php";
		}
    }

