<?php
require_once "Conexao.php";
require_once "Reserva.php";

class ReservaDAO {
    private $con;
    private $table = "Reserva";
    private $id = "id_reserva";

    private function getCon() {
        $bd = new Conexao();
        $this->con = $bd->getMysqli();
        return $this->con;
    }

    public function salvar(Reserva $r) {
        $sql = "INSERT INTO {$this->table} 
                (data_reserva, horario, quantidade_pessoas, preferencia, restricao, comentario)
                VALUES(
                    '{$r->getDataReserva()}',
                    '{$r->getHorario()}',
                    {$r->getQuantidadePessoas()},
                    '{$r->getPreferencia()}',
                    '{$r->getRestricao()}',
                    '{$r->getComentario()}'
                )";

        $status = $this->getCon()->query($sql);
        $this->getCon()->close();
        return $status;
    }

    public function listarTodos() {
        $lista = $this->getCon()->query("SELECT * FROM {$this->table}")->fetch_all(MYSQLI_ASSOC);
        $this->getCon()->close();
        return $lista;
    }

    public function apagar($id) {
        $status = $this->getCon()->query("DELETE FROM {$this->table} WHERE {$this->id} = $id");
        $this->getCon()->close();
        return $status;
    }

    public function atualizar(Reserva $r) {
        $sql = "UPDATE {$this->table} SET 
                    data_reserva = '{$r->getDataReserva()}',
                    horario = '{$r->getHorario()}',
                    quantidade_pessoas = {$r->getQuantidadePessoas()},
                    preferencia = '{$r->getPreferencia()}',
                    restricao = '{$r->getRestricao()}',
                    comentario = '{$r->getComentario()}'
                WHERE {$this->id} = {$r->getIdReserva()}";

        $status = $this->getCon()->query($sql);
        $this->getCon()->close();
        return $status;
    }
}
