<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
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
      <section class="banner-section">
        <h2>Bem-vindo à BookCulture</h2>
        <p>
          Encontre os melhores livros para expandir seu conhecimento e
          imaginação.
        </p>
      </section>

      <section class="product-showcase">
        <h2 class="section-title">Destaques</h2>
        <div class="product-grid">
          <div class="product-card">
            <img
              src="img/produto 14.jpg"
              alt="Amanhecer na Colheita"
              class="product-image"
            />
            <div class="product-info">
              <h3 class="product-title">Amanhecer na Colheita</h3>
              <p class="product-price">R$ 50,00</p>
              <p class="product-description">
                A história do jovem Haymitch Abernathy e sua jornada como tributo
                durante o temido 50º Jogos Vorazes, o Segundo Massacre Quaternário.
              </p>
              <button class="buy-button">Comprar</button>
            </div>
          </div>

          <div class="product-card">
            <img
              src="img/produto 13.jpg"
              alt="Duna: livro 1"
              class="product-image"
            />
            <div class="product-info">
              <h3 class="product-title">Duna: livro 1</h3>
              <p class="product-price">R$ 69,00</p>
              <p class="product-description">
                O herdeiro de uma nobre família, Paul Atreides, precisa sobreviver à traição e dominar 
                um perigoso planeta desértico para controlar o destino do universo.
              </p>
              <button class="buy-button">Comprar</button>
            </div>
          </div>

          <div class="product-card">
            <img
              src="img/produto 8.jpg"
              alt="Os Sete Maridos de Evelyn Hugo"
              class="product-image"
            />
            <div class="product-info">
              <h3 class="product-title">Os Sete Maridos de Evelyn Hugo</h3>
              <p class="product-price">R$ 59,90</p>
              <p class="product-description">
              Uma icônica estrela de cinema revela 
              a uma jornalista os segredos de seus sete casamentos e o grande amor de sua vida.
              </p>
              <button class="buy-button">Comprar</button>
            </div>
          </div>
          <div class="product-card">
            <img
              src="img/produto 16.jpg"
              alt="Holly"
              class="product-image"
            />
            <div class="product-info">
              <h3 class="product-title">Holly</h3>
              <p class="product-price">R$ 70,90</p>
              <p class="product-description">
                Uma detetive particular aceita um caso de desaparecimento 
                que a leva a confrontar um mal inimaginável, escondido por trás de uma fachada comum.
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
