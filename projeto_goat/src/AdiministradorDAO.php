<?php
require_once "Conexao.php";
class AdministradorDAO {
    private $con;
    private $table = "Administrador";
    private $id = "id_adm";

    private function getCon() {
        $bd = new Conexao();
        $this->con = $bd->getMysqli();
        return $this->con;
    }

    public function salvar(Administrador $adm) {
        $sql = "INSERT INTO {$this->table} (nome,email,senha)
                VALUES(
                    '{$adm->getNome()}',
                    '{$adm->getEmail()}',
                    '{$adm->getSenha()}'
                )";

        $status = $this->getCon()->query($sql);
        $this->getCon()->close();
        return $status;
    }

}