<?php
	// METODOS : BANCO DE DADOS
	class usuarioDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		// AUTENTIVAR USUARIO
		public function autenticar($usuario)
		{
			$sql = "SELECT idusuario, tipo FROM usuarios WHERE email = ? AND senha = ?";
			$stm = $this->db->prepare($sql);
			$stm->bindValue(1, $usuario->getEmail());
			$stm->bindValue(2, $usuario->getSenha());
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
			
		}

		// INSERIR USUARIO
		public function inserir($usuario)
		{
			$sql = "INSERT INTO usuarios (nome, tipo, email, senha) VALUES(?,?,?,?)";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario->getNome());
				$stm->bindValue(2, $usuario->getTipo());
				$stm->bindValue(3, $usuario->getEmail());
				$stm->bindValue(4, $usuario->getSenha());
				$stm->execute();
				$idusuario = $this->db->lastInsertId();
				$this->db = null;
				return $idusuario;
			}
			catch(PDOException $e)
			{
				return 0;
			}
		}

		// BUSCAR EMAIL
		public function buscar_email($usuario)
		{
			$sql = "SELECT email FROM usuarios WHERE email = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario->getEmail());
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				$this->db = null;
				return "Problema na verificação do email";
			}
		}
	}