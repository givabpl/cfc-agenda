<?php
class Veiculo {
    public function __construct(
        private int $id_veiculo = 0, 
        private string $modelo = "", 
        private string $cor = "",
        private string $categoria_veiculo = ""
    ){}

    public function getIdVeiculo()
    {
        return $this->id_veiculo;
    }
    public function getModelo()
    {
        return $this->modelo;
    }
    public function getCor()
    {
        return $this->cor;
    }
    public function getCategoriaVeiculo()
    {
        return $this->categoria_veiculo;
    }
}

