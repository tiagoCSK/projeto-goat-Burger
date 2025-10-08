<?php  
require_once "Conexao.php";
class UsuarioDAO {
    private $con;
    private $table = "Usuario";
    private $id = "id_usuario";

    private function getCon() {
        $bd = new Conexao();
        $this->con = $bd->getMysqli();
        return $this->con;
    }

    public function salvar(Usuario $u) {
        $sql = "INSERT INTO {$this->table} (nome,email,telefone,endereco,senha)
                VALUES(
                    '{$u->getNome()}',
                    '{$u->getEmail()}',
                    '{$u->getTelefone()}',
                    '{$u->getEndereco()}',
                    '{$u->getSenha()}'
                )";

        $status = $this->getCon()->query($sql);
        $this->getCon()->close();
        return $status;
    }

}