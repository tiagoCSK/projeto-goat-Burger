document.addEventListener("DOMContentLoaded", () => {
  const userForm     = document.getElementById("userLoginForm");
  const registerForm = document.getElementById("userRegisterForm");
  const adminForm    = document.getElementById("adminLoginForm");

  if (userForm) {
    userForm.addEventListener("submit", (e) => {
      e.preventDefault();
      alert("Login de usuário enviado!");
    });
  }

  if (registerForm) {
    registerForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const name    = document.getElementById("newName").value;
      const email   = document.getElementById("newEmail").value;
      const phone   = document.getElementById("newPhone").value;
      const address = document.getElementById("newAddress").value;
      alert(`Cadastro enviado!\nNome: ${name}\nEmail: ${email}\nTelefone: ${phone}\nEndereço: ${address}`);
     
    });
  }

  if (adminForm) {
    adminForm.addEventListener("submit", (e) => {
      e.preventDefault();
      alert("Login administrativo enviado!");
    });
  }
});
