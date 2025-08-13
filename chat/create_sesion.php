<?php
  include('conexion.php');

  // Parámetro para el procedimiento almacenado
  $fk_id_paciente = $_GET['paciente'];

  
  // Llamar al procedimiento almacenado
  $sql = "CALL sp_insertar_sesion('$fk_id_paciente',@sesion_n)";
  if (!$conn->query($sql) === TRUE) 
  {
    die("Error al crear la sesión: " . $conn->error);

  } 

  $resultado = $conn->query("SELECT @sesion_n AS num_sesion");
  $fila = $resultado->fetch_assoc();
  header("location: ./chat_solicitante.php?id=".$fila['num_sesion']);

  // Cerrar la conexión
  $conn->close();
?>
