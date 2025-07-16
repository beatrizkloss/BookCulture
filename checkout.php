<?php
session_start();
// Verifica se o carrinho está vazio ou se o usuário não está logado
if (empty($_SESSION['carrinho']) || !isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once 'services/conexao.php';
// Verifica se a etapa de pagamento foi enviada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'processar_pagamento') {
    $_SESSION['payment_info'] = ['method' => $_POST['paymentMethod'] ?? 'N/A'];
    if ($_POST['paymentMethod'] === 'credito' || $_POST['paymentMethod'] === 'debito') {
        $_SESSION['payment_info']['card_number'] = substr($_POST['card-number'], -4);
        $_SESSION['payment_info']['installments'] = $_POST['installments'];
    }
    header("Location: checkout.php?etapa=resumo");
    exit();
}

$etapa = $_GET['etapa'] ?? 'pagamento';

if ($etapa === 'agradecimento') {
    $_SESSION['carrinho'] = [];
    unset($_SESSION['payment_info']);
}

$cart_count = isset($_SESSION['carrinho']) ? array_sum($_SESSION['carrinho']) : 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout - BookCulture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
<body>
    <header class="site-header"><h1 class="logo">BookCulture</h1></header>
       <nav class="main-nav">
        <button class="hamburger-menu" aria-label="Abrir menu"><i class="fa-solid fa-bars"></i></button>
        <ul class="nav-menu">
            <li><a href="carrinho.php">Voltar</a></li>
        </ul>
        <div class="nav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-info"><p>Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p><a href="logout.php" class="logout-button">Sair</a></div>
            <?php else: ?>
                <div class="dropdown-login">
                    <span class="dropdown-toggle"><i class="fa-solid fa-user-circle"></i> Login</span>
                    <div class="dropdown-menu"><a href="registrar.php">📖 Cliente</a><a href="admin/login.php">📚 Administrador</a></div>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main-content">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- pagamento -->
                    <?php if ($etapa === 'pagamento'): ?>
                        <div class="card shadow-sm">
                            <div class="card-header bg-dark text-white"><h3>Forma de Pagamento</h3></div>
                            <div class="card-body">
                                <form action="checkout.php" method="POST">
                                    <input type="hidden" name="action" value="processar_pagamento">
                                    <p class="mb-3">Escolha como pagar:</p>
                                    <div class="form-check mb-2"><input class="form-check-input" type="radio" name="paymentMethod" id="debitoRadio" value="debito" checked><label class="form-check-label" for="debitoRadio"><i class="fa-regular fa-credit-card"></i> Cartão de Débito</label></div>
                                    <div class="form-check mb-3"><input class="form-check-input" type="radio" name="paymentMethod" id="creditoRadio" value="credito"><label class="form-check-label" for="creditoRadio"><i class="fa-solid fa-credit-card"></i> Cartão de Crédito</label></div>
                                    <div id="creditCardForm">
                                        <hr>
                                        <h5 class="mb-3">Dados do Cartão</h5>
                                        <div class="mb-3"><label for="card-number" class="form-label">Número do Cartão</label><input type="text" name="card-number" id="card-number" class="form-control" placeholder="0000 0000 0000 0000" inputmode="numeric" pattern="[0-9\s]{13,19}" maxlength="19" required></div>
                                        <div class="mb-3"><label for="card-name" class="form-label">Nome no Cartão</label><input type="text" name="card-name" id="card-name" class="form-control" placeholder="Como está no cartão" required></div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3"><label for="card-expiry" class="form-label">Validade (MM/AA)</label><input type="text" name="card-expiry" id="card-expiry" class="form-control" placeholder="MM/AA" inputmode="numeric" pattern="\d{2}/\d{2}" maxlength="5" required></div>
                                            <div class="col-md-6 mb-3"><label for="card-cvv" class="form-label">CVV</label><input type="text" name="card-cvv" id="card-cvv" class="form-control" placeholder="123" inputmode="numeric" pattern="[0-9]{3,4}" maxlength="4" required></div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4"><button type="submit" class="buy-button w-100" style="border:none; font-size: 1.2rem;">Revisar Pedido</button></div>
                                </form>
                            </div>
                        </div>

                    <?php elseif ($etapa === 'resumo'): 
                            $produtos_carrinho = []; $total_compra = 0; $produto_ids = array_keys($_SESSION['carrinho']);
                            $ids_string = implode(',', $produto_ids);
                            if (!empty($ids_string)) {
                                $sql = "SELECT * FROM produtos WHERE id IN ($ids_string)";
                                $resultado = $conexao->query($sql);
                                if ($resultado && $resultado->num_rows > 0) {
                                    while ($produto = $resultado->fetch_assoc()) {
                                        $produto_id = $produto['id']; $quantidade = $_SESSION['carrinho'][$produto_id];
                                        $subtotal = $quantidade * $produto['preco']; $total_compra += $subtotal;
                                        $produtos_carrinho[] = ['nome' => $produto['nome'], 'quantidade' => $quantidade, 'subtotal' => $subtotal];
                                    }
                                }
                            }
                            $payment_info = $_SESSION['payment_info'];
                        ?>
                <!-- Resumo do Pedido -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-dark text-white"><h3>Resumo do Pedido</h3></div>
                            <div class="card-body">
                                <h5 class="card-title">Itens:</h5>
                                <ul class="list-group list-group-flush mb-3">
                                    <?php foreach($produtos_carrinho as $item): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center"><?= $item['quantidade']; ?>x <?= htmlspecialchars($item['nome']); ?><span>R$ <?= number_format($item['subtotal'], 2, ',', '.'); ?></span></li>
                                    <?php endforeach; ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold fs-5">TOTAL<span>R$ <?= number_format($total_compra, 2, ',', '.'); ?></span></li>
                                </ul>
                                <h5 class="card-title mt-4">Forma de Pagamento:</h5>
                                <div class="alert alert-secondary">
                                    <p class="mb-1"><strong>Cartão de <?= ucfirst($payment_info['method']); ?> final <?= htmlspecialchars($payment_info['card_number']); ?></strong></p>
                                </div>
                                <div class="text-center mt-4"><a href="checkout.php?etapa=agradecimento" class="buy-button" style="text-decoration:none;">Confirmar e Pagar</a></div>
                            </div>
                        </div>
                <!-- fim do processo de pagamento -->
                    <?php elseif ($etapa === 'agradecimento'): ?>
                        <div class="text-center py-5"><h2 class="section-title">Obrigado!</h2><p class="lead">Sua compra foi finalizada com sucesso.</p><a href="produtos.php" class="btn btn-primary mt-4">Continuar Comprando</a></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>