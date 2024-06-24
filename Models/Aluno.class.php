<?php
    class Aluno 
    {
        public function __construct(
            private int $id_aluno = 0, 
            private $categoria = null, 
            private int $aulas_restantes = 0,
            private string $nome_aluno = "", 
            private string $celular_aluno = "",
            private string $obs_aluno = "", 
            private string $imagem = ""
        ) {}

        public function getIdAluno()
        { 
            return $this->id_aluno; 
        }
        public function getAulasRestantes()
        { 
            return $this->aulas_restantes; 
        }
        public function getNomeAluno()
        { 
            return $this->nome_aluno; 
        }
        public function getCategoriaAluno()
        { 
            return $this->categoria; 
        }
        public function getCelularAluno()
        { 
            return $this->celular_aluno; 
        }
        public function getObsAluno()
        { 
            return $this->obs_aluno; 
        }
        public function getImagem()
        { 
            return $this->imagem; 
        }

    }
