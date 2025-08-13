<?php
include('conexion.php');

if (isset($_POST['id_sesion'])) {
  $id_sesion = $_POST['id_sesion'];

  // Actualizar estado a 'finalizada' (ajusta según tu tabla y columnas)
  $sql = "UPDATE sesion SET estado = 'finalizada' WHERE id_sesion = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id_sesion);

  if ($stmt->execute()) {
    echo "Sesión finalizada";
  } else {
    http_response_code(500);
    echo "Error al finalizar la sesión";
  }

  $stmt->close();
  $conn->close();
} else {
  http_response_code(400);
  echo "No se recibió el ID de la sesión";
}
?>
