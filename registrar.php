<?php
session_start(); 
require_once 'services/conexao.php';

if (isset($_POST['register_user'])) {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email_cadastro']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha_cadastro']);
    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hashed')";
    
    if (mysqli_query($conexao, $query)) {
        $mensagem_cadastro = "Cadastro realizado com sucesso! Faça o login.";
    } else {
        $mensagem_cadastro = "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $query = "SELECT id, nome, senha FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nome'];
            
            header("Location: index.php"); 
            exit();
        } else {
            $mensagem_login = "Email ou senha inválidos.";
        }
    } else {
        $mensagem_login = "Email ou senha inválidos.";
    }
}
?>
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
      <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="sobre.php">Sobre</a></li>
        <li><a href="produtos.php">Produtos</a></li>
        <li><a href="novidade.php">Novidades</a></li>
      </ul>
          <button class="hamburger-menu" aria-label="Abrir menu">
        <i class="fa-solid fa-bars"></i>
    </button>
    </nav>
    <main class="main-content">
        <div class="auth-header">
        <h2>Seja bem-vindo(a) à BookCulture!</h2>
        <p>Faça o login para continuar ou cadastre-se para começar sua jornada literária.</p>
    </div>
      <div class="auth-container">
        
        <div class="auth-form">
          <h2>Login</h2>
          <?php if(isset($mensagem_login)) { echo "<div class='message error'>$mensagem_login</div>"; } ?>
          <form action="registrar.php" method="POST">
            <label for="login-email">Email</label>
            <input type="email" id="login-email" name="email" required />
            <label for="login-password">Senha</label>
            <input type="password" id="login-password" name="senha" required />
            <button type="submit" name="login_user">Entrar</button>
          </form>
        </div>

        <div class="auth-form">
          <h2>Cadastro</h2>
          <?php if(isset($mensagem_cadastro)) { echo "<div class='message success'>$mensagem_cadastro</div>"; } ?>
          <form action="registrar.php" method="POST">
            <label for="register-name">Nome Completo</label>
            <input type="text" id="register-name" name="nome" required />
            <label for="register-email">Email</label>
            <input type="email" id="register-email" name="email_cadastro" required />
            <label for="register-password">Crie uma Senha</label>
            <input type="password" id="register-password" name="senha_cadastro" required />
            <button type="submit" name="register_user">Criar Conta</button>
          </form>
        </div>

      </div>
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
  </body>
</html>