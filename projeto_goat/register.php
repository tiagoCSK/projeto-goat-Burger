<?php
class Conexao {
  private $server = "localhost";
  private $user = "root";
  private $password = "1234";
  private $database = "projetogoat";
  private $mysqli;

  public function __construct() {
    $this->mysqli = new mysqli($this->server, $this->user, $this->password, $this->database);
  }

  public function getMysqli() {
    return $this->mysqli;
  }
}

class Usuario {
  private $nome, $email, $telefone, $endereco, $senha;

  public function __construct($nome, $email, $telefone, $endereco, $senha) {
    $this->nome = $nome;
    $this->email = $email;
    $this->telefone = $telefone;
    $this->endereco = $endereco;
    $this->senha = $senha;
  }

  public function getNome() { return $this->nome; }
  public function getEmail() { return $this->email; }
  public function getTelefone() { return $this->telefone; }
  public function getEndereco() { return $this->endereco; }
  public function getSenha() { return $this->senha; }
}

class UsuarioDAO {
  private $con;
  private $table = "Usuario";

  private function getCon() {
    $bd = new Conexao();
    $this->con = $bd->getMysqli();
    return $this->con;
  }

  public function salvar(Usuario $u) {
    $sql = "INSERT INTO {$this->table} (nome,email,telefone,endereco,senha)
            VALUES (
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

$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $telefone = $_POST["telefone"];
  $endereco = $_POST["endereco"];
  $senha = $_POST["senha"];

  $usuario = new Usuario($nome, $email, $telefone, $endereco, $senha);
  $dao = new UsuarioDAO();

  if ($dao->salvar($usuario)) {
    $mensagem = "✅ Cadastro realizado com sucesso!";
  } else {
    $mensagem = "❌ Erro ao cadastrar usuário.";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro – Usuário</title>
  <link rel="stylesheet" href="assets/css/logins.css">
</head>
<body>
  <div class="login-container">
    <h2>Criar Conta</h2>

    <?php if (!empty($mensagem)): ?>
      <p style="color: green; font-weight: bold;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="register.php">
      <input type="text" name="nome" placeholder="Nome completo" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="tel" name="telefone" placeholder="Telefone" required>
      <input type="text" name="endereco" placeholder="Endereço completo" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit" class="register-btn">Cadastrar</button>
    </form>

    <p class="link">
      Já tem conta? <a href="index.php">Voltar ao Login</a>
    </p>
  </div>
</body>
</html>
