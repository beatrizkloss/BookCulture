<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 

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