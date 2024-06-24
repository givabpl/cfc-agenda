<?php
    // METODOS - BANCO DE DADOS
    class veiculoDAO extends Conexao
    {
        public function __construct()
		{
			parent:: __construct();
		}

        // BUSCAR VEICULOS & RESPECTIVAS CATEGORIAS
        public function buscar_veiculos_categorias()
		{
			$sql = "SELECT v.*, c.descritivo as categoria FROM veiculos as v, categorias as c WHERE v.id_categoria = c.id_categoria";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}

        // BUSCAR VEICULOS
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
				$this->db = null;
				return "Problema ao buscar os veículos";
			}
		}

        // BUSCAR UM VEICULO
        public function buscar_um_veiculo($veiculo)
        {
            $sql = "SELECT * FROM veiculos WHERE id_veiculo = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $veiculo->getIdVeiculo());
                $stm->execute();
                $this->db = null;
			    return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar um veiculo";
                return null;
            }
        }
        
        // INSERIR VEICULO
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
        
        // ALTERAR VEICULO
        public function alterar_veiculo($veiculo)
        {
            $sql = "UPDATE veiculos SET id_categoria = ?, modelo = ?, cor = ? WHERE id_veiculo = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $veiculo->getCategoriaVeiculo()->getId());
                $stm->bindValue(2, $veiculo->getModelo());
                $stm->bindValue(3, $veiculo->getCor());
                $stm->bindValue(4, $veiculo->getIdVeiculo());
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

        // EXCLUIR VEICULO
        public function excluir_veiculo($veiculo) // obj
        {
            $sql = "DELETE FROM veiculos WHERE id_veiculo = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $veiculo->getIdVeiculo());
                $stm->execute();
                $this->db = null;
                return "Veículo excluído com sucesso";
            } 
            catch (PDOException $e) 
            {
                $this->db = null;
                echo "Problema ao excluir um veiculo";
            }
        }
    }