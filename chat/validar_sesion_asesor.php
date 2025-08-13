<?php
session_start();


if (!isset($_SESSION['nick']) || !isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['rol'] !== "Medico") {
    echo "No autorizado";
    exit();
}

// Si llega aquí, la sesión es válida y el rol es correcto
// No imprimas JSON, sigue cargando la página normalmente

// Puedes hacer algo como:
$nick = $_SESSION['nick'];
$rol = $_SESSION['rol'];

// Luego carga el HTML o el contenido de la página
?>
