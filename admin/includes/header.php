<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Admin - BookCulture</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/style.css">
  <link rel="stylesheet" href="styles/admin.css">

</head>
<body>
<header class="site-header">
        <h1 class="logo">BookCulture - Admin</h1>
    </header>

    <nav class="main-nav">
        <ul class="nav-menu">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="usuarios.php">Usuários</a></li>
        <li><a href="produtos.php">Produtos</a></li>
        <li><a href="novidades.php">Novidades</a></li>
      </ul>
        <div class="nav-right">
             <div class="user-info">
                <p>Olá, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</p>
                <a href="logout_admin.php" class="logout-button">Sair</a>
            </div>
        </div>
    </nav>
<div class="container">