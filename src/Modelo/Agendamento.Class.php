<?php

class Agendamento
{
    private ?int $id_agendamento;
    private int $id_aluno; // obj
    private string $nome_aluno;
    private string $data_aula;
    private string $hora_inicio;
    private string $hora_conclusao;
    private int $id_instrutor; // obj
    private string $nome_instrutor;
    private int $id_veiculo; // obj
    private string $categoria;
    private string $modelo;

    public function __construct(
        ?int $id_agendamento,
        int $id_aluno,
        string $nome_aluno,
        string $data_aula,
        string $hora_inicio,
        string $hora_conclusao,
        int $id_instrutor,
        string $nome_instrutor,
        int $id_veiculo,
        string $categoria,
        string $modelo
    ) {
        $this->id_agendamento = $id_agendamento;
        $this->id_aluno = $id_aluno;
        $this->nome_aluno = $nome_aluno;
        $this->data_aula = $data_aula;
        $this->hora_inicio = $hora_inicio;
        $this->hora_conclusao = $hora_conclusao;
        $this->id_instrutor = $id_instrutor;
        $this->nome_instrutor = $nome_instrutor;
        $this->id_veiculo = $id_veiculo;
        $this->categoria = $categoria;
        $this->modelo = $modelo;
    }

    public function getIdAgendamento(): ?int
    {
        return $this->id_agendamento;
    }

    public function getIdAluno(): int
    {
        return $this->id_aluno;
    }

    public function getNomeAluno(): string
    {
        return $this->nome_aluno;
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

    public function getIdInstrutor(): int
    {
        return $this->id_instrutor;
    }

    public function getNomeInstrutor(): string
    {
        return $this->nome_instrutor;
    }

    public function getIdVeiculo(): int
    {
        return $this->id_veiculo;
    }

    public function getCategoriaVeiculo(): string
    {
        return $this->categoria;
    }

    public function getModeloVeiculo(): string
    {
        return $this->modelo;
    }
}
