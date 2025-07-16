<?php 
session_start();
require_once 'services/conexao.php';
$cart_count = isset($_SESSION['carrinho']) ? array_sum($_SESSION['carrinho']) : 0;
$resultado_produtos = $conexao->query("SELECT * FROM produtos ORDER BY nome ASC");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nossos Produtos - BookCulture</title>
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/media-queries.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
<body>
    <header class="site-header">
      <h1 class="logo">BookCulture</h1>
    </header>
    <!-- Barra de Navegação -->
    <nav class="main-nav">
        <button class="hamburger-menu" aria-label="Abrir menu"><i class="fa-solid fa-bars"></i></button>
        <ul class="nav-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="sobre.php">Sobre</a></li>
            <li><a href="produtos.php">Produtos</a></li>
            <li><a href="novidade.php">Novidades</a></li>
        </ul>
        <!-- Botão de Login usuário e admin / Carrinho -->
        <div class="nav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-info">
                    <p>Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
                    <a href="logout.php" class="logout-button">Sair</a>
                </div>
            <?php else: ?>
                <div class="dropdown-login">
                    <span class="dropdown-toggle"><i class="fa-solid fa-user-circle"></i> Login</span>
                    <div class="dropdown-menu">
                        <a href="registrar.php">📖 Cliente</a>
                        <a href="admin/login.php">📚 Administrador</a>
                    </div>
                </div>
            <?php endif; ?>
                    <a href="carrinho.php" class="cart-button">
            <i class="fa-solid fa-cart-shopping"></i>
            <span id="cart-count"><?php echo $cart_count; ?></span>
        </a>
        </div> 
    </nav>
    <main class="main-content">
      <div id="mensagem-carrinho" class="mensagem-sucesso"></div>
      <!-- Seção de produtos -->
      <section class="product-showcase">
        <h2 class="section-title">Nossos Produtos</h2>
        <p class="section-intro">Explore nosso universo de histórias. Mergulhe em nosso catálogo completo e encontre a leitura perfeita.</p>
        <div class="product-grid">
            
            <?php while($produto = $resultado_produtos->fetch_assoc()): ?>
              <div class="product-card">
                <img src="img/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" class="product-image"/>
                <div class="product-info">
                  <h3 class="product-title"><?php echo htmlspecialchars($produto['nome']); ?></h3>
                  <p class="product-price">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                  <p class="product-description"><?php echo htmlspecialchars($produto['descricao']); ?></p>
                  <button class="buy-button" onclick="adicionarAoCarrinho(<?php echo $produto['id']; ?>)">
                      Comprar
                  </button>
                </div>
              </div>
            <?php endwhile; ?>
            </div>
      </section>
    </main>
     <!-- footer -->
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