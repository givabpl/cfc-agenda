<?php
class Aluno {
    public function __construct(
        private ?int $id_aluno, 
        private string $nome_aluno, 
        private string $categorias_aluno, 
        private string $observacao, 
        private int $aulas_restantes) 
        {
            $this->id_aluno = $id_aluno;
            $this->nome_aluno = $nome_aluno;
            $this->categorias_aluno = $categorias_aluno;
            $this->observacao = $observacao;
            $this->aulas_restantes = $aulas_restantes;
        }

        public function getIdAluno(): ?int 
        { 
            return $this->id_aluno; 
        }

        public function getNomeAluno(): string 
        { 
            return $this->nome_aluno; 
        }
        public function getCategoriasAluno(): string 
        { 
            return $this->categorias_aluno; 
        }
        public function getObservacaoAluno(): string 
        { 
            return $this->observacao; 
        }
        public function getAulasRestantesAluno(): int
        {
            return $this->aulas_restantes;
        }
}
