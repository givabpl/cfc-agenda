<?php
    class VeiculoDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        private function formarObjeto($dados)
        {
            return new Veiculo
            (
                $dados['id_veiculo'],
                $dados['modelo'],
                $dados['categoria']
            );
        }
    }