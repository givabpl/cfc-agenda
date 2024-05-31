<?php

    if(!isset($_SESSION))
    session_start(); 

    require_once "Models/Conexao.class.php";
    require_once "Models/Veiculo.class.php";
    require_once "Models/veiculoDAO.class.php";
    class VeiculoController {
       
        // Salvar veiculo
        public function inserir()
        {
			$msg = array("","","");
			if($_POST)
			{
				$erro = false;
                if(empty($_POST["modelo"]))
				{
					$msg[0] = "Preencha o modelo";
					$erro = true;
				}
				if(empty($_POST["cor"]))
				{
					$msg[1] = "Preencha a cor";
					$erro = true;
				}
                if(empty($_POST["categoria"]))
				{
					$msg[2] = "Selecione pelo menos uma categoria";
					$erro = true;
				}
                if(!$erro)
				{
					$categoriaDAO = new categoriaDAO();
					$categoria = $categoriaDAO->buscar_uma_categoria($_POST["categoria"]);

					$veiculo = new Veiculo(modelo:$_POST["modelo"], cor:$_POST["cor"], categoria:$categoria);
					
					$veiculoDAO = new veiculoDAO();
					$ret = $veiculoDAO->inserir($veiculo);
					header("location:index.php?controle=veiculoController&metodo=listar&msg=$ret");
				}
                require_once "Views/form-veiculo.php";
            }
        }

        // Buscar veiculo
        public function buscar_veiculos()
		{
			$veiculoDAO = new veiculoDAO();
			$retorno = $veiculoDAO->buscar_veiculos();
			return $retorno;
		}
        public function listar()
		{
			if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Administrador")
			{
				header("location:index.php");
			}//if isset
			$veiculoDAO = new veiculoDAO();
			$retorno = $veiculoDAO->buscar_veiculos();
			require_once "views/listar-veiculos.php";
		}

        public function excluir()
		{
			if(isset($_GET["id"]))
			{
				$veiculoDAO = new veiculoDAO();
				$ret = $veiculoDAO->excluir_veiculo($_GET["id"]);
				header("location:index.php?controle=veiculoController&metodo=listar&msg=$ret");
			}
		}

        // Atualizar veiculo
        public function alterar()
        {
            if(isset($_GET["id"]))
			{
				$veiculoDAO = new veiculoDAO();
				$retorno = $veiculoDAO->buscar_um_veiculo($_GET["id"]);
			}
			
			$msg = array("","","");
			if($_POST)
			{
				$erro = false;
                if(empty($_POST["modelo"]))
				{
					$msg[0] = "Preencha o modelo";
					$erro = true;
				}
				if(empty($_POST["cor"]))
				{
					$msg[1] = "Preencha a cor";
					$erro = true;
				}
                if(empty($_POST["categoria"]))
				{
					$msg[2] = "Selecione pelo menos uma categoria";
					$erro = true;
				}
                if(!$erro)
				{
					$categoriaDAO = new categoriaDAO();
					$categoria = $categoriaDAO->buscar_uma_categoria($_POST["categoria"]);

					$veiculo = new Veiculo(
						modelo:$_POST["modelo"], 
						cor:$_POST["cor"], 
						categoria:$categoria);
					
					$veiculoDAO = new veiculoDAO();
					$ret = $veiculoDAO->inserir($veiculo);
					header("location:index.php?controle=veiculoController&metodo=listar&msg=$ret");
				}
                require_once "Views/edit-veiculo.php";
            }
			
        }

        public function gerar_pdf()
		{
			//buscar dados para o pdf
			$veiculoDAO = new veiculoDAO();
			$retorno = $veiculoDAO->buscar_veiculos();
			require_once "views/veiculo-pdf.php";
		}
    }
