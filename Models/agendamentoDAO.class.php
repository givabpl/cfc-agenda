<?php

    class agendamentoDAO extends Conexao {

        public function __construct()
        {
            parent:: __construct();
        }

        // Método para calcular o horário de término da aula
        public function calcularTerminoAula()
        {
            // Converte a data e o horário do agendamento para um objeto DateTime
            $dataHoraAgendamento = new DateTime($this->data_ag . ' ' . $this->horario);

            // Adiciona a duração da aula em minutos ao horário do agendamento
            $dataHoraTermino = clone $dataHoraAgendamento;
            $dataHoraTermino->add(new DateInterval('PT' . $this->duracao . 'M'));

            // Retorna a data e o horário de término da aula
            return $dataHoraTermino->format('Y-m-d H:i:s');
        }
    }