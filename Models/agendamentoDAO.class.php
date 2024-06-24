<?php
    // METODO: BANCO DE DADOS
    class AgendamentoDAO extends Conexao
    {
        public function __construct()
        {
            parent::__construct();
        }
    
        // CRIAR AGENDAMENTO
        public function criar_agendamento(Agendamento $agendamento)
        {
            $sql = "INSERT INTO agendamentos (id_aluno, id_instrutor, id_veiculo, datahora) VALUES (?, ?, ?, ?)";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $agendamento->getAluno()->getIdAluno());
                $stm->bindValue(2, $agendamento->getInstrutor()->getIdInstrutor());
                $stm->bindValue(3, $agendamento->getVeiculo()->getIdVeiculo());
                $stm->bindValue(4, $agendamento->getDataHora()->getIdDataHora());
                return $stm->execute();
            } catch (PDOException $e) {
                // Lançar exceção para que o chamador possa lidar com o erro
                throw new Exception("Erro ao criar agendamento: " . $e->getMessage(), $e->getCode());
            }
        }
    
        // BUSCAR TODOS AGENDAMENTOS
        public function buscar_agendamentos()
        {
            $sql = "
                SELECT 
                    ag.*, 
                    d.data_ag,
                    h.horario,
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


        // BUSCAR UM AGENDAMENTO
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


        // BUSCAR AGENDAMENTOS POR ALUNO
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

        // BUSCAR AGENDAMENTOS POR INSTRUTOR
        public function buscar_agendamentos_por_instrutor($id_instrutor)
        {
            $sql = "SELECT * FROM agendamentos WHERE id_instrutor = ?";
            try 
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $id_instrutor);
                $stm->execute();
                $resultados = $stm->fetchAll(PDO::FETCH_ASSOC);
                return $resultados;
            } catch (PDOException $e) {
                throw new Exception("Erro ao buscar agendamentos do instrutor: " . $e->getMessage(), $e->getCode());
            }
        }

        // LISTAR AGENDAMENTOS POR INSTRUTOR
        public function listar_agendamentos_por_instrutor()
        {
            $sql = "SELECT ag.*, i.nome_instrutor as instrutor FROM agendamentos as ag, instrutores as i WHERE ag.id_instrutor = i.id_instrutor";
        }

    
        // ATUALIZAR AGENDAMENTO
        public function atualizar_agendamento(Agendamento $agendamento)
        {
            $sql = "UPDATE agendamentos SET id_aluno = ?, id_instrutor = ?, id_veiculo = ?, datahora = ? WHERE id_agendamento = ?";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $agendamento->getAluno()->getIdAluno());
                $stm->bindValue(2, $agendamento->getInstrutor()->getIdInstrutor());
                $stm->bindValue(3, $agendamento->getVeiculo()->getIdVeiculo());
                $stm->bindValue(4, $agendamento->getDataHora()->getIdDataHora());
                $stm->bindValue(5, $agendamento->getIdAgendamento());
                return $stm->execute();
            } catch (PDOException $e) {
                throw new Exception("Erro ao atualizar agendamento: " . $e->getMessage(), $e->getCode());
            }
        }
    
        // EXCLUIR AGENDAMENTO
        public function excluir_agendamento($agendamento)
        {
            $sql = "DELETE FROM agendamentos WHERE id_agendamento = ?";
            try 
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $agendamento->getIdAgendamento());
                return $stm->execute();
            } 
            catch (PDOException $e) 
            {
                throw new Exception("Erro ao excluir agendamento: " . $e->getMessage(), $e->getCode());
            }
        }
    
        
    }
    
 
