<?php
class Instrutor {
    private ?int $id_instrutor;
    private string $nome_instrutor;
    private string $categorias_instrutor; // Pode ser um array para permitir múltiplas categorias_instrutor
    private string $observacao;

    public function __construct(?int $id_instrutor, string $nome_instrutor, string $categorias_instrutor, string $observacao) 
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
    public function getNome(): string
    {
        return $this->nome_instrutor;
    }
    public function getCategorias(): string
    {
        return $this->categorias_instrutor;
    }
    public function getObservacao(): string 
    {
        return $this->observacao;
    }
}

?>