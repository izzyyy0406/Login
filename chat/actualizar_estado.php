<?php
// Habilitar reporte de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';

    if ($id_usuario <= 0 || ($accion !== 'suspender' && $accion !== 'activar')) {
        http_response_code(400);
        echo "Solicitud inválida";
        exit;
    }

    $nuevo_estado = ($accion === 'suspender') ? 0 : 1;

    $stmt = $conn->prepare("UPDATE usuario SET fk_id_estado = ? WHERE id = ?");
    if (!$stmt) {
        http_response_code(500);
        echo "Error de preparación: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ii", $nuevo_estado, $id_usuario);

    if ($stmt->execute()) {
        echo "Estado actualizado correctamente";
    } else {
        http_response_code(500);
        echo "Error al actualizar estado: " . $stmt->error;
    }

    $stmt->close();
} else {
    http_response_code(405); // Método no permitido
    echo "Método no permitido";
}
?>
