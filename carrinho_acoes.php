<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_GET['adicionar'])) {
    $produto_id = $_GET['adicionar'];
    
    if (isset($_SESSION['carrinho'][$produto_id])) {
        $_SESSION['carrinho'][$produto_id]++;
    } else {
        $_SESSION['carrinho'][$produto_id] = 1;
    }
    echo array_sum($_SESSION['carrinho']);
    exit(); 
}

if (isset($_GET['remover'])) {
    $produto_id = $_GET['remover'];
    if (isset($_SESSION['carrinho'][$produto_id])) {
        unset($_SESSION['carrinho'][$produto_id]);
    }
    header("Location: carrinho.php?status=removido");
    exit();
}

if (isset($_GET['limpar'])) {
    $_SESSION['carrinho'] = [];
    header("Location: carrinho.php?status=limpo");
    exit();
}
?>