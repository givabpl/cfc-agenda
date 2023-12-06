<?php
class Veiculo {
    private ?int $id_veiculo;
    private string $modelo;
    private string $categoria;

    public function __construct(?int $id_veiculo, string $modelo, string $categoria) 
    {
        $this->id_veiculo = $id_veiculo;
        $this->modelo = $modelo;
        $this->categoria = $categoria;
    }

    public function getIdVeiculo(): ?int 
    {
        return $this->id_veiculo;
    }
    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }
}
?>
