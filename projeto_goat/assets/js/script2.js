function toggleMenuPerfil() {
  const menu = document.getElementById('menuPerfil');
  menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

window.addEventListener('click', (e) => {
  const menu = document.getElementById('menuPerfil');
  const perfil = document.querySelector('.perfil');
  if (!perfil.contains(e.target)) {
    menu.style.display = 'none';
  }
});

function logout() {
  alert('Você saiu do perfil.');
  window.location.href = 'index.php';
}

function openModal(modalId) {
  document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

window.onclick = function(event) {
  const modais = document.querySelectorAll('.modal');
  modais.forEach(modal => {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });
};

