<?php

class Secretaria {
    public function __construct(
        private int $id_secretaria = 0,
        private string $nome_secretaria = "",
        private string $email = "",
        private string $senha = ""
    ){}

    public function getIdSecretaria()
    {
        return $this->id_secretaria;
    }

    public function getNomeSecretaria()
    {
        return $this->nome_secretaria;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }
}