<?php
    class veiculoDAO extends Conexao
    {
        public function __construct()
		{
			parent:: __construct();
		}

        // função para formar o objeto Veiculo
        private function formar_objeto($dados)
        {
            return new Veiculo
            (
                $dados['id_veiculo'],
                $dados['modelo'],
                $dados['cor'],
                $dados['categoria_veiculo'],
            );
        }

        //função para buscar todos os veiculos
        public function buscar_veiculos()
        {
            $sql = "SELECT * FROM veiculos";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar todos os veiculos";
            }
        }

        // função para buscar veiculos da categoria A
        public function buscar_veiculos_categoria_A($veiculo)
        {
            $sql = "SELECT * FROM veiculos WHERE categoria_veiculo = 'A' ORDER BY modelo";
            try
            {
                $stm = $this->db->prepare($sql);
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os veiculos de categoria A";
            }
        }

        // função para buscar veiculos da categoria B
        public function buscar_veiculos_categoria_B($veiculo)
        {
            $sql = "SELECT * FROM veiculos WHERE categoria_veiculo = 'B' ORDER BY modelo";
            try
            {
                $stm = $this->db->prepare($sql);
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os veiculos de categoria B";
            }
        }

        // função para buscar veiculos das categoria AB
        public function buscar_veiculos_categoria_AB($veiculo)
        {
            $sql = "SELECT * FROM veiculos WHERE categoria_veiculo = 'AB' ORDER BY modelo";
            try
            {
                $stm = $this->db->prepare($sql);
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os veiculos de categoria AB";
            }
        }

        // função para buscar um veiculo
        public function buscar_um_veiculo($veiculo)
        {
            $sql = "SELECT * FROM veiculos WHERE id_veiculo = ? ORDER BY modelo";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $veiculo->getIdVeiculo());
                $stm->execute();
                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar um veiculo";
            }
        }
        
        public function inserir($veiculo)
        {
            $sql = "INSERT INTO veiculos (modelo, cor, categoria_veiculo) VALUES (?,?,?)";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $veiculo->getModelo());
                $stm->bindValue(2, $veiculo->getCor());
                $stm->bindValue(3, $veiculo->getCategoriaVeiculo());

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
            $sql = "UPDATE veiculos SET modelo = ?, categoria_veiculo = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $veiculo->getModelo());
                $stm->bindValue(2, $veiculo->getCor());
                $stm->bindValue(3, $veiculo->getCategoriaVeiculo());
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
                $stm->bindValue(1, $id_veiculo->getIdVeiculo());
                $stm->execute();
                $this->db = null;
                return "Veiculo Excluído";
            }
            catch(PDOException $e)
            {
                $this->db = null;
                return "Problema ao excluir um veiculo";
            }
        }
    }