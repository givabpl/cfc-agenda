<?php

    if(!isset($_SESSION))
        session_start(); 

    require_once "Models/Conexao.class.php";
	require_once "Models/Aluno.class.php";
	require_once "Models/alunoDAO.class.php";
	require_once "Models/Categoria.class.php";
	require_once "Models/categoriaDAO.class.php";

    class alunoController {     

        // INSERIR ALUNO
        public function inserir()
		{
			$msg = array("","","","","","","");
			if($_POST)
			{
				$erro = false;
				if(empty($_POST["categoria"]))
				{
					$msg[0] = "Selecione pelo menos uma categoria";
					$erro = true;
				}
				if(empty($_POST["aulas_restantes"]))
				{
					$msg[1] = "Preencha as aulas restantes";
					$erro = true;
				}
				if(empty($_POST["nome_aluno"]))
				{
					$msg[2] = "Preencha o nome";
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
					$categoria = new Categoria($_POST["categoria"]);

					$aluno = new Aluno(categoria: $categoria, aulas_restantes: $_POST["aulas_restantes"], nome_aluno: $_POST["nome_aluno"], celular_aluno: $_POST["celular_aluno"], obs_aluno: $_POST["obs_aluno"], imagem: $_FILES["imagem"]['name']
					);
					
					$alunoDAO = new alunoDAO();
					$ret = $alunoDAO->inserir($aluno);
					header("location:index.php?controle=alunoController&metodo=listar&msg=$ret");
				}
			}
			require_once "Views/form-aluno.php";
		}


        // BUSCAR ALUNOS
        public function buscar()
		{
			$alunoDAO = new alunoDAO();
			$retorno = $alunoDAO->buscar_alunos();
			return $retorno;
		}

		// LISTAR ALUNOS
        public function listar()
		{
			if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Secretaria")
			{
				header("location:index.php");
			}
			$categoriaDAO = new categoriaDAO();
			$alunoDAO = new alunoDAO();
			$alunos = $alunoDAO->buscar_alunos_categorias();
			require_once "views/listar-alunos.php";
		}

		// EXCLUIR ALUNO
        public function excluir()
		{
			if(isset($_GET["id"]))
			{
				$aluno = new Aluno($_GET["id"]);
				$alunoDAO = new alunoDAO();
				$retorno = $alunoDAO->excluir_aluno($aluno);
			}
			header("location:index.php?controle=alunoController&metodo=listar&msg=$retorno");
		}

        // ALTERAR ALUNO
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
				if(empty($_POST["categoria_aluno"]))
				{
					$msg[0] = "Selecione pelo menos uma categoria";
					$erro = true;
				}
				if(empty($_POST["aulas_restantes"]))
				{
					$msg[1] = "Preencha as aulas restantes";
					$erro = true;
				}
				if(empty($_POST["nome_aluno"]))
				{
					$msg[2] = "Preencha o nome";
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
					$categoria = new Categoria($_POST["categoria"]);

					$aluno = new Aluno(categoria:$categoria, aulas_restantes:$_POST["aulas_restantes"], nome_aluno:$_POST["nome_aluno"], celular_aluno:$_POST["celular_aluno"], obs_aluno:$_POST["obs_aluno"], imagem:$_POST["imagem"]);

					$alunoDAO = new alunoDAO();
					$ret = $alunoDAO->alterar_aluno($aluno);
					header("location:index.php?controle=alunoController&metodo=listar&msg=$ret");
				}
			}
			// obs: buscar dados DAO
			require_once "Views/editar-aluno.php";
		}

		// GERAR PDF
        public function gerar_pdf()
		{
			//buscar dados para o pdf
			$alunoDAO = new alunoDAO();
			$retorno = $alunoDAO->buscar_alunos();
			require_once "views/aluno-pdf.php";
		}
    }

