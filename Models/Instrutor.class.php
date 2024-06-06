<?php
    class Instrutor 
    {
        public function __construct(
            private $categoria = null, 
            private int $id_instrutor = 0,
            private string $nome_instrutor = "",
            private string $celular_instrutor = "",
            private string $obs_instrutor = ""
        ){}

        public function getIdInstrutor()
        {
            return $this->id_instrutor;
        }
        public function getNomeInstrutor()
        {
            return $this->nome_instrutor;
        }
        public function getCategoriaInstrutor()
        {
            return $this->categoria;
        }
        public function getCelularInstrutor()
        {
            return $this->celular_instrutor;
        }
        public function getObsInstrutor()
        {
            return $this->obs_instrutor;
        }
    }

