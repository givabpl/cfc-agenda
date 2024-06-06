<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if($_GET)
	{
		$controle = $_GET["controle"];
		$metodo = $_GET["metodo"];
		require_once "Controllers/" . $controle . ".php";
		$obj = new $controle();
		$obj->$metodo();
	}
	else
	{
		require_once "controllers/inicioController.php";
		$obj = new inicioController();
		$obj->inicio();
	}
