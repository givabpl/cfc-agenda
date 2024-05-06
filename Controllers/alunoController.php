<?php
    require_once "Models/Conexao.class.php";
	require_once "Models/Aluno.class.php";
	require_once "Models/alunoDAO.class.php";

    class alunoController {
        public function listar()
		{
			$alunoDAO = new alunoDAO();
			$retorno = $alunoDAO->buscar_alunos();
			require_once "Views/listar_alunos.php";
		}

        private function formar_objeto($dados)
        {
            return new Aluno
            (
                $dados['id_aluno'],
                $dados['aulas_restantes'],
                $dados['nome_aluno'],
                $dados['categoria_aluno'],
                $dados['celular_aluno'],
                $dados['obs_aluno'],
                $dados['email_aluno'],
                $dados['senha_aluno']
            );
        }        
        

        // Categoria A
        /* 
        public function categoriaA(): array
        {
            $sqlCategoriaA = "SELECT * FROM alunos WHERE categorias_aluno = 'A' ORDER BY nome_aluno";
            $statement = $this->pdo->query($sqlCategoriaA);
            $alunosCategoriaA = $statement->fetchAll(PDO::FETCH_ASSOC);
        
            $dadosCategoriaA = array_map(function ($a) 
            {
                return $this->formarObjeto($a);
            }, $alunosCategoriaA);

            return $dadosCategoriaA;
        }
        */

        // Categoria B
        
        /*
        public function categoriaB(): array
        {
            $sqlCategoriaB = "SELECT * FROM alunos WHERE categorias_aluno = 'B' ORDER BY nome_aluno";
            $statement = $this->pdo->query($sqlCategoriaB);
            $alunosCategoriaB = $statement->fetchAll(PDO::FETCH_ASSOC);
        
            $dadosCategoriaB = array_map(function ($b) 
            {
                return $this->formarObjeto($b);
            }, $alunosCategoriaB);

            return $dadosCategoriaB;
        }
        */
        

        // Todos alunos
        /* 
        public function buscarTodos()
        {
            $sql = "SELECT * FROM alunos ORDER BY nome_aluno";
            $statement = $this->pdo->query($sql); // query method expects an sql
            // query method will return a statement
            $dados = $statement->fetchAll(PDO::FETCH_ASSOC); 
            // from statement we have a mthod called fetchAll()
            // it's informing php to bring all the data trought PDO
            // this gives back an assossiative array with all data ($dados)

            $todosOsDados = array_map(function ($aluno) 
            {
                return $this->formarObjeto($aluno);
            }, $dados);

            return $todosOsDados;
        }
        */

        // Deletar aluno
        /*
        public function deletar(int $id_aluno) // obj
        {
            $sql = "DELETE FROM alunos WHERE id_aluno=?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id_aluno);
            $statement->execute();
            
        }
        */
        /* Anteriormente, usamos o método query() para fazer a busca dos dados, 
            mas agora queremos trabalhar com instruções preparadas, ou seja, queremos 
            prepará-las antes de enviá-las, pois ainda enviaremos um parâmetro como ID. */



        // Salvar aluno
        public function inserir()
        {
			$msg = array("","","","","","");
			if($_POST)
			{
				$erro = false;
                if(empty($_POST["aulas_restantes"]))
				{
					$msg[0] = "Preencha as aulas restantes";
					$erro = true;
				}
				if(empty($_POST["nome_aluno"]))
				{
					$msg[1] = "Preencha o nome";
					$erro = true;
				}
                if(empty($_POST["categoria_aluno"]))
				{
					$msg[2] = "Selecione pelo menos uma categoria";
					$erro = true;
				}
                if(empty($_POST["celular_aluno"]))
				{
					$msg[3] = "Preencha o celular";
					$erro = true;
				}
                if(empty($_POST["obs_aluno"]))
				{
					$msg[4] = "";
					$erro = false;
				}
                if(empty($_POST["email_aluno"]))
				{
					$msg[5] = "Preencha o email";
					$erro = true;
				}
                if(empty($_POST["senha_aluno"]))
				{
					$msg[6] = "Preencha a senha";
					$erro = true;
				}
				
				
                if(!$erro)
				{
					$aluno = new Aluno(aulas_restantes:$_POST["aulas_restantes"], nome_aluno:$_POST["nome_aluno"], categoria_aluno:$_POST["categoria_aluno"], celular_aluno:$_POST["celular_aluno"], obs_aluno:$_POST["obs_aluno"], email_aluno:$_POST["email_aluno"], senha_aluno:md5($_POST["senha_aluno"]));
					
					$alunoDAO = new alunoDAO();
					$alunoDAO->inserir($aluno);
					header("location:index.php?controle=alunoController&metodo=listar");
				}

            }

            $sql = "INSERT INTO alunos (aulas_restantes, nome_aluno, categoria_aluno, calular_aluno, obs_aluno, email_aluno, senha_aluno) VALUES (?,?,?,?,?,?,?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $aluno->getAulasRestantes());
            $statement->bindValue(2, $aluno->getNomeAluno());
            $statement->bindValue(3, $aluno->getCategoriaAluno());
            $statement->bindValue(4, $aluno->getCelularAluno());
            $statement->bindValue(5, $aluno->getObsAluno());
            $statement->bindValue(6, $aluno->getEmailAluno());
            $statement->bindValue(7, $aluno->getSenhaAluno());
            $statement->execute();
        }

        // Buscar aluno
        public function buscar(int $id_aluno) // obj
        {
            $sql = "SELECT * FROM alunos WHERE id_aluno = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id_aluno);
            $statement->execute();

            $dados = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->formar_objeto($dados);
        }

        // Atualizar aluno
        public function atualizar(Aluno $aluno)
        {
            $sql = "UPDATE alunos SET aulas_restantes = ?, nome_aluno = ?, categoria_aluno = ?, celular_aluno = ?, obs_aluno = ?, email_aluno = ?, senha_aluno = ? WHERE id_aluno = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $aluno->getAulasRestantes());
            $statement->bindValue(2, $aluno->getNomeAluno());
            $statement->bindValue(3, $aluno->getCategoriaAluno());
            $statement->bindValue(4, $aluno->getCelularAluno());
            $statement->bindValue(5, $aluno->getObsAluno());
            $statement->bindValue(6, $aluno->getEmailAluno());
            $statement->bindValue(7, $aluno->getSenhaAluno());
        }


    }

