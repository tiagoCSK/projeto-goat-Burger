<?php
session_start();
require_once "src/Conexao.php"; 

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  $conexao = new Conexao();
  $mysqli = $conexao->getMysqli();

  $sql = "SELECT * FROM Usuario WHERE email = '$email' AND senha = '$senha'";
  $resultado = $mysqli->query($sql);

  if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    $_SESSION["usuario"] = $usuario["nome"];
    header("Location: pageUsuario.php");
    exit;
  } else {
    $mensagem = "❌ E-mail ou senha incorretos.";
  }

  $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login – Usuário</title>
  <link rel="stylesheet" href="assets/css/logins.css">
</head>
<body>
  <div class="login-container">
    <h2>Login do Usuário</h2>

    <?php if (!empty($mensagem)): ?>
      <p style="color:red; font-weight:bold;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php">
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>

    <p class="link">
      <a href="register.php">Fazer cadastro</a>
    </p>
    <p class="link">
      <a href="admin-login.php">Área Administrativa</a>
    </p>
  </div>
</body>
</html>