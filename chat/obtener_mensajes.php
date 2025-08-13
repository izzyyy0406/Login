<?php
session_start();
header('Content-Type: application/json');

if (!isset($_GET['id_sesion'])) {
    echo json_encode(['error' => 'No se especificó la sesión']);
    exit();
}

$id_sesion = intval($_GET['id_sesion']);

require_once 'conexion.php';

$sql = "SELECT m.id_mensaje, m.mensaje, m.fecha_registro, CONCAT(u.nombres, ' ', u.apellidos) AS nombre, u.fk_id_rol, m.fk_id_remitente
        FROM mensaje m
        JOIN usuario u ON m.fk_id_remitente = u.id
        WHERE m.fk_id_sesion = ?
        ORDER BY m.fecha_registro ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_sesion);
$stmt->execute();
$result = $stmt->get_result();

$mensajes = [];
while ($row = $result->fetch_assoc()) {
    $mensajes[] = $row;
}

echo json_encode($mensajes);
exit(); // ¡Importante detener ejecución aquí!
