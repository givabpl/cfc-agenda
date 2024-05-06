<?php
    class InstrutorDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // função para formar o objeto Instrutor
        private function formar_objeto($dados)
        {
            return new Instrutor
            (
                $dados['id_instrutor'],
                $dados['nome_instrutor'],
                $dados['categorias_instrutor'],
                $dados['observacao']
            );
        }

        //função para buscar todos os instrutores
        public function buscar_instrutores($instrutor)
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
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar todos os instrutores";
            }
        }

        // função para buscar instrutores da categoria A
        public function buscar_instrutores_categoria_A($instrutor): array
        {
            $sql = "SELECT * FROM instrutores WHERE categorias_instrutor = 'A' ORDER BY nome_instrutor";
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
        public function buscar_instrutores_categoria_B($instrutor): array
        {
            $sql = "SELECT * FROM instrutores WHERE categorias_instrutor = 'B' ORDER BY nome_instrutor";
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
        public function buscar_instrutores_categoria_AB($instrutor): array
        {
            $sql = "SELECT * FROM instrutores WHERE categorias_instrutor = 'AB' ORDER BY nome_instrutor";
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
        public function buscar_um_instrutor($instrutor): array
        {
            $sql = "SELECT * FROM instrutores WHERE id_instrutor = ? ORDER BY nome_instrutor";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $instrutor->getIdInstrutor());
                $stm->execute();
                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar um instrutor";
            }
        }
        
        public function salvar_instrutor($instrutor)
        {
            $sql = "INSERT INTO instrutores (nome_instrutor, categoria_instrutor, celular_instrutor, obs_instrutor) VALUES (?,?,?,?)";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $instrutor->getNomeInstrutor());
                $stm->bindValue(2, $instrutor->getCategoriaInstrutor());
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
            $sql = "UPDATE instrutores SET nome_instrutor = ?, categoria_instrutor = ?, celular_instrutor = ?,obs_instrutor = ? WHERE id_instrutor = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $instrutor->getNomeInstrutor());
                $stm->bindValue(2, $instrutor->getCategoriaInstrutor());
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
        public function excluir_instrutor($instrutor) // obj
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