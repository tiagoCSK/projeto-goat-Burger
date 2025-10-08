<?php
class Conexao {
  private $server = "localhost";
  private $user = "root";
  private $password = "1234";
  private $database = "projetogoat";
  private $mysqli;

  public function __construct() {
    $this->mysqli = new mysqli($this->server, $this->user, $this->password, $this->database);
    if ($this->mysqli->connect_error) {
      die("Erro na conexão: " . $this->mysqli->connect_error);
    }
  }

  public function getMysqli() {
    return $this->mysqli;
  }
}
?>