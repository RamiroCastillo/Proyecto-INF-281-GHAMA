<?php
session_start();

if (isset($_GET['logout']) || !isset($_SESSION['user'])) {
    session_destroy();
    unset($_SESSION['user']);
    unset($_SESSION['nombre']);
    unset($_SESSION['apellido']);
    unset($_SESSION['foto']);
    unset($_SESSION['confC']);
    unset($_SESSION['confConsec']);
    
    header("Location: ../../index.php");
    exit;
}
