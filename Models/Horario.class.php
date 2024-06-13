<?php
    class Horarios
    {
        public function __construct(
            private int $id_horario = 0,
            private string $hora = ""
        ){}

        public function getIdHorario()
        {
            return $this->id_horario;
        }
        public function getHora()
        {
            return $this->hora;
        }
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
            $horarios[] = new Horarios($id++, $hora->format('H:i'));
        }

        return $horarios;
    }

    $arrayDeHorarios = gerarHorarios();

    // Exemplo de impressão dos horários
    foreach ($arrayDeHorarios as $horario) {
        echo "ID: " . $horario->getIdHorario() . " - Hora: " . $horario->getHora() . "\n";
    }
?>
