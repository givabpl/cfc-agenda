<?php

    if(!isset($_SESSION))
    session_start(); 

    require_once "Models/Conexao.class.php";
	require_once "Models/Categoria.class.php";
	require_once "Models/categoriaDAO.class.php";
    class VeiculoController {
       
       
        // Buscar veiculo
        public function buscar()
		{
			$categoriaDAO = new categoriaDAO();
			$retorno = $categoriaDAO->buscar_categorias();
			return $retorno;
		}

		// listar veiculo
        public function listar()
		{
			if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Secretaria")
			{
				header("location:index.php");
			}//if isset
			$categoriaDAO = new categoriaDAO();
			$retorno = $categoriaDAO->buscar_categorias();
			require_once "views/listar-categorias.php";
		}

    }
