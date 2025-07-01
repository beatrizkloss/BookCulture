<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>BookCulture</title>
    
    <link rel="stylesheet" href="../styles/style.css">
</head>
    <header class="site-header">
      <h1 class="logo">BookCulture</h1>
    </header>
        <nav class="main-nav">
            <button class="hamburger-menu" aria-label="Abrir menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <ul class="nav-menu">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../sobre.php">Sobre</a></li>
                <li><a href="../produtos.php">Produtos</a></li>
                <li><a href="../novidade.php">Novidades</a></li>
            </ul>

            <div class="nav-right">
                </div>
        </nav>
<body>
    <main class="main-content">
        <div class="auth-container" style="margin-top: 5rem;">
            <div class="auth-form">
              <h2>Acesso Administrativo</h2>
              
              <?php 
                if(isset($_GET['erro'])) { 
                  echo "<p style='color:red; text-align:center;'>Email, senha ou permissão inválidos.</p>"; 
                } 
              ?>

              <form action="verificar_sessao.php" method="POST">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" required />

                <label for="login-password">Senha</label>
                <input type="password" id="login-password" name="senha" required />
                
                <button type="submit">Entrar</button>
              </form>
            </div>
        </div>
    </main>
    <script src="js/script.js"></script>
</body>
</html>