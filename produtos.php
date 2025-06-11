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
      <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="sobre.php">Sobre</a></li>
        <li><a href="produtos.php">Produtos</a></li>
        <li><a href="novidade.php">Novidades</a></li>
      </ul>

      <div class="nav-actions">

    <div class="register-link"> <?php if (isset($_SESSION['user_id'])): ?>
            
            <p>Olá, Seja Bem-Vindo(a) <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
            <a href="logout.php">Sair</a>

        <?php else: ?>

            <a href="registrar.php">Login</a>
            <p>ou</p>
            <a href="registrar.php">Cadastrar-se</a>

        <?php endif; ?>
        
    </div> <a href="carrinho.php" class="cart-button">
        <i class="fa-solid fa-cart-shopping"></i>
        <span id="cart-count">0</span>
    </a>
    
</div>
    <button class="hamburger-menu" aria-label="Abrir menu">
        <i class="fa-solid fa-bars"></i>
    </button>
    </nav>
    <main class="main-content">
      <section class="product-showcase">
        <h2 class="section-title">Nossos Produtos</h2>
    <p class="section-intro">
          Explore nosso universo de histórias. Aqui na BookCulture,
          cada livro foi selecionado para inspirar, entreter e transformar.
          Mergulhe em nosso catálogo completo e encontre a leitura perfeita para o seu momento.
    </p>
        <div class="product-grid">
          <div class="product-card">
            <img
              src="img/produto 1.jpg"
              alt="Daisy Jones and The Six"
              class="product-image"
            />
            <div class="product-info">
              <h3 class="product-title">Daisy Jones and The Six</h3>
              <p class="product-price">R$ 40,00</p>
              <p class="product-description">
                Narrado como um documentário, o livro revela os bastidores 
                da ascensão meteórica e
                da separação misteriosa da maior banda de rock dos anos 70.
              </p>
              <button class="buy-button">Comprar</button>
            </div>
          </div>

          <div class="product-card">
            <img
              src="img/produto 2.jpg"
              alt="Pessoas normais"
              class="product-image"
            />
            <div class="product-info">
              <h3 class="product-title">Pessoas normais</h3>
              <p class="product-price">R$ 39,90</p>
              <p class="product-description">
              Dois jovens da mesma cidade, mas de mundos diferentes, 
              iniciam uma conexão complexa e magnética que
              irá definir suas vidas nos anos seguintes.
              </p>
              <button class="buy-button">Comprar</button>
            </div>
          </div>

          <div class="product-card">
            <img
              src="img/produto 3.jpeg"
              alt="O homem de giz"
              class="product-image"
            />
            <div class="product-info">
              <h3 class="product-title">O homem de giz</h3>
              <p class="product-price">R$ 34,00</p>
              <p class="product-description">
              Décadas após um jogo infantil terminar em tragédia, 
              os segredos de um verão retornam para assombrar um grupo de amigos.
              </p>
              <button class="buy-button">Comprar</button>
            </div>
          </div>
                    <div class="product-card">
            <img
              src="img/produto 4.jpeg"
              alt="O Meu Pé de Laranja Lima"
              class="product-image"
            />
            <div class="product-info">
              <h3 class="product-title">O Meu Pé de Laranja Lima</h3>
              <p class="product-price">R$ 35,00</p>
              <p class="product-description">
                A história de Zezé, um menino de seis anos que encontra consolo e amizade em um pé de laranja lima, 
                enquanto enfrenta a dura realidade de sua vida familiar.
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
          <h4 class="footer-title">Siga-nos</h4>
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
