<?php
require_once "conexion.php";
session_start();

$id_sesion = $_POST['id_sesion'];
$mensaje = $_POST['mensaje'];
$id_remitente = $_SESSION['id']; // Asegúrate de guardar esto correctamente en login
$tipo_mensaje = 'texto';

$query = "
  INSERT INTO mensaje (fk_id_sesion, fk_id_remitente, mensaje, tipo_mensaje)
  VALUES (?, ?, ?, ?)
";

$stmt = $conn->prepare($query);
$stmt->bind_param("iiss", $id_sesion, $id_remitente, $mensaje, $tipo_mensaje);
$stmt->execute();

echo "OK"; 

// Verificar estado de la sesión
$estado = $conn->prepare("SELECT estado FROM sesion WHERE id_sesion = ?");
$estado->bind_param("i", $id_sesion);
$estado->execute();
$res = $estado->get_result();
$fila = $res->fetch_assoc();

if ($fila && $fila['estado'] === 'finalizado') {
  echo "Chat finalizado. No se puede enviar mensaje.";
  exit;
}

?>
