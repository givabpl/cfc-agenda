<?php
    class veiculoDAO extends Conexao
    {
        public function __construct()
		{
			parent:: __construct();
		}

        // função para formar o objeto Veiculo
        private function formar_objeto($dados): Veiculo
        {
            $categoriaDAO = new categoriaDAO();
            $categoria = $categoriaDAO->buscar_uma_categoria($dados['id_categoria']);
            return new Veiculo
            (
                $categoria,
                $dados['id_veiculo'],
                $dados['modelo'],
                $dados['cor'],
            );
        }

        //função para buscar todos os veiculos
        /*public function buscar_veiculos()
        {
            $sql = "SELECT * FROM veiculos";
            try {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                $veiculos = [];
                foreach ($resultados as $row) {
                    $veiculos[] = $this->formar_objeto($row);
                }
                $this->db = null;
                return $veiculos;
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar todos os veiculos";
                return [];
            }
        }*/

        public function buscar_veiculos()
		{
			$sql = "SELECT v.*, c.descritivo as categoria FROM veiculos as v, categorias as c WHERE v.id_categoria = c.id_categoria";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}

        // função para buscar veiculos da categoria A
        public function buscar_veiculos_categoria_A()
        {
            $sql = "SELECT * FROM veiculos WHERE categoria = 'A' ORDER BY modelo";
            try 
            {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                $veiculos = [];
                foreach ($resultados as $row) {
                    $veiculos[] = $this->formar_objeto($row);
                }
                $this->db = null;
                return $veiculos;
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os veiculos de categoria A";
                return [];
            }
        }

        // função para buscar veiculos da categoria B
        public function buscar_veiculos_categoria_B()
        {
            $sql = "SELECT * FROM veiculos WHERE categoria = 'B' ORDER BY modelo";
            try 
            {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                $veiculos = [];
                foreach ($resultados as $row) {
                    $veiculos[] = $this->formar_objeto($row);
                }
                $this->db = null;
                return $veiculos;
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os veiculos de categoria B";
                return [];
            }
        }

        // função para buscar um veiculo
        public function buscar_um_veiculo($id_veiculo): ?Veiculo
        {
            $sql = "SELECT * FROM veiculos WHERE id_veiculo = ? ORDER BY modelo";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_veiculo);
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
                echo "Problema ao buscar um veiculo";
                return null;
            }
        }
        
        public function inserir($veiculo)
        {
            $sql = "INSERT INTO veiculos (id_categoria, modelo, cor) VALUES (?,?,?)";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $veiculo->getCategoriaVeiculo()->getId());
                $stm->bindValue(2, $veiculo->getModelo());
                $stm->bindValue(3, $veiculo->getCor());
                

                $stm->execute();
                $this->db = null;
                return "Veiculo cadastrado com sucesso";
            }
            catch(PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao cadastrar veiculo";
            }
        }
        
        // função para alterar veiculo
        public function alterar_veiculo($veiculo)
        {
            $sql = "UPDATE veiculos SET id_categoria = ? modelo = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $veiculo->getCategoriaVeiculo()->getId());
                $stm->bindValue(1, $veiculo->getModelo());
                $stm->bindValue(2, $veiculo->getCor());
                $stm->execute();
                $this->db = null;
                return "Veiculo alterado com sucesso";
            }
            catch(PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao alterar veiculo";
            }
        }

        // função para deletar veiculo
        public function excluir_veiculo($id_veiculo) // obj
        {
            $sql = "DELETE FROM veiculos WHERE id_veiculo = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_veiculo);
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
                echo "Problema ao excluir um veiculo";
                return null;
            }
        }
    }