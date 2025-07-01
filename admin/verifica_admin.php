<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    
    header("Location: login.php");
    exit(); 
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 120)) {
    
    session_unset();
    session_destroy();
    
    header("Location: login.php?status=inativo");
    exit();
}

$_SESSION['last_activity'] = time();

?>