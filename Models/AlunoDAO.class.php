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
           // $categoriaDAO = new categoriaDAO();
            //$categoria = $categoriaDAO->buscar_uma_categoria($dados['id_categoria']);
            return new Aluno(
                $dados['id_categoria'],
                $dados['id_aluno'],
                $dados['aulas_restantes'],
                $dados['nome_aluno'],
                $dados['celular_aluno'],
                $dados['obs_aluno'],
                $dados['imagem']
            );
        }

        // Função para buscar todos os alunos
        /*public function buscar_alunos(): array
        {
            $sql = "SELECT a.*, c.descritivo FROM alunos a JOIN categorias c ON a.id_categoria = c.id_categoria";
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
        }*/
        public function buscar_alunos()
		{
			$sql = "SELECT a.*, c.descritivo as categoria FROM alunos as a, categorias as c WHERE a.id_categoria = c.id_categoria";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}

        // Função para buscar alunos da categoria A
        public function buscar_alunos_categoria_A()
        {
            $sql = "SELECT * FROM alunos WHERE categoria = 'A' ORDER BY nome_aluno";
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
        public function buscar_alunos_categoria_B()
        {
            $sql = "SELECT * FROM alunos WHERE categoria = 'B' ORDER BY nome_aluno";
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
        public function buscar_alunos_categoria_AB()
        {
            $sql = "SELECT * FROM alunos WHERE categoria = 'AB' ORDER BY nome_aluno";
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
        // função para inserir/cadastrar aluno
        public function inserir($aluno)
        {
            $sql = "INSERT INTO alunos (id_categoria, aulas_restantes, nome_aluno,  celular_aluno, obs_aluno, imagem) VALUES (?,?,?,?,?,?)";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $aluno->getCategoriaAluno()->getId());
                $stm->bindValue(2, $aluno->getAulasRestantes());
                $stm->bindValue(3, $aluno->getNomeAluno());
                $stm->bindValue(4, $aluno->getCelularAluno());
                $stm->bindValue(5, $aluno->getObsAluno());
                $stm->bindValue(6, $aluno->getImagem()); 
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
            $sql = "UPDATE alunos SET id_categoria = ?, aulas_restantes =?, nome_aluno = ?, celular_aluno = ?, obs_aluno = ?, imagem = ? WHERE id_aluno = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $aluno->getCategoriaAluno()->getId());
                $stm->bindValue(2, $aluno->getAulasRestantes());
                $stm->bindValue(3, $aluno->getNomeAluno());
                $stm->bindValue(4, $aluno->getCelularAluno());
                $stm->bindValue(5, $aluno->getObsAluno());
                $stm->bindValue(6, $aluno->getImagem()); // Inclui a imagem
                $stm->bindValue(7, $aluno->getIdAluno());
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
        public function excluir_aluno($id_aluno) // obj - apenas $id
        {
            $sql = "DELETE FROM alunos WHERE id_aluno = ?";
            try
            {
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
                echo "Problema ao excluir um aluno";
                return null;
            }
        }
    }