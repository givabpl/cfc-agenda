<?php

    class AlunoDAO extends conexao 
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // função para formar o objeto Aluno
        private function formar_objeto($dados)
        {
            return new Aluno
            (
                $dados['id_aluno'],
                $dados['nome_aluno'],
                $dados['categorias_aluno'],
                $dados['observacao'],
                $dados['aulas_restantes']
            );
        }

        //função para buscar todos os alunos
        public function buscar_alunos()
        {
            $sql = "SELECT * FROM alunos";
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
                echo "Problema ao buscar todos os alunos";
            }
        }

        // função para buscar alunos da categoria A
        public function buscar_alunos_categoria_A(): array
        {
            $sql = "SELECT * FROM alunos WHERE categorias_aluno = 'A' ORDER BY nome_aluno";
            try
            {
                $stm = $this->db->query($sql);
                $alunosCategoriaA = $stm->fetchAll(PDO::FETCH_ASSOC);
                $dadosCategoriaA = array_map
                (
                    function ($a) 
                    {
                        return $this->formar_objeto($a);
                    }, $alunosCategoriaA
                );
                return $dadosCategoriaA;
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os alunos de categoria A";
            }
        }

        // função para buscar alunos da categoria B
        public function buscar_alunos_categoria_B(): array
        {
            $sql = "SELECT * FROM alunos WHERE categorias_aluno = 'B' ORDER BY nome_aluno";
            try
            {
                $stm = $this->db->query($sql);
                $alunosCategoriaB = $stm->fetchAll(PDO::FETCH_ASSOC);
                $dadosCategoriaB = array_map
                (
                    function ($b) 
                    {
                        return $this->formar_objeto($b);
                    }, $alunosCategoriaB
                );
                return $dadosCategoriaB;
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os alunos de categoria B";
            }
        }

        // função para buscar alunos das categorias AB
        public function buscar_alunos_categoria_AB(): array
        {
            $sql = "SELECT * FROM alunos WHERE categorias_aluno = 'AB' ORDER BY nome_aluno";
            try
            {
                $stm = $this->db->query($sql);
                $alunosCategoriaAB = $stm->fetchAll(PDO::FETCH_ASSOC);
                $dadosCategoriaAB = array_map
                (
                    function ($ab) 
                    {
                        return $this->formar_objeto($ab);
                    }, $alunosCategoriaAB
                );
                return $dadosCategoriaAB;
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os alunos de categoria AB";
            }
        }

        // função para buscar um aluno
        // função para salvar aluno
        
        // função para alterar aluno
        public function alterar_aluno(Aluno $aluno)
        {
            $sql = "UPDATE alunos SET nome_aluno = ?, categoria_aluno = ?, celular_aluno = ?,obs_aluno = ?, aulas_restantes = ? WHERE id_aluno = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $aluno->getNomeAluno());
                $stm->bindValue(2, $aluno->getCategoriaAluno());
                $stm->bindValue(3, $aluno->getCelularAluno());
                $stm->bindValue(4, $aluno->getObsAluno());
                $stm->bindValue(5, $aluno->getAulasRestantesAluno());
                $stm->bindValue(6, $aluno->getIdAluno());
                $stm->execute();
                $this->db = null;
                return "Aluno alterado com sucesso";
            }
            catch(PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao alterar aluno";
            }
        }

        // função para deletar aluno
        public function excluir_aluno($aluno) // obj
        {
            $sql = "DELETE FROM alunos WHERE id_aluno = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $aluno->getIdAluno());
                $stm->execute();
                $this->db = null;
                return "Aluno Excluído";
            }
            catch(PDOException $e)
            {
                $this->db = null;
                return "Problema ao excluir um aluno";
            }
        }
    }