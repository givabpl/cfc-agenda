<?php
    class instrutorDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // função para formar o objeto Instrutor
        private function formar_objeto($dados): Instrutor
        {
            $categoriaDAO = new categoriaDAO();
            $categoria = $categoriaDAO->buscar_uma_categoria($dados['id_categoria']);
            return new Instrutor
            (
                $dados['id_categoria'],
                $dados['id_instrutor'],
                $dados['nome_instrutor'],
                $dados['observacao']
            );
        }

        //função para buscar todos os instrutores
        /*public function buscar_instrutores()
        {
            $sql = "SELECT * FROM instrutores";
            try {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                $instrutores = [];
                foreach ($resultados as $row) {
                    $instrutores[] = $this->formar_objeto($row);
                }
                $this->db = null;
                return $instrutores;
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar todos os instrutores";
                return [];
            }
        }*/

        public function buscar_instrutores()
        {
            $sql = "SELECT i.*, c.descritivo as categoria FROM instrutores as i, categorias as c WHERE i.id_categoria = c.id_categoria";
            $stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // função para buscar instrutores da categoria A
        public function buscar_instrutores_categoria_A()
        {
            $sql = "SELECT * FROM instrutores WHERE categoria = 'A' ORDER BY nome_instrutor";
            try
            {
                $stm = $this->db->query($sql);
                $instrutoresCategoriaA = $stm->fetchAll(PDO::FETCH_ASSOC);
                $dadosCategoriaA = array_map
                (
                    function ($a) 
                    {
                        return $this->formar_objeto($a);
                    }, $instrutoresCategoriaA
                );
                return $dadosCategoriaA;
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os instrutores de categoria A";
            }
        }

        // função para buscar instrutores da categoria B
        public function buscar_instrutores_categoria_B()
        {
            $sql = "SELECT * FROM instrutores WHERE categoria = 'B' ORDER BY nome_instrutor";
            try
            {
                $stm = $this->db->query($sql);
                $instrutoresCategoriaB = $stm->fetchAll(PDO::FETCH_ASSOC);
                $dadosCategoriaB = array_map
                (
                    function ($b) 
                    {
                        return $this->formar_objeto($b);
                    }, $instrutoresCategoriaB
                );
                return $dadosCategoriaB;
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os instrutores de categoria B";
            }
        }

        // função para buscar instrutores das categorias AB
        public function buscar_instrutores_categoria_AB()
        {
            $sql = "SELECT * FROM instrutores WHERE categoria = 'AB' ORDER BY nome_instrutor";
            try
            {
                $stm = $this->db->query($sql);
                $instrutoresCategoriaAB = $stm->fetchAll(PDO::FETCH_ASSOC);
                $dadosCategoriaAB = array_map
                (
                    function ($ab) 
                    {
                        return $this->formar_objeto($ab);
                    }, $instrutoresCategoriaAB
                );
                return $dadosCategoriaAB;
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os instrutores de categoria AB";
            }
        }

        // função para buscar um instrutor
        public function buscar_um_instrutor($id_instrutor): ?Instrutor
        {
            $sql = "SELECT * FROM instrutores WHERE id_instrutor = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_instrutor);
                $stm->execute();
                $resultado = $stm->fetch(PDO::FETCH_ASSOC);
                $this->db = null;
                if ($resultado) {
                    return $this->formar_objeto($resultado);
                } else {
                    return null;
                }
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar um instrutor";
                return null;
            }
        }
        
        public function inserir($instrutor)
        {
            $sql = "INSERT INTO instrutores (id_categoria, nome_instrutor,  celular_instrutor, obs_instrutor) VALUES (?,?,?,?)";
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
        
        // função para alterar instrutor
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

        // função para deletar instrutor
        public function excluir($id_instrutor) // obj - apenas $id
        {
            $sql = "DELETE FROM instrutores WHERE id_instrutor = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_instrutor->getIdInstrutor());
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