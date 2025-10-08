<?php
class Usuario {
    private $id_usuario;
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    private $senha;

    public function __construct($nome = "", $email = "", $telefone = "", $endereco = "", $senha = "", $id_usuario = null) {
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->senha = $senha;
    }

    public function getIdUsuario() { return $this->id_usuario; }
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }
    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) { $this->telefone = $telefone; }
    public function getEndereco() { return $this->endereco; }
    public function setEndereco($endereco) { $this->endereco = $endereco; }
    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }

    public function __toString() {
        return "<hr>
                <ul>
                    <li>ID: {$this->id_usuario}</li>
                    <li>Nome: {$this->nome}</li>
                    <li>Email: {$this->email}</li>
                    <li>Telefone: {$this->telefone}</li>
                    <li>Endereço: {$this->endereco}</li>
                </ul>";
    }
}