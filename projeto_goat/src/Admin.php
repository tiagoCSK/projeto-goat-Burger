<?php

class Administrador {
    private $id_adm;
    private $nome;
    private $email;
    private $senha;

    public function __construct($nome = "", $email = "", $senha = "", $id_adm = null) {
        $this->id_adm = $id_adm;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getIdAdm() { return $this->id_adm; }
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }
    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }

    public function __toString() {
        return "<hr>
                <ul>
                    <li>ID Adm: {$this->id_adm}</li>
                    <li>Nome: {$this->nome}</li>
                    <li>Email: {$this->email}</li>
                </ul>";
    }
}
