<?php
    class Conexao
    {
        public function __construct(protected $db = null)
        {
            $parametros = "mysql:host=localhost;dbname=cfc_agenda;charset=utf8mb4";

            $this->db = new PDO($parametros, "root", "vot38m7Ps-byb");
        }
    }