<?php
class Instrutor {
    public function __construct(
        private ?int $id_instrutor,
        private string $nome_instrutor,
        private string $categorias_instrutor, 
        private string $observacao) 
    {
        $this->id_instrutor = $id_instrutor;
        $this->nome_instrutor = $nome_instrutor;
        $this->categorias_instrutor = $categorias_instrutor;
        $this->observacao = $observacao;
    }

    public function getIdinstrutor(): ?int 
    {
        return $this->id_instrutor;
    }
    public function getNomeInstrutor(): string
    {
        return $this->nome_instrutor;
    }
    public function getCategoriasInstrutor(): string
    {
        return $this->categorias_instrutor;
    }
    public function getObservacaoInstrutor(): string 
    {
        return $this->observacao;
    }
}

