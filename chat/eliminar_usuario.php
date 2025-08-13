<?php
session_start();  // Iniciar sesión para usar variables de sesión
include 'conexion.php';

$id = (int)$_GET['id']; // Mejor castear para evitar inyección

// Ejecutar eliminación
if (mysqli_query($conn, "DELETE FROM usuario WHERE id = $id")) {
    $_SESSION['mensaje'] = "Usuario eliminado correctamente.";
} else {
    $_SESSION['mensaje'] = "Error al eliminar el usuario.";
}

header("Location: http://localhost/colectivo/PROYECTO INTEGRADOR/chat/gestion_usuario.php");
exit;
?>
