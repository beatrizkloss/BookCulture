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
      <section class="about-section">
        <h2 class="section-title">Nossa História</h2>
        <p class="section-paragraph">
          Bem-vindo à BookCulture! Nascemos da paixão compartilhada pela leitura
          e do desejo de criar um espaço onde cada livro encontra seu leitor.
          Oferecemos uma curadoria especial de títulos, desde os grandes
          clássicos até as novidades mais aguardadas, para satisfazer todos os
          gostos e expandir horizontes.
        </p>

        <div class="mission-vision-values">
          <div class="mvv-card">
            <h3>Nossa Missão</h3>
            <p>
              Fomentar a cultura da leitura, conectando pessoas a novas ideias,
              histórias e conhecimentos através de uma experiência de compra
              online fácil, inspiradora e acessível a todos.
            </p>
          </div>
          <div class="mvv-card">
            <h3>Nossa Visão</h3>
            <p>
              Ser a livraria online de referência no Brasil, reconhecida pela
              excelência em nosso catálogo, pela inovação tecnológica e pela
              construção de uma comunidade forte de amantes de livros.
            </p>
          </div>
          <div class="mvv-card">
            <h3>Nossos Valores</h3>
            <ul>
              <li>
                <strong>Paixão por Livros:</strong> A base de tudo o que
                fazemos.
              </li>
              <li>
                <strong>Curiosidade:</strong> Incentivamos a descoberta e o
                aprendizado contínuo.
              </li>
              <li>
                <strong>Inclusão:</strong> Um catálogo diverso para um público
                diverso.
              </li>
              <li>
                <strong>Excelência:</strong> Compromisso com a qualidade em cada
                detalhe.
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section class="founders-section">
        <h2 class="section-title">Nossos Fundadores</h2>
        <div class="founders-grid">
          <div class="founder-card">
            <img
              src="img/woman.png"
              alt="Foto da fundadora Lívia Almeida"
              class="founder-image"
              text="User icons created by Freepik - Flaticon"
            />
            <h4 class="founder-name">Lívia Almeida</h4>
            <p class="founder-bio">
              Desde criança, Lívia encontrava refúgio e aventura nas páginas dos
              livros. Como co-fundadora da BookCulture, ela é a curadora-chefe,
              responsável por garimpar os títulos mais incríveis e garantir que
              a alma da livraria continue vibrante e apaixonada.
            </p>
          </div>
          <div class="founder-card">
            <img
              src="img/profile.png"
              alt="Foto do fundador Rafael Santos"
              class="founder-image"
              text="User icons created by Freepik - Flaticon"
            />
            <h4 class="founder-name">Rafael Santos</h4>
            <p class="founder-bio">
              Especialista em tecnologia e leitor voraz de ficção científica,
              Rafael é o arquiteto por trás da plataforma. Sua missão é tornar a
              experiência de encontrar e comprar livros online tão mágica e
              prazerosa quanto passar uma tarde em uma livraria aconchegante.
            </p>
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
