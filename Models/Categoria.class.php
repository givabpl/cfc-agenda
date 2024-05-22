<?php
    class Categoria
    {
        public function __construct(
            private int $id_categoria = 0,
            private string $descritivo = ""
        ){}

        public function getIdCategoria()
        {
            return $this->id_categoria;
        }
        public function getDescritivo()
        {
            return $this->descritivo;
        }

        public function setIdCategoria($id_categoria)
        {
            $this->id_categoria = $id_categoria;
        }
        public function setDescritivo($descritivo)
        {
            $this->descritivo = $descritivo;
        }
    }