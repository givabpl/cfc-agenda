<?php
   class Agendamento
   {
       private $duracao = 60; // Duração padrão da aula em minutos (1 hora)
   
       public function __construct(
            private int $id_agendamento = 0, 
            private Aluno $aluno, 
            private Instrutor $instrutor, 
            private Veiculo $veiculo, 
            private string $data_ag, 
            private string $horario){}
   
       // Métodos Getters e Setters...
   
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
   