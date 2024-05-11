<?php
	class Usuario extends Conexao
	{
		public function __construct(
			private int $idusuario = 0, 
			private string $nome = "", 
			private string $tipo = "", 
			private string $email = "", 
			private string $senha = ""
		){}
		
		public function getIdusuario()
		{
			return $this->idusuario;
		}
		
		public function getNomeUsuario()
		{
			return $this->nome;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getEmailUsuario()
		{
			return $this->email;
		}
		public function getSenhaUsuario()
		{
			return $this->senha;
		}
	}