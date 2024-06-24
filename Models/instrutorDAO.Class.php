<?php
    // METODOS - BANCO DE DADOS
    class instrutorDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // BUSCAR INSTRUTORES & RESPECTIVAS CATEGORIAS
        public function buscar_instrutores_categorias()
        {
            $sql = "SELECT i.*, c.descritivo as categoria FROM instrutores as i, categorias as c WHERE i.id_categoria = c.id_categoria";
            $stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR INSTRUTORES
        public function buscar_instrutores()
        {
            $sql = "SELECT * FROM instrutores";
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
				return "Problema ao buscar os instrutores";
			}
        }

        // BUSCAR UM INSTRUTOR
        public function buscar_um_instrutor($instrutor)
        {
            $sql = "SELECT * FROM instrutores WHERE id_instrutor = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $instrutor->getIdInstrutor());
                $stm->execute();
                $this->db = null;
			    return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar um instrutor";
                return null;
            }
        }
        
        // INSERIR INSTRUTOR
        public function inserir($instrutor)
        {
            $sql = "INSERT INTO instrutores (id_categoria, nome_instrutor, celular_instrutor, obs_instrutor) VALUES (?,?,?,?)";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $instrutor->getCategoriaInstrutor()->getId());
                $stm->bindValue(2, $instrutor->getNomeInstrutor());
                $stm->bindValue(3, $instrutor->getCelularInstrutor());
                $stm->bindValue(4, $instrutor->getObsInstrutor());
                $stm->execute();
                $this->db = null;
                return "Instrutor cadastrado com sucesso";
            }
            catch(PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao cadastrar instrutor";
            }
        }
        
        // ALTERAR INSTRUTOR
        public function alterar_instrutor($instrutor)
        {
            $sql = "UPDATE instrutores SET id_categoria = ?, nome_instrutor = ?,  celular_instrutor = ?,obs_instrutor = ? WHERE id_instrutor = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $instrutor->getCategoriaInstrutor()->getId());
                $stm->bindValue(2, $instrutor->getNomeInstrutor());
                $stm->bindValue(3, $instrutor->getCelularInstrutor());
                $stm->bindValue(4, $instrutor->getObsInstrutor());
                $stm->bindValue(5, $instrutor->getIdInstrutor());
                $stm->execute();
                $this->db = null;
                return "Instrutor alterado com sucesso";
            }
            catch(PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao alterar instrutor";
            }
        }

        // EXCLUIR INSTRUTOR
        public function excluir($instrutor) // obj - apenas $id
        {
            $sql = "DELETE FROM instrutores WHERE id_instrutor = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $instrutor->getIdInstrutor());
                $stm->execute();
                $this->db = null;
                return "Instrutor Excluído";
            }
            catch(PDOException $e)
            {
                $this->db = null;
                return "Problema ao excluir um instrutor";
            }
        }
    }