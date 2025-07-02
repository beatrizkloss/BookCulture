document.addEventListener("DOMContentLoaded", () => {
  // --- LÓGICA DO MENU HAMBURGER E FORMULÁRIO DE LOGIN ---
  const hamburger = document.querySelector(".hamburger-menu");
  if (hamburger) {
    const navMenu = document.querySelector(".nav-menu");
    hamburger.addEventListener("click", () => {
      navMenu.classList.toggle("active");
    });
  }

  const loginForm = document.getElementById("login-form");
  if (loginForm) {
    const cadastroForm = document.getElementById("cadastro-form");
    const showRegisterLink = document.getElementById("show-register");
    const showLoginLink = document.getElementById("show-login");

    showRegisterLink.addEventListener("click", (e) => {
      e.preventDefault();
      loginForm.style.display = "none";
      cadastroForm.style.display = "block";
    });

    showLoginLink.addEventListener("click", (e) => {
      e.preventDefault();
      cadastroForm.style.display = "none";
      loginForm.style.display = "block";
    });
  }

  // --- LÓGICA DO FORMULÁRIO DE PAGAMENTO ---
  const creditCardForm = document.getElementById("creditCardForm");
  const paymentRadios = document.querySelectorAll(
    'input[name="paymentMethod"]'
  );

  if (creditCardForm && paymentRadios.length > 0) {
    const toggleCardForm = () => {
      const selectedCard = document.querySelector(
        'input[name="paymentMethod"]:checked'
      );
      if (
        selectedCard &&
        (selectedCard.value === "credito" || selectedCard.value === "debito")
      ) {
        creditCardForm.style.display = "block";
      } else {
        creditCardForm.style.display = "none";
      }
    };
    paymentRadios.forEach((radio) => {
      radio.addEventListener("change", toggleCardForm);
    });
    toggleCardForm();
  }
});

// --- FUNÇÃO DO CARRINHO  ---
function adicionarAoCarrinho(produtoId) {
  const mensagemDiv = document.getElementById("mensagem-carrinho");
  fetch(`carrinho_acoes.php?adicionar=${produtoId}`)
    .then((response) => response.text())
    .then((totalItens) => {
      const cartCount = document.getElementById("cart-count");
      if (cartCount) {
        cartCount.innerText = totalItens;
      }
      if (mensagemDiv) {
        mensagemDiv.innerText = "Produto adicionado com sucesso ao carrinho!";
        mensagemDiv.style.display = "block";
        setTimeout(() => {
          mensagemDiv.style.opacity = "1";
        }, 10);
        setTimeout(() => {
          mensagemDiv.style.opacity = "0";
          setTimeout(() => {
            mensagemDiv.style.display = "none";
          }, 500);
        }, 3000);
      }
    })
    .catch((error) => console.error("Erro:", error));
}
