<?php
    // METODOS - BANCO DE DADOS
    class alunoDAO extends Conexao 
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // BUSCAR ALUNOS & RESPECTIVAS CATEGORIAS
        public function buscar_alunos_categorias()
		{
			$sql = "SELECT a.*, c.descritivo as categoria FROM alunos as a, categorias as c WHERE a.id_categoria = c.id_categoria";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}

        // BUSCAR ALUNOS
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
				$this->db = null;
				return "Problema ao buscar os alunos";
			}
		}

        // BUSCAR UM ALUNO
        public function buscar_um_aluno($aluno)
        {
            $sql = "SELECT * FROM alunos WHERE id_aluno = ?";
            try 
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $aluno->getIdAluno());
                $stm->execute();
                $this->db = null;
			    return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getCode();
                echo $e->getMessage();
                echo "Problema ao buscar um aluno";
                return null;
            }
        }

        // INSERIR ALUNO
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
        
        // ALTERAR ALUNO
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

        // EXCLUIR ALUNO
        public function excluir_aluno($aluno)
		{
            $sql = "DELETE FROM alunos WHERE id_aluno = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $aluno->getIdAluno());
				$stm->execute();
				$this->db = null;
				return "Aluno excluido com sucesso com sucesso";
			}
			catch(PDOException $e)
			{
				if($e->getCode() == "23000")
				{
					return "Aluno contém agendamentos. Não pode ser excluido";
				}
				else
				{
					return "Problema ao excluir aluno";
				}
			}
		}
    }