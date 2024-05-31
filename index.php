<?php
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
