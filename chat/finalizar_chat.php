<?php
include("conexion.php");

if (!isset($_POST['id_sesion'])) {
    http_response_code(400);
    echo "Faltan parámetros.";
    exit;
}

$id_sesion = intval($_POST['id_sesion']);

$sql = "UPDATE sesion SET estado = 'finalizada', fecha_fin = NOW() WHERE id_sesion = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en prepare(): " . $conn->error);
}

$stmt->bind_param("i", $id_sesion);

if ($stmt->execute()) {
    echo "ok";
} else {
    http_response_code(500);
    echo "Error al finalizar chat";
}

$stmt->close();
$conn->close();

?>
