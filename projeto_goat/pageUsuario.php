<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Goat Burguer - Página Inicial</title>
  <link rel="stylesheet" href="assets/css/pageUsuario.css?v=<?=time()?>">
</head>
<body>
<header class="barra-topo">
  <div class="idioma">
    <select aria-label="Idioma" id="seletorIdioma">
      <option value="pt" selected>PT</option>
      <option value="en">EN</option>
      <option value="es">ES</option>
    </select>
  </div>

  <div class="marca-topo">GOAT BURGUER</div>

  <div class="perfil-container">
    <div class="perfil" onclick="toggleMenuPerfil()">
      👤 <span id="nomeUsuario">
        <?php
          if(isset($_SESSION['usuario'])) {
            echo htmlspecialchars($_SESSION['usuario']);
          } else {
            echo 'Usuário';
          }
        ?>
      </span>
    </div>

    <div id="menuPerfil" class="menu-perfil" style="display:none">
      <button onclick="logout()">Sair</button>
    </div>
  </div>
</header>

<main>
  <div class="button-container">
    <button class="button" onclick="openModal('cardapioModal')">Cardápio</button>
    <button class="button fixed-button" onclick="openModal('reservaModal')">Reserva de Mesa</button>
    <button class="button" onclick="openModal('promocoesModal')">Promoções</button>
  </div>
  
  <section class="hero-section">
    <h2>Bem-vindo à Goat Burguer!</h2>
    <p>Experimente nossos hambúrgueres artesanais e combos irresistíveis 🍔🍟🥤</p>
  </section>
</main>

<div id="cardapioModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('cardapioModal')">&times;</span>
    <h2>Cardápio</h2>
    <p>🍔 Hambúrguer Goat - R$25<br>
       🍟 Batata Frita - R$10<br>
       🥤 Refrigerante - R$5<br>
       🍨 Sobremesa Especial - R$12</p>
  </div>
</div>

<div id="reservaModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('reservaModal')">&times;</span>
    <h2>Reserva de Mesa</h2>
    <p>Reserve sua mesa agora!</p>
    <a href="reservar.php" class="btn-reservar">Ir para Reserva</a>
  </div>
</div>

<div id="promocoesModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('promocoesModal')">&times;</span>
    <h2>Promoções</h2>
    <p>🔥 Combo do Dia: 1 Hambúrguer + Batata + Refrigerante por R$30<br>
       🎉 Happy Hour: 20% de desconto das 17h às 19h!</p>
  </div>
</div>

<script src="assets/js/script2.js"></script>
</body>
</html>
