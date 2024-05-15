<?php

    class alunoDAO extends Conexao 
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // formar objeto Aluno a partir de array de dados
        private function formar_objeto($dados): Aluno
        {
            return new Aluno(
                $dados['id_aluno'],
                $dados['aulas_restantes'],
                $dados['nome_aluno'],
                $dados['categoria_aluno'],
                $dados['celular_aluno'],
                $dados['obs_aluno'],
                $dados['email_aluno'],
                $dados['senha_aluno']
            );
        }

        // Função para buscar todos os alunos
        public function buscar_alunos(): array
        {
            $sql = "SELECT * FROM alunos";
            try {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                $alunos = [];
                foreach ($resultados as $row) {
                    $alunos[] = $this->formar_objeto($row);
                }
                $this->db = null;
                return $alunos;
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar todos os alunos";
                return [];
            }
        }

        // Função para buscar alunos da categoria A
        public function buscar_alunos_categoria_A(): array
        {
            $sql = "SELECT * FROM alunos WHERE categoria_aluno = 'A' ORDER BY nome_aluno";
            try {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                $alunos = [];
                foreach ($resultados as $row) {
                    $alunos[] = $this->formar_objeto($row);
                }
                $this->db = null;
                return $alunos;
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os alunos de categoria A";
                return [];
            }
        }

        // Função para buscar alunos da categoria B
        public function buscar_alunos_categoria_B(): array
        {
            $sql = "SELECT * FROM alunos WHERE categoria_aluno = 'B' ORDER BY nome_aluno";
            try {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                $alunos = [];
                foreach ($resultados as $row) {
                    $alunos[] = $this->formar_objeto($row);
                }
                $this->db = null;
                return $alunos;
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os alunos de categoria B";
                return [];
            }
        }

        // Função para buscar alunos das categorias AB
        public function buscar_alunos_categoria_AB(): array
        {
            $sql = "SELECT * FROM alunos WHERE categoria_aluno = 'AB' ORDER BY nome_aluno";
            try {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                $alunos = [];
                foreach ($resultados as $row) {
                    $alunos[] = $this->formar_objeto($row);
                }
                $this->db = null;
                return $alunos;
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar os alunos de categoria AB";
                return [];
            }
        }

        // Função para buscar um aluno
        public function buscar_um_aluno($id_aluno): ?Aluno
        {
            $sql = "SELECT * FROM alunos WHERE id_aluno = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_aluno);
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
                echo "Problema ao buscar um aluno";
                return null;
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