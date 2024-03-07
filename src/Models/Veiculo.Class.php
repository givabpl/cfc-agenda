<?php
class Veiculo {
    public function __construct(
        private ?int $id_veiculo, 
        private string $modelo, 
        private string $categoria) 
    {
        $this->id_veiculo = $id_veiculo;
        $this->modelo = $modelo;
        $this->categoria = $categoria;
    }

    public function getIdVeiculo(): ?int 
    {
        return $this->id_veiculo;
    }
    public function getModeloVeiculo(): string
    {
        return $this->modelo;
    }

    public function getCategoriaVeiculo(): string
    {
        return $this->categoria;
    }
}

