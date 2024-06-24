<?php

    if(!isset($_SESSION))
    session_start(); 

    require_once "Models/Conexao.class.php";
    require_once "Models/Veiculo.class.php";
    require_once "Models/veiculoDAO.class.php";
	require_once "Models/Categoria.class.php";
	require_once "Models/categoriaDAO.class.php";
    class VeiculoController {
       
        // Inserir veiculo
        public function inserir()
        {
			$msg = array("","","");
			if($_POST)
			{
				$erro = false;

				if(empty($_POST["categoria"]))
				{
					$msg[0] = "Selecione pelo menos uma categoria";
					$erro = true;
				}
                if(empty($_POST["modelo"]))
				{
					$msg[1] = "Preencha o modelo";
					$erro = true;
				}
				if(empty($_POST["cor"]))
				{
					$msg[2] = "Preencha a cor";
					$erro = true;
				}
                if(!$erro)
				{
					$categoria = new Categoria($_POST["categoria"]);

					$veiculo = new Veiculo(categoria:$categoria, modelo:$_POST["modelo"], cor:$_POST["cor"]);
					
					$veiculoDAO = new veiculoDAO();
					$ret = $veiculoDAO->inserir($veiculo);
					header("location:index.php?controle=veiculoController&metodo=listar&msg=$ret");
				}
            }
			require_once "Views/form-veiculo.php";
        }

        // Buscar veiculo
        public function buscar_veiculos()
		{
			$veiculoDAO = new veiculoDAO();
			$retorno = $veiculoDAO->buscar_veiculos();
			return $retorno;
		}

		// listar veiculo
        public function listar()
		{
			if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Secretaria")
			{
				header("location:index.php");
			}//if isset
			$veiculoDAO = new veiculoDAO();
			$retorno = $veiculoDAO->buscar_veiculos_categorias();
			require_once "views/listar-veiculos.php";
		}

		// excluir veiculo
        public function excluir()
		{
			if(isset($_GET["id"]))
			{
				$veiculo = new Veiculo($_GET["id"]);
				$veiculoDAO = new veiculoDAO();
				$retorno = $veiculoDAO->excluir_veiculo($veiculo);
			}
			header("location:index.php?controle=veiculoController&metodo=listar&msg=$retorno");
		}

        // Atualizar veiculo
        public function alterar()
		{
			if (isset($_GET["id"]))
			{
				$veiculo = new Veiculo($_GET["id"]);
				$veiculoDAO = new veiculoDAO();
				$retorno = $veiculoDAO->buscar_um_veiculo($veiculo);
			}

			$msg = array("","","");
			if ($_POST)
			{
				$erro = false;

				if(empty($_POST["categoria"]))
				{
					$msg[0] = "Selecione pelo menos uma categoria";
					$erro = true;
				}
                if(empty($_POST["modelo"]))
				{
					$msg[1] = "Preencha o modelo";
					$erro = true;
				}
				if(empty($_POST["cor"]))
				{
					$msg[2] = "Preencha a cor";
					$erro = true;
				}

				if (!$erro)
				{
					$categoria = new Categoria($_POST["categoria"]);

					$veiculo = new Veiculo(categoria:$categoria, id_veiculo:$_POST["id"], modelo:$_POST["modelo"], cor:$_POST["cor"]);
					
					$veiculoDAO = new veiculoDAO();
					$ret = $veiculoDAO->alterar_veiculo($veiculo);
					header("location:index.php?controle=veiculoController&metodo=listar&msg=$ret");
				}
			}
			require_once "views/editar-veiculo.php";
		}


		// gerar pdf de veiculos
        public function gerar_pdf()
		{
			//buscar dados para o pdf
			$veiculoDAO = new veiculoDAO();
			$retorno = $veiculoDAO->buscar_veiculos();
			require_once "views/veiculo-pdf.php";
		}
    }
