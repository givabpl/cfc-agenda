<?php
	class inicioController
	{
		public function inicio()
		{
			require_once "controllers/alunoController.php";
			$alunoController = new alunoController();
			$retorno = $alunoController->buscar_alunos();
			require_once "views/menu.php";
		}
	}
