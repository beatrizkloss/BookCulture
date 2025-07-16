<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin - BookCulture</title>
    
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/media-queries.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
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
            <li><a href="../index.php">Home</a></li>
            <li><a href="../sobre.php">Sobre</a></li>
            <li><a href="../produtos.php">Produtos</a></li>
            <li><a href="../novidade.php">Novidades</a></li>
        </ul>
        <div class="nav-right">
            </div>
    </nav>

    <main class="main-content">
        <div class="auth-container">
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

    <script src="../js/script.js"></script>
</body>
</html>