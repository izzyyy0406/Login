<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Medico') {
    echo json_encode([
        'nuevos' => false,
        'pacientes' => []
    ]);
    exit;
}

include 'conexion.php'; // asegúrate de tener conexión

$sql = "SELECT s.id_sesion, u.nick AS paciente 
        FROM sesiones s 
        JOIN usuarios u ON s.id_usuario = u.id_usuario 
        WHERE s.estado = 'pendiente'"; // Ajusta estado si es otro

$result = $conn->query($sql);

$pacientes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pacientes[] = [
            'id_sesion' => $row['id_sesion'],
            'paciente' => $row['paciente']
        ];
    }
}

echo json_encode([
    'nuevos' => count($pacientes) > 0,
    'pacientes' => $pacientes
]);
?>
