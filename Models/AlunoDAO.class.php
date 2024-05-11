<?php

    class alunoDAO extends Conexao 
    {
        public function __construct()
        {
            parent:: __construct();
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
        public function buscar_alunos_categoria_A($aluno)
        {
            $sql = "SELECT * FROM alunos WHERE categoria_aluno = 'A' ORDER BY nome_aluno";
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
                echo "Problema ao buscar os alunos de categoria A";
            }
        }

        // função para buscar alunos da categoria B
        public function buscar_alunos_categoria_B($aluno)
        {
            $sql = "SELECT * FROM alunos WHERE categoria_aluno = 'B' ORDER BY nome_aluno";
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
                echo "Problema ao buscar os alunos de categoria B";
            }
        }

        // função para buscar alunos das categorias AB
        public function buscar_alunos_categoria_AB($aluno)
        {
            $sql = "SELECT * FROM alunos WHERE categoria_aluno = 'AB' ORDER BY nome_aluno";
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
                echo "Problema ao buscar os alunos de categoria AB";
            }
        }

        // função para buscar um aluno
        public function buscar_um_aluno($aluno)
        {
            $sql = "SELECT * FROM alunos WHERE id_aluno = ? ORDER BY nome_aluno";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $aluno->getIdAluno());
                $stm->execute();
                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar um aluno";
            }
        }

        // função para salvar/cadastrar aluno
        public function inserir($aluno)
        {
            $sql = "INSERT INTO alunos (aulas_restantes, nome_aluno, categoria_aluno, celular_aluno, obs_aluno, email_aluno, senha_aluno) VALUES (?,?,?,?,?,?,?)";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $aluno->getAulasRestantes());
                $stm->bindValue(2, $aluno->getNomeAluno());
                $stm->bindValue(3, $aluno->getCategoriaAluno());
                $stm->bindValue(4, $aluno->getCelularAluno());
                $stm->bindValue(5, $aluno->getObsAluno());
                $stm->bindValue(6, $aluno->getEmailAluno());
                $stm->bindValue(7, $aluno->getSenhaAluno());
                $stm->execute();
                $this->db = null;
                return "Aluno cadastrado com sucesso";
            }
            catch(PDOException $e)
            {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao cadastrar aluno";
            }
        }
        
        // função para alterar aluno
        public function alterar_aluno($aluno)
        {
            $sql = "UPDATE alunos SET aulas_restantes =?, nome_aluno = ?, categoria_aluno = ?, celular_aluno = ?, obs_aluno = ?, email_aluno = ?, senha_aluno = ? WHERE id_aluno = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $aluno->getAulasRestantes());
                $stm->bindValue(2, $aluno->getNomeAluno());
                $stm->bindValue(3, $aluno->getCategoriaAluno());
                $stm->bindValue(4, $aluno->getCelularAluno());
                $stm->bindValue(5, $aluno->getObsAluno());
                $stm->bindValue(6, $aluno->getEmailAluno());
                $stm->bindValue(7, $aluno->getSenhaAluno());
                $stm->bindValue(8, $aluno->getIdAluno());
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
        public function excluir_aluno($id_aluno) // obj
        {
            $sql = "DELETE FROM alunos WHERE id_aluno = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_aluno->getIdAluno());
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