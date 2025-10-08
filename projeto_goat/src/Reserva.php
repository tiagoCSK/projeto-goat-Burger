<?php



class Reserva {
    private $id_reserva;
    private $data_reserva;
    private $horario;
    private $quantidade_pessoas;
    private $preferencia;
    private $restricao;
    private $comentario;

    public function __construct($data_reserva = null, $horario = null, $quantidade_pessoas = 1, $preferencia = "almoco", $restricao = "nao", $comentario = "", $id_reserva = null) {
        $this->id_reserva = $id_reserva;
        $this->data_reserva = $data_reserva;
        $this->horario = $horario;
        $this->quantidade_pessoas = $quantidade_pessoas;
        $this->preferencia = $preferencia;
        $this->restricao = $restricao;
        $this->comentario = $comentario;
    }

    public function getIdReserva() { return $this->id_reserva; }
    public function setIdReserva($id_reserva) {$this->id_reserva = $id_reserva; }
    public function getDataReserva() { return $this->data_reserva; }
    public function setDataReserva($data) { $this->data_reserva = $data; }
    public function getHorario() { return $this->horario; }
    public function setHorario($horario) { $this->horario = $horario; }
    public function getQuantidadePessoas() { return $this->quantidade_pessoas; }
    public function setQuantidadePessoas($qtd) { $this->quantidade_pessoas = $qtd; }
    public function getPreferencia() { return $this->preferencia; }
    public function setPreferencia($pref) { $this->preferencia = $pref; }
    public function getRestricao() { return $this->restricao; }
    public function setRestricao($res) { $this->restricao = $res; }
    public function getComentario() { return $this->comentario; }
    public function setComentario($comentario) { $this->comentario = $comentario; }

    public function __toString() {
        return "<hr>
                <ul>
                    <li>ID Reserva: {$this->id_reserva}</li>
                    <li>Data: {$this->data_reserva}</li>
                    <li>Horário: {$this->horario}</li>
                    <li>Qtd Pessoas: {$this->quantidade_pessoas}</li>
                    <li>Preferência: {$this->preferencia}</li>
                    <li>Restrição: {$this->restricao}</li>
                    <li>Comentário: {$this->comentario}</li>
                </ul>";
    }
}


