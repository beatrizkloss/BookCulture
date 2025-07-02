<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: registrar.php");
    exit(); 
}

require_once 'services/conexao.php';

$carrinho_vazio = true;
$produtos_carrinho = [];
$total_compra = 0;

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $carrinho_vazio = false;
    
    $produto_ids = array_keys($_SESSION['carrinho']);
    $ids_string = implode(',', $produto_ids);
    if (!empty($ids_string)) {
        $sql = "SELECT * FROM produtos WHERE id IN ($ids_string)";
        $resultado = $conexao->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            while ($produto = $resultado->fetch_assoc()) {
                $produto_id = $produto['id'];
                $quantidade = $_SESSION['carrinho'][$produto_id];
                $subtotal = $quantidade * $produto['preco'];
                $total_compra += $subtotal;
                
                $produtos_carrinho[] = [
                    'id' => $produto_id,
                    'nome' => $produto['nome'],
                    'preco' => $produto['preco'],
                    'imagem' => $produto['imagem'],
                    'quantidade' => $quantidade,
                    'subtotal' => $subtotal
                ];
            }
        }
    } else {
        $carrinho_vazio = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Meu Carrinho - BookCulture</title>
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/media-queries.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
<body>
    <header class="site-header">
      <h1 class="logo">BookCulture</h1>
    </header>
    <nav class="main-nav">
        <button class="hamburger-menu" aria-label="Abrir menu"><i class="fa-solid fa-bars"></i></button>
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
                    <span class="dropdown-toggle"><i class="fa-solid fa-user-circle"></i> Login</span>
                    <div class="dropdown-menu">
                        <a href="registrar.php">📖 Cliente</a>
                        <a href="admin/login.php">📚 Administrador</a>
                    </div>
                </div>
            <?php endif; ?>
            
        </div>
    </nav>
    
    <main class="main-content">
        <h2 class="section-title">Meu Carrinho de Compras</h2>

        <?php if ($carrinho_vazio): ?>
            <p style="text-align: center;">Seu carrinho está vazio. <a href="produtos.php">Continue comprando!</a></p>
        <?php else: ?>
            <div style="overflow-x: auto; padding: 0 5%;">
                <table style="width:100%; border-collapse: collapse; text-align: center;">
                    <thead style="background-color: #f2f2f2;">
                        <tr style="border-bottom: 2px solid #ddd;"><th colspan="2" style="text-align:left; padding:10px;">Produto</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th><th></th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos_carrinho as $item): ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;"><img src="img/<?php echo htmlspecialchars($item['imagem']); ?>" width="60"></td>
                            <td style="text-align: left;"><?php echo htmlspecialchars($item['nome']); ?></td>
                            <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                            <td><?php echo $item['quantidade']; ?></td>
                            <td>R$ <?php echo number_format($item['subtotal'], 2, ',', '.'); ?></td>
                            <td><a href="carrinho_acoes.php?remover=<?php echo $item['id']; ?>" style="color:red; text-decoration:none; font-size: 1.2rem;">&times;</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style="font-weight: bold; font-size: 1.2rem;"><td colspan="4" style="text-align: right; padding: 15px;">Total:</td><td colspan="2" style="text-align: left;">R$ <?php echo number_format($total_compra, 2, ',', '.'); ?></td></tr>
                    </tfoot>
                </table>
            </div>
            <div style="text-align: right; margin-top: 20px; padding: 0 5%;">
                <a href="carrinho_acoes.php?limpar=1" style="text-decoration:none; padding: 10px 15px; border-radius:5px; background-color: #6c757d; color:white; font-size: 0.9rem;">Limpar Carrinho</a>
                <a href="checkout.php" class="buy-button" style="text-decoration:none;">Finalizar Compra</a>
            </div>
        <?php endif; ?>
    </main>

    <footer class="site-footer">
      <div class="footer-content">
        <div class="footer-column">
          <h4 class="footer-title">BookCulture</h4>
          <p>Sua livraria online, onde cada página é uma nova aventura. Feita por e para amantes de livros.</p>
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
            <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
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