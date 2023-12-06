<?php
class Aluno {
    private ?int $id_aluno;
    private string $nome_aluno;
    private string $categorias_aluno; // Pode ser um array para permitir múltiplas categorias_aluno
    private string $observacao;
    private int $aulas_restantes;

    public function __construct(?int $id_aluno, string $nome_aluno, string $categorias_aluno, string $observacao, int $aulas_restantes) 
        {
            $this->id_aluno = $id_aluno;
            $this->nome_aluno = $nome_aluno;
            $this->categorias_aluno = $categorias_aluno;
            $this->observacao = $observacao;
            $this->aulas_restantes = $aulas_restantes;
        }

        public function getId(): ?int 
        { 
            return $this->id_aluno; 
        }

        public function getNome(): string 
        { 
            return $this->nome_aluno; 
        }
        public function getCategorias(): string 
        { 
            return $this->categorias_aluno; 
        }
        public function getObservacao(): string 
        { 
            return $this->observacao; 
        }
        public function getAulasRestantes(): int
        {
            return $this->aulas_restantes;
        }
}
?>