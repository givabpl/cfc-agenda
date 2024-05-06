<?php
    class Agendamento
    {
        public function __construct(
            private ?int $id_agendamento,
            private Aluno $aluno,
            private string $data_aula,
            private string $hora_inicio,
            private string $hora_conclusao,
            private Instrutor $instrutor,
            private Veiculo $veiculo
        ) {
            $this->id_agendamento = $id_agendamento;
            $this->aluno = $aluno;
            $this->data_aula = $data_aula;
            $this->hora_inicio = $hora_inicio;
            $this->hora_conclusao = $hora_conclusao;
            $this->instrutor = $instrutor;
            $this->veiculo = $veiculo;
        }

        public function getIdAgendamento(): ?int
        {
            return $this->id_agendamento;
        }

        public function getAluno(): Aluno
        {
            return $this->aluno;
        }

        public function getDataAula(): string
        {
            return $this->data_aula;
        }

        public function getHoraInicio(): string
        {
            return $this->hora_inicio;
        }

        public function getHoraConclusao(): string
        {
            return $this->hora_conclusao;
        }

        public function getInstrutor(): Instrutor
        {
            return $this->instrutor;
        }

        public function getVeiculo(): Veiculo
        {
            return $this->veiculo;
        }
    }

