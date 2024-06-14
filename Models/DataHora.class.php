<?php
class DataHora
{
    public function __construct(
        private int $id_dh = 0,
        private string $data = "",
        private string $hora = ""
    ){}

    public function getIdDataHora()
    {
        return $this->id_dh;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getHora()
    {
        return $this->hora;
    }
}
