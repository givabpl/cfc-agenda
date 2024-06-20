<?php

    class dataHoraDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        function gerarHorarios()
        {
            $horarios = [];
            $inicio = new DateTime('08:00');
            $fim = new DateTime('19:00');

            $intervalo = new DateInterval('PT30M');
            $periodo = new DatePeriod($inicio, $intervalo, $fim->add($intervalo));

            $id = 1;
            foreach ($periodo as $hora) {
                $horarios[] = new DataHora($id++, '', $hora->format('H:i'));
            }

            return $horarios;
        }
        $horariosDisponiveis = gerarHorarios();

    }