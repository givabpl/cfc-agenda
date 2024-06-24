<?php
    // METODOS - BANCO DE DADOS
    class categoriaDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // BUSCAR CATEGORIAS
        public function buscar_categorias()
		{
			$sql = "SELECT * FROM categorias";
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
				return "Problema ao buscar as categorias";
			}
		}

        // BUSCAR UMA CATEGORIA
        public function buscar_uma_categoria($categoria)
        {
            $sql = "SELECT * FROM categorias WHERE id_categoria = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $categoria->getId());
                $stm->execute();
                $this->db = null;
			    return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar um categoria";
                return null;
            }
        }
    }