<?php
    class VeiculoRepositorio {
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
            return new Veiculo
            (
                $dados['id_veiculo'],
                $dados['modelo'],
                $dados['categoria']
            );
        }

        // categoria A
        public function categoriaA(): array
        {
            $sqlCategoriaA = "SELECT * FROM veiculos WHERE categoria = 'A' ORDER BY categoria";
            $statement = $this->pdo->query($sqlCategoriaA);
            $veiculosCategoriaA = $statement->fetchAll(PDO::FETCH_ASSOC);
        
            $dadosCategoriaA = array_map(function ($a) 
            {
                return $this->formarObjeto($a);
            }, $veiculosCategoriaA);

            return $dadosCategoriaA;
        }

        // categoria B
        public function categoriaB(): array
        {
            $sqlCategoriaB = "SELECT * FROM veiculos WHERE categoria = 'B' ORDER BY categoria";
            $statement = $this->pdo->query($sqlCategoriaB);
            $veiculosCategoriaB = $statement->fetchAll(PDO::FETCH_ASSOC);
        
            $dadosCategoriaB = array_map(function ($b) 
            {
                return $this->formarObjeto($b);
            }, $veiculosCategoriaB);

            return $dadosCategoriaB;
        }

        // Buscar todos
        public function buscarTodos()
        {
            $sql = "SELECT * FROM veiculos ORDER BY modelo";
            $statement = $this->pdo->query($sql); // query method expects an sql
            // query method will return a statement
            $dados = $statement->fetchAll(PDO::FETCH_ASSOC); 
            // from statement we have a mthod called fetchAll()
            // it's informing php to bring all the data trought PDO
            // this gives back an assossiative array with all data ($dados)

            $todosOsDados = array_map(function ($veiculo) 
            {
                return $this->formarObjeto($veiculo);
            }, $dados);

            return $todosOsDados;
        }

        // Deletar veiculo
        public function deletar(int $id_veiculo) // obj
        {
            $sql = "DELETE FROM veiculos WHERE id_veiculo=?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id_veiculo);
            $statement->execute();
            /* Anteriormente, usamos o método query() para fazer a busca dos dados, 
            mas agora queremos trabalhar com instruções preparadas, ou seja, queremos 
            prepará-las antes de enviá-las, pois ainda enviaremos um parâmetro como ID. */
        }

        // Salvar veiculo
        public function salvar(Veiculo $veiculo)
        {
            $sql = "INSERT INTO veiculos (modelo, categoria) VALUES (?,?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $veiculo->getModelo());
            $statement->bindValue(2, $veiculo->getCategoria());
            $statement->execute();
        }

        // Buscar veiculo
        public function buscar(int $id_veiculo) // obj
        {
            $sql = "SELECT * FROM veiculos WHERE id_veiculo = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id_veiculo);
            $statement->execute();

            $dados = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->formarObjeto($dados);
        }

        // Atualizar veiculo
        public function atualizar(Veiculo $veiculo)
        {
            $sql = "UPDATE veiculos SET modelo = ?, categoria = ? WHERE id_veiculo = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $veiculo->getModelo());
            $statement->bindValue(2, $veiculo->getCategoria());
            $statement->bindValue(3, $veiculo->getIdVeiculo());
            $statement->execute();
        }

    }
