<?php
session_start();
require_once 'conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos requeridos
    if (!isset($_POST['id_sesion'], $_POST['id_remitente'], $_POST['mensaje'])) {
        echo json_encode(['error' => 'Datos incompletos']);
        exit;
    }

    // Sanitizar entradas
    $id_sesion = intval($_POST['id_sesion']);
    $id_remitente = intval($_POST['id_remitente']);
    $mensaje = trim($_POST['mensaje']);

    // Validar mensaje no vacío
    if (empty($mensaje)) {
        echo json_encode(['error' => 'El mensaje no puede estar vacío']);
        exit;
    }

    try {
        $sql = "INSERT INTO mensaje (fk_id_sesion, fk_id_remitente, mensaje) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $id_sesion, $id_remitente, $mensaje);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Error al guardar el mensaje']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
    } finally {
        if (isset($stmt)) $stmt->close();
        $conn->close();
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>