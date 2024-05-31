<?php
	require_once "models/Conexao.class.php";
	require_once "models/Usuario.class.php";
	require_once "models/usuarioDAO.class.php";
	class usuarioController
	{
		public function login()
		{
			$msg1 = "";
			$msg2 = "";
			if($_POST)
			{
				$erro = false;

				if(empty($_POST["email"]))
				{
					$erro = true;
					$msg1 = "Preencha o E-mail";
				}
				if(empty($_POST["senha"]))
				{
					$erro = true;
					$msg2 = "Informe a senha";
				}
				if(!$erro)
				{
					//verificar usuário no BD
					$usuario = new Usuario(email:$_POST["email"], senha:md5($_POST["senha"]));
					
					$usuarioDAO = new usuarioDAO();
					$retorno = $usuarioDAO->autenticar($usuario);
					if(count($retorno) > 0)
					{
						session_start();
						$_SESSION["idusuario"] = $retorno[0]->idusuario;
						$_SESSION["tipo"] = $retorno[0]->tipo;
						$_SESSION["nome"] = $retorno[0]->nome;
						header("location:index.php");
					}
					else
					{
						echo "<script>alert('Confira suas credenciais')</script>";
					}
					
				}
			}
			require_once "views/form-login.php";
		}
		public function logout()
		{
			session_start();
			$_SESSION = array();
			session_destroy();
			header("location:index.php");
		}
		public function inserir()
		{
			$msg = array("","","","");
			$mensagem = "";
			if($_POST)
			{
				$erro = false;
				
				//verificações
				if(empty($_POST["nome"]))
				{
					$msg[0] = "Preencha com seu nome";
					$erro = true;
				}
				if(empty($_POST["email"]))
				{
					$msg[1] = "Preencha com seu e-mail";
					$erro = true;
				}
				if(empty($_POST["senha"]))
				{
					$msg[2] = "Preencha a senha";
					$erro = true;
				}
				if(empty($_POST["confirma"]))
				{
					$msg[3] = "Confirme a senha";
					$erro = true;
				}
				if(!empty($_POST["senha"]) && !empty($_POST["confirma"]))
				{
					if($_POST["senha"] != $_POST["confirma"])
					{
						$msg[3] = "Senhas não conferem";
						$erro = true;
					}
				}
				if(!empty($_POST["email"]))
				{
					$usuario = new Usuario(email:$_POST["email"]);
					$usuarioDAO = new usuarioDAO();
					$retorno = $usuarioDAO->buscar_email($usuario);
					if(is_array($retorno) && count($retorno) > 0)
					{
						$msg[1] = "E-mail já cadastrado";
						$erro = true;
					}
				}
				//inserir no BD
				if(!$erro)
				{
					$usuario = new Usuario(0, $_POST["nome"], "Secretaria" , $_POST["email"], md5($_POST["senha"]));
					$usuarioDAO = new usuarioDAO();
					$retorno = $usuarioDAO->inserir($usuario);
					if(!isset($_SESSION))
					{
						session_start();
					}
					
					if($retorno != 0)
					{
						$_SESSION["idusuario"] = $retorno;
						$_SESSION["tipo"] = "Secretaria";
						header("location:index.php");
					}
					else
					{
						$mensagem = "Problema ao inserir secretaria";
					}
					
				}
			}
			require_once "views/form-usuario.php";
		}
	}
