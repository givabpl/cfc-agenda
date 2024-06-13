<?php

    class AgendamentoDAO extends Conexao
    {
        public function __construct()
        {
            parent::__construct();
        }

        // Método privado para formar um objeto Agendamento a partir de um array de dados
        private function formar_objeto($dados): Agendamento
        {
            $alunoDAO = new alunoDAO();
            $aluno = $alunoDAO->buscar_um_aluno($dados['id_aluno']);

            $instrutorDAO = new instrutorDAO();
            $instrutor = $instrutorDAO->buscar_um_instrutor($dados['id_instrutor']);

            $veiculoDAO = new veiculoDAO();
            $veiculo = $veiculoDAO->buscar_um_veiculo($dados['id_veiculo']);

            // $categoriaDAO = new categoriaDAO();
            // $categoria = $categoriaDAO->buscar_uma_categoria($dados['id_categoria']);
            return new Agendamento(
                $aluno,
                $instrutor,
                $veiculo,
                $dados['id_ag'],
                $dados['data_ag'],
                $dados['horario']
            );
        }

    
        // Método para criar um novo agendamento
        public function criar_agendamento(Agendamento $agendamento)
        {
            $sql = "INSERT INTO agendamentos (id_aluno, id_instrutor, id_veiculo, data_ag, horario) VALUES (?, ?, ?, ?, ?)";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $agendamento->getAluno()->getIdAluno());
                $stm->bindValue(2, $agendamento->getInstrutor()->getIdInstrutor());
                $stm->bindValue(3, $agendamento->getVeiculo()->getIdVeiculo());
                $stm->bindValue(4, $agendamento->getDataAg());
                $stm->bindValue(5, $agendamento->getHorario());
                return $stm->execute();
            } catch (PDOException $e) {
                // Lançar exceção para que o chamador possa lidar com o erro
                throw new Exception("Erro ao criar agendamento: " . $e->getMessage(), $e->getCode());
            }
        }
    
        // Método para buscar todos os agendamentos
        public function buscar_agendamentos()
        {
            $sql = "
                SELECT 
                    ag.*, 
                    a.nome_aluno, 
                    i.nome_instrutor, 
                    v.modelo 
                FROM 
                    agendamentos as ag
                JOIN 
                    alunos as a ON ag.id_aluno = a.id_aluno
                JOIN 
                    instrutores as i ON ag.id_instrutor = i.id_instrutor
                JOIN 
                    veiculos as v ON ag.id_veiculo = v.id_veiculo
            ";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }


        // Método para buscar um agendamento por ID
        public function buscar_agendamento_por_id($id_agendamento)
        {
            $sql = "SELECT * FROM agendamentos WHERE id_agendamento = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_agendamento);
                $stm->execute();
                $dados = $stm->fetch(PDO::FETCH_ASSOC);
                if ($dados) {
                    return $this->formar_objeto($dados);
                }
                return null;
            } catch (PDOException $e) {
                throw new Exception("Erro ao buscar agendamento: " . $e->getMessage(), $e->getCode());
            }
        }


        // Método para buscar agendamentos por ID do aluno
        public function buscar_agendamentos_por_aluno($id_aluno)
        {
            $sql = "SELECT * FROM agendamentos WHERE id_aluno = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_aluno);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
    
                $agendamentos = [];
                foreach ($resultados as $row) {
                    $agendamentos[] = $this->formar_objeto($row);
                }
                return $agendamentos;
            } catch (PDOException $e) {
                throw new Exception("Erro ao buscar agendamentos por aluno: " . $e->getMessage(), $e->getCode());
            }
        }
    
        // Método para atualizar um agendamento
        public function atualizar_agendamento(Agendamento $agendamento)
        {
            $sql = "UPDATE agendamentos SET id_aluno = ?, id_instrutor = ?, id_veiculo = ?, data_ag = ?, horario = ? WHERE id_agendamento = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $agendamento->getAluno()->getIdAluno());
                $stm->bindValue(2, $agendamento->getInstrutor()->getIdInstrutor());
                $stm->bindValue(3, $agendamento->getVeiculo()->getIdVeiculo());
                $stm->bindValue(4, $agendamento->getDataAg());
                $stm->bindValue(5, $agendamento->getHorario());
                $stm->bindValue(6, $agendamento->getIdAgendamento());
                return $stm->execute();
            } catch (PDOException $e) {
                throw new Exception("Erro ao atualizar agendamento: " . $e->getMessage(), $e->getCode());
            }
        }
    
        // Método para excluir um agendamento
        public function excluir_agendamento($id_agendamento)
        {
            $sql = "DELETE FROM agendamentos WHERE id_agendamento = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_agendamento);
                return $stm->execute();
            } catch (PDOException $e) {
                throw new Exception("Erro ao excluir agendamento: " . $e->getMessage(), $e->getCode());
            }
        }
    
        
    }
    
 