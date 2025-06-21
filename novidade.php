<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BookCulture</title>
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/media-queries.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
  </head>
  <body>
    <header class="site-header">
      <h1 class="logo">BookCulture</h1>
    </header>

<nav class="main-nav">

    <button class="hamburger-menu" aria-label="Abrir menu">
        <i class="fa-solid fa-bars"></i>
    </button>

    <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="sobre.php">Sobre</a></li>
        <li><a href="produtos.php">Produtos</a></li>
        <li><a href="novidade.php">Novidades</a></li>
    </ul>

    <div class="nav-right">
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="user-info">
                <p>Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
                <a href="logout.php" class="logout-button">Sair</a>
            </div>
        <?php else: ?>
            <div class="dropdown-login">
                <span class="dropdown-toggle">
                    <i class="fa-solid fa-user-circle"></i> Login
                </span>
                <div class="dropdown-menu">
                    <a href="registrar.php">📖 Cliente</a>
                    <a href="#">📚 Administrador</a>
                </div>
            </div>
        <?php endif; ?>

        <a href="carrinho.php" class="cart-button">
            <i class="fa-solid fa-cart-shopping"></i>
            <span id="cart-count">0</span>
        </a>

    </div>
  </nav>

<main class="main-content">
    <h2 class="section-title">Novidades</h2>
    
    <p class="section-intro">
        Fique por dentro dos lançamentos mais recentes e das obras que acabaram de chegar ao nosso acervo. Estas são as novas vozes e histórias esperando por você!
    </p>

    <section class="product-showcase">
        <div class="product-grid">

            <div class="product-card">
                <img src="img/produto12.jpg" alt="O Eternauta (Edição definitiva)" class="product-image" />
                <div class="product-info">
                    <h3 class="product-title">O Eternauta (Edição definitiva)</h3>
                    <p class="product-price">R$ 210,90</p>
                    <p class="product-description">
                        Após uma nevasca mortal aniquilar Buenos Aires, um homem comum lidera a desesperada resistência humana contra uma invasão alienígena.
                    </p>
                    <button class="buy-button">Comprar</button>
                </div>
            </div>

            <div class="product-card">
                <img src="img/produto 10.jpg" alt="A contagem dos sonhos" class="product-image" />
                <div class="product-info">
                    <h3 class="product-title">A contagem dos sonhos</h3>
                    <p class="product-price">R$ 66,90</p>
                    <p class="product-description">
                        Durante o isolamento da pandemia, uma mulher reflete sobre seus relacionamentos passados, suas escolhas e arrependimentos.
                    </p>
                    <button class="buy-button">Comprar</button>
                </div>
            </div>

            <div class="product-card">
                <img src="img/produto 5.jpeg" alt="ASMA" class="product-image" />
                <div class="product-info">
                    <h3 class="product-title">ASMA</h3>
                    <p class="product-price">R$ 55,30</p>
                    <p class="product-description">
                        Uma entidade que atravessa corpos e gerações é constantemente perseguida pela opressão de uma narrativa histórica dominadora.
                    </p>
                    <button class="buy-button">Comprar</button>
                </div>
            </div>

            <div class="product-card">
                <img src="img/produto 9.jpeg" alt="De onde eles vêm" class="product-image" />
                <div class="product-info">
                    <h3 class="product-title">De onde eles vêm</h3>
                    <p class="product-price">R$ 47,77</p>
                    <p class="product-description">
                        Em meio à hostilidade de ser um dos primeiros cotistas raciais, um jovem órfão luta para conciliar a realidade com seu amor pela literatura.
                    </p>
                    <button class="buy-button">Comprar</button>
                </div>
            </div>

        </div>
    </section>
</main>
    <footer class="site-footer">
      <div class="footer-content">
        <div class="footer-column">
          <h4 class="footer-title">BookCulture</h4>
          <p>
            Sua livraria online, onde cada página é uma nova aventura. Feita por
            e para amantes de livros.
          </p>
        </div>

        <div class="footer-column">
          <h4 class="footer-title">Links Rápidos</h4>
          <ul class="footer-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="produtos.php">Todos os Produtos</a></li>
            <li><a href="novidade.php">Novidades</a></li>
            <li><a href="sobre.php">Sobre Nós</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h4 class="footer-title">Contato</h4>
          <p>Precisa de ajuda? Nos envie um e-mail!</p>
          <p><strong>Email:</strong> contato@bookculture.com.br</p>
        </div>

        <div class="footer-column">
          <div class="social-links">
            <a href="#" aria-label="Instagram"
              ><i class="fa-brands fa-instagram"></i
            ></a>
            <a href="#" aria-label="Facebook"
              ><i class="fa-brands fa-facebook"></i
            ></a>
            <a href="#" aria-label="Twitter"
              ><i class="fa-brands fa-x-twitter"></i
            ></a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>© 2025 BookCulture. Todos os direitos reservados.</p>
      </div>
    </footer>
    <script src="js/script.js"></script>
  </body>
</html>
