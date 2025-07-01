<?php
session_start();
require_once '../services/conexao.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ? AND is_admin = 1";
    $stmt = $conexao->prepare($sql);

    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['admin_id'] = $usuario['id'];
            $_SESSION['admin_name'] = $usuario['nome'];
            header("Location: dashboard.php");
            exit(); 
            
        }
    }
    header("Location: login.php?erro=1");
    exit();
    
} else {
    header("Location: login.php");
    exit();
}
?>