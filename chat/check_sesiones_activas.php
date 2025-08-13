<?php
session_start();
require_once("conexion.php");

header('Content-Type: application/json');

$sql = "SELECT s.id_sesion, u.nombre 
        FROM sesiones s 
        JOIN usuarios u ON s.fk_id_usuario = u.id_usuario 
        WHERE s.estado = 'Activo'";

$res = mysqli_query($conn, $sql);

$sesiones = [];
if ($res && mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    $sesiones[] = [
      'id_sesion' => $row['id_sesion'],
      'nombre' => $row['nombre']
    ];
  }
}

echo json_encode($sesiones);
?>
