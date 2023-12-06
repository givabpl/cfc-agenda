<?php
    class InstrutorRepositorio {
        private PDO $pdo;
        
        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        private function formarObjeto($dados)
        {
            return new Instrutor
            (
                $dados['id_instrutor'],
                $dados['nome_instrutor'],
                $dados['categorias_instrutor'],
                $dados['observacao']
            );
        }

        // categoria A
        public function categoriaA(): array
        {
            $sqlCategoriaA = "SELECT * FROM instrutores WHERE categorias_instrutor = 'A' ORDER BY nome_instrutor";
            $statement = $this->pdo->query($sqlCategoriaA);
            $alunosCategoriaA = $statement->fetchAll(PDO::FETCH_ASSOC);
        
            $dadosCategoriaA = array_map(function ($a) 
            {
                return $this->formarObjeto($a);
            }, $alunosCategoriaA);

            return $dadosCategoriaA;
        }

        // categoria B
        public function categoriaB(): array
        {
            $sqlCategoriaB = "SELECT * FROM instrutores WHERE categorias_instrutor = 'B' ORDER BY nome_instrutor";
            $statement = $this->pdo->query($sqlCategoriaB);
            $alunosCategoriaB = $statement->fetchAll(PDO::FETCH_ASSOC);
        
            $dadosCategoriaB = array_map(function ($b) 
            {
                return $this->formarObjeto($b);
            }, $alunosCategoriaB);

            return $dadosCategoriaB;
        }

        // categoria AB
        public function categoriaAB(): array
        {
            $sqlCategoriaAB = "SELECT * FROM instrutores WHERE categorias_instrutor = 'AB' ORDER BY nome_instrutor";
            $statement = $this->pdo->query($sqlCategoriaAB);
            $alunosCategoriaAB = $statement->fetchAll(PDO::FETCH_ASSOC);
        
            $dadosCategoriaAB = array_map(function ($ab) 
            {
                return $this->formarObjeto($ab);
            }, $alunosCategoriaAB);

            return $dadosCategoriaAB;
        }

        // Todos instrutores
        public function buscarTodos()
        {
            $sql = "SELECT * FROM instrutores ORDER BY nome_instrutor";
            $statement = $this->pdo->query($sql); // query method expects an sql
            // query method will return a statement
            $dados = $statement->fetchAll(PDO::FETCH_ASSOC); 
            // from statement we have a mthod called fetchAll()
            // it's informing php to bring all the data trought PDO
            // this gives back an assossiative array with all data ($dados)

            $todosOsDados = array_map(function ($instrutor) 
            {
                return $this->formarObjeto($instrutor);
            }, $dados);

            return $todosOsDados;
        }

        // Deletar instrutor
        public function deletar(int $id_instrutor) //obj
        {
            $sql = "DELETE FROM instrutores WHERE id_instrutor=?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$id_instrutor);
            $statement->execute();
            /* Anteriormente, usamos o método query() para fazer a busca dos dados, 
            mas agora queremos trabalhar com instruções preparadas, ou seja, queremos 
            prepará-las antes de enviá-las, pois ainda enviaremos um parâmetro como ID. */
        }

        // Salvar instrutor
        public function salvar(Instrutor $instrutor)
        {
            $sql = "INSERT INTO instrutores (nome_instrutor, categorias_instrutor, observacao) VALUES (?,?,?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $instrutor->getNome());
            $statement->bindValue(2, $instrutor->getCategorias());
            $statement->bindValue(3, $instrutor->getObservacao());
            $statement->execute();
        }

        // Buscar instrutor
        public function buscar(int $id_instrutor) //obj 
        {
            $sql = "SELECT * FROM instrutores WHERE id_instrutor = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1,$id_instrutor);
            $statement->execute();

            $dados = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->formarObjeto($dados);
        }

        // Atualizar instrutor
        public function atualizar(Instrutor $instrutor)
        {
            $sql = "UPDATE instrutores SET nome_instrutor = ?, categorias_instrutor = ?, observacao = ? WHERE id_instrutor = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $instrutor->getNome());
            $statement->bindValue(2, $instrutor->getCategorias());
            $statement->bindValue(3, $instrutor->getObservacao());
            $statement->bindValue(4, $instrutor->getIdInstrutor());
            $statement->execute();
        }

    }
