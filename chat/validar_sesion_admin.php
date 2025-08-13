<?php
session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION['nick']) || !isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit();
}

// Verificar que el rol sea "admin" (ignorando mayúsculas/minúsculas)
if (strtolower($_SESSION['rol']) !== "admin") {
    header("Location: acceso_denegado.php");
    exit();
}
?>
