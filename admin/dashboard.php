<?php
require_once 'verifica_admin.php';
require_once '../services/conexao.php';
$total_produtos = $conexao->query("SELECT COUNT(*) as total FROM produtos")->fetch_assoc()['total'];
$total_clientes = $conexao->query("SELECT COUNT(*) as total FROM usuarios WHERE is_admin = 0")->fetch_assoc()['total'];
$total_admins = $conexao->query("SELECT COUNT(*) as total FROM usuarios WHERE is_admin = 1")->fetch_assoc()['total'];

require_once 'includes/header.php';
?>

<div class="p-5 mb-4 rounded-3 shadow-sm dashboard-banner">
    <div class="container-fluid py-5 text-white banner-overlay">
        <h1 class="display-5 fw-bold">Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</h1>
        <p class="col-md-8 fs-4">Este é o seu centro de controle para a BookCulture. Use o o menu de navegação para começar a gerenciar o site.</p>
    </div>
</div>

<div class="row align-items-md-stretch">
    <div class="col-md-4 mb-4">
        <div class="stat-card bg-produtos">
            <h2>Produtos</h2>
            <p>Total de livros cadastrados.</p>
            <h1 class="display-4"><?php echo $total_produtos; ?></h1>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="stat-card bg-clientes">
            <h2>Clientes</h2>
            <p>Total de usuários clientes.</p>
            <h1 class="display-4"><?php echo $total_clientes; ?></h1>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="stat-card bg-admins">
            <h2>Admins</h2>
            <p>Total de usuários administradores.</p>
            <h1 class="display-4"><?php echo $total_admins; ?></h1>
        </div>
    </div>
</div>


<?php 
require_once 'includes/footer.php'; 
?>