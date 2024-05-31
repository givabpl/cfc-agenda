<?php
    class categoriaDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        private function formar_objeto($dados): Categoria
        {
            return new Categoria(
                $dados['id_categoria'],
                $dados['descritivo']
            );
        }

            // Função para buscar todas as categorias
        public function buscar_categorias(): array
        {
            $sql = "SELECT * FROM categorias";
            try {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                $categorias = [];
                foreach ($resultados as $row) {
                    $categorias[] = $this->formar_objeto($row);
                }
                $this->db = null;
                return $categorias;
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar todas as categorias";
                return [];
            }
        }

        // Função para buscar uma categoria por ID
        public function buscar_uma_categoria($id_categoria): ?Categoria
        {
            $sql = "SELECT * FROM categorias WHERE id = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_categoria);
                $stm->execute();
                $resultado = $stm->fetch(PDO::FETCH_ASSOC);
                $this->db = null;
                if ($resultado) {
                    return $this->formar_objeto($resultado);
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar uma categoria";
                return null;
            }
        }
    }