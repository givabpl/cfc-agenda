<?php
	abstract class Conexao
	{
		public function __construct(protected $db = null)
		{
			$parametros = "mysql:host=localhost;dbname=cfc_agenda;charset=utf8mb4";
			try
			{
				$this->db = new PDO($parametros, "root", "vot38m7Ps-byb");
			}
			catch(PDOException $e)
			{
				echo $e->getCode();
				echo $e->getMessage();
				echo "Problema na abertura de conexão com o banco de dados";
			}
		}
	}
