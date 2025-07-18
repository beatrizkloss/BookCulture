<?php
session_start();
require_once 'services/conexao.php';

// LÓGICA DE CADASTRO 
if (isset($_POST['register_user'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email_cadastro'];
    $senha = $_POST['senha_cadastro'];
    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha_hashed);
    
    if ($stmt->execute()) {
        $mensagem_cadastro = "Cadastro realizado com sucesso! Faça o login.";
    } else {
        $mensagem_cadastro = "Erro: Este email já está em uso.";
    }
}

// LÓGICA DE LOGIN 
if (isset($_POST['login_user'])) {
    $email = $_POST['email'];
    $senha_digitada = $_POST['senha'];

    $stmt = $conexao->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($senha_digitada, $usuario['senha'])) {
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

<!-- LOGIN E CADASTRO -->
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
        </div>
</nav>
<main class="main-content">

    <div class="auth-header">
        <h2>Seja bem-vindo(a) à BookCulture!</h2>
        <p>Faça o login para continuar ou cadastre-se para começar sua jornada literária.</p>
    </div>

    <div class="auth-container">
        <!-- Formulário de Login -->  
        <div class="auth-toggle">
        <div class="auth-form" id="login-form">
          <h2>Login</h2>
          <?php if(isset($mensagem_login)) { echo "<div class='message error'>$mensagem_login</div>"; } ?>
          <form action="registrar.php" method="POST">
            <label for="login-email">Email</label>
            <input type="email" id="login-email" name="email" required />
            <label for="login-password">Senha</label>
            <input type="password" id="login-password" name="senha" required />
            <button type="submit" name="login_user">Entrar</button>
            <p class="form-toggle">Não tem uma conta? <a href="#" id="show-register">Cadastre-se</a></p>
          </form>
        </div>
        <!-- Formulário de Cadastro -->
        <div class="auth-form" id="cadastro-form" style="display: none;">
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
            <p class="form-toggle">Já tem uma conta? <a href="#" id="show-login">Faça login</a></p>
          </form>
        </div>

    </div>
</main>
    <script src="js/script.js"></script>
  </body>
</html>