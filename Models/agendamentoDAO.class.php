<?php

    class AgendamentoDAO extends Conexao
    {
        public function __construct()
        {
            parent::__construct();
        }
    
        // Método para criar um novo agendamento
        public function criar_agendamento(Agendamento $agendamento): bool
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
    
        // Método para buscar agendamentos por ID do aluno
        public function buscar_agendamentos_por_aluno(int $id_aluno): array
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
        public function atualizar_agendamento(Agendamento $agendamento): bool
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
        public function excluir_agendamento(int $id_agendamento): bool
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
    
        // Método privado para formar um objeto Agendamento a partir de um array de dados
        private function formar_objeto(array $dados): Agendamento
        {
            // Obs: Criar métodos estáticos para buscar os objetos Aluno, Instrutor e Veiculo por ID
            $aluno = alunoDAO::buscarPorId($dados['id_aluno']);
            $instrutor = instrutorDAO::buscarPorId($dados['id_instrutor']);
            $veiculo = veiculoDAO::buscarPorId($dados['id_veiculo']);
    
            return new Agendamento(
                $dados['id_agendamento'],
                $aluno,
                $instrutor,
                $veiculo,
                $dados['data_ag'],
                $dados['horario']
            );
        }
    }
    
 