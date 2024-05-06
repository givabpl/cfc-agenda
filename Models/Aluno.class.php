<?php
    class Aluno 
    {
        public function __construct(
            private ?int $id_aluno, 
            private int $aulas_restantes = 0,
            private string $nome_aluno, 
            private string $categoria_aluno, 
            private string $celular_aluno,
            private string $obs_aluno, 
            private string $email_aluno,
            private string $senha_aluno,
            
        ) 
        {
            $this->id_aluno = $id_aluno;
            $this->aulas_restantes = $aulas_restantes;
            $this->nome_aluno = $nome_aluno;
            $this->categoria_aluno = $categoria_aluno;
            $this->celular_aluno = $celular_aluno;
            $this->obs_aluno = $obs_aluno;
            $this->email_aluno = $email_aluno;
            $this->senha_aluno = $senha_aluno;
        }

        public function getIdAluno(): ?int 
        { 
            return $this->id_aluno; 
        }
        public function getAulasRestantes(): int 
        { 
            return $this->aulas_restantes; 
        }
        public function getNomeAluno(): string 
        { 
            return $this->nome_aluno; 
        }
        public function getCategoriaAluno(): string 
        { 
            return $this->categoria_aluno; 
        }
        public function getCelularAluno(): string 
        { 
            return $this->celular_aluno; 
        }
        public function getObsAluno(): string 
        { 
            return $this->obs_aluno; 
        }
        public function getEmailAluno(): string 
        { 
            return $this->email_aluno; 
        }
        public function getSenhaAluno(): string
        { 
            return $this->senha_aluno; 
        }

    }
