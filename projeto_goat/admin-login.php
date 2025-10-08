<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login – Admin</title>
  <link rel="stylesheet" href="assets/css/logins.css">
</head>
<body>
  <div class="login-container">
    <h2>Login Administrativo</h2>
    <form id="adminLoginForm">
      <input type="text" id="adminUser" placeholder="Usuário" required>
      <input type="password" id="adminPassword" placeholder="Senha" required>
      <button type="button" onclick="window.location.href='pageAdm.php'">Entrar</button>

    </form>
    <p class="link"><a href="index.php">Voltar ao Login de Usuário</a></p>
  </div>
  <script src="assets/js/script.js"></script>
</body>
</html>
