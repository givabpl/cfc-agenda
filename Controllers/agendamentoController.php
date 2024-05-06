<?php
    date_default_timezone_set("America/Sao_Paulo");
    if(!isset($_SESSION))
    {
        session_start();
    }
    require_once "models/Conexao.class.php";
    require_once "models/Agendamento.class.php";
    require_once "models/agendamentoDAO.class.php";
    require_once "models/Aluno.class.php";
    require_once "models/alunoDAO.class.php";
    require_once "models/Veiculo.class.php";
    require_once "models/veiculoDAO.class.php";
    require_once "models/Instrutor.class.php";
    require_once "models/instrutorDAO.class.php";
    require_once "Models/Usuario.class.php";
    require_once "Models/Itens.class.php";

    class agendamentoController 
    {
        public function ciar_agendamento()
        {
            if(isset($_SESSION["idusuario"]))
            {
                $usuario = new Usuario($_SESSION["idusuario"]);
                $
            }
            return new Agendamento
            (
                $dados['id_agendamento'],
                $dados['id_aluno'],
                $dados['nome_aluno'],
                $dados['data_aula'],
                $dados['hora_inicio'],
                $dados['hora_conclusao'],
                $dados['id_instrutor'],
                $dados['nome_instrutor'],
                $dados['id_veiculo'],
                $dados['categoria'],
                $dados['modelo']
            );
        }

        public function buscarTodos()
        {
            $sql = "SELECT * FROM agendamentos ORDER BY data_aula, hora_inicio";
            $statement = $this->pdo->query($sql); // query method expects an sql
            // query method will return a statement
            $dados = $statement->fetchAll(PDO::FETCH_ASSOC); 
            // from statement we have a mthod called fetchAll()
            // it's informing php to bring all the data trought PDO
            // this gives back an assossiative array with all data ($dados)

            $todosOsDados = array_map(function ($agendamento) 
            {
                return $this->formarObjeto($agendamento);
            }, $dados);

            return $todosOsDados;
        }

        public function buscar(int $id_agendamento)
        {
            $sql = "SELECT * FROM agendamentos WHERE id_agendamento = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id_agendamento);
            $statement->execute();

            $dados = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->formarObjeto($dados);
        }

        public function deletar(int $id_agendamento)
        {
            $sql = "DELETE FROM agendamentos WHERE id_agendamento=?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id_agendamento);
            $statement->execute();
        }

        public function salvar(Agendamento $agendamento)
        {
            $sql = "INSERT INTO agendamentos (id_aluno, nome_aluno, data_aula, hora_inicio, hora_conclusao, id_instrutor, nome_instrutor, id_veiculo, categoria, modelo) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $agendamento->getAluno()->getIdAluno());
            $statement->bindValue(2, $agendamento->getAluno()->getNomeAluno());
            $statement->bindValue(3, $agendamento->getDataAula());
            $statement->bindValue(4, $agendamento->getHoraInicio());
            $statement->bindValue(5, $agendamento->getHoraConclusao());
            $statement->bindValue(6, $agendamento->getInstrutor()->getIdinstrutor());
            $statement->bindValue(7, $agendamento->getInstrutor()->getNomeInstrutor());
            $statement->bindValue(8, $agendamento->getVeiculo()->getIdVeiculo());
            $statement->bindValue(9, $agendamento->getVeiculo()->getCategoriaVeiculo());
            $statement->bindValue(10, $agendamento->getVeiculo()->getModeloVeiculo());
            $statement->execute();
        }

        public function atualizar(Agendamento $agendamento)
        {
            $sql = "UPDATE agendamentos SET 
                    id_aluno = ?, 
                    nome_aluno = ?, 
                    data_aula = ?, 
                    hora_inicio = ?, 
                    hora_conclusao = ?, 
                    id_instrutor = ?, 
                    nome_instrutor = ?, 
                    id_veiculo = ?, 
                    categoria = ?, 
                    modelo = ? 
                    WHERE id_agendamento = ?";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $agendamento->getIdAluno());
            $statement->bindValue(2, $agendamento->getNomeAluno());
            $statement->bindValue(3, $agendamento->getDataAula());
            $statement->bindValue(4, $agendamento->getHoraInicio());
            $statement->bindValue(5, $agendamento->getHoraConclusao());
            $statement->bindValue(6, $agendamento->getIdInstrutor());
            $statement->bindValue(7, $agendamento->getNomeInstrutor());
            $statement->bindValue(8, $agendamento->getIdVeiculo());
            $statement->bindValue(9, $agendamento->getCategoriaVeiculo());
            $statement->bindValue(10, $agendamento->getModeloVeiculo());
            $statement->bindValue(11, $agendamento->getIdAgendamento());
            $statement->execute();
        }

    }

