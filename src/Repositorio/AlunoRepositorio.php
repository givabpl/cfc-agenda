<?php
    class AlunoRepositorio {
        private PDO $pdo;

        /**
        * @param PDO $pdo
        */
        
        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        private function formarObjeto($dados)
        {
            return new Aluno
            (
                $dados['id_aluno'],
                $dados['nome_aluno'],
                $dados['categorias_aluno'],
                $dados['observacao'],
                $dados['aulas_restantes']
            );
        }

        // Categoria A
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

        // Categoria B
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

        // Todos alunos
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

        // Deletar aluno
        public function deletar(int $id_aluno) // obj
        {
            $sql = "DELETE FROM alunos WHERE id_aluno=?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id_aluno);
            $statement->execute();
            /* Anteriormente, usamos o método query() para fazer a busca dos dados, 
            mas agora queremos trabalhar com instruções preparadas, ou seja, queremos 
            prepará-las antes de enviá-las, pois ainda enviaremos um parâmetro como ID. */
        }

        // Salvar aluno
        public function salvar(Aluno $aluno)
        {
            $sql = "INSERT INTO alunos (nome_aluno, categorias_aluno, observacao, aulas_restantes) VALUES (?,?,?,?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $aluno->getNome());
            $statement->bindValue(2, $aluno->getCategorias());
            $statement->bindValue(3, $aluno->getObservacao());
            $statement->bindValue(4, $aluno->getAulasRestantes());
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

            return $this->formarObjeto($dados);
        }

        // Atualizar aluno
        public function atualizar(Aluno $aluno)
        {
            $sql = "UPDATE alunos SET nome_aluno = ?, categorias_aluno = ?, observacao = ?, aulas_restantes = ? WHERE id_aluno = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $aluno->getNome());
            $statement->bindValue(2, $aluno->getCategorias());
            $statement->bindValue(3, $aluno->getObservacao());
            $statement->bindValue(4, $aluno->getId());
            $statement->bindValue(5, $aluno->getAulasRestantes());
            $statement->execute();
        }


    }
