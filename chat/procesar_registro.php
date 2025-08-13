<?php


$clave = $_POST["clave"];
$confirmar = $_POST["confirmar"];

// Validar coincidencia en el servidor
if ($clave !== $confirmar) {
  http_response_code(400);
  die("Error: Las contraseñas no coinciden");
}



$nick = $_POST["nick"];
$correo = $_POST["correo"];
$identificacion = $_POST["identificacion"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$celular = $_POST["celular"];
$clave =$_POST["clave"];
$confirmar = $_POST["confirmar"];

include('conexion.php');

// Preparar llamada al procedimiento almacenado
$stmt = $conn->prepare("CALL sp_guardar_usuario(?, ?, ?, ?, ?, ?, ?)");

// Vincular parámetros
$stmt->bind_param("ssissis", $nick, $correo, $identificacion, $nombres, $apellidos, $celular, $clave);

// Ejecutar procedimiento almacenado
if ($stmt->execute()) 
{
    echo ("Usuario registrado con éxito");
} 
else {
    echo ("Error al registrar usuario: ").$conn->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>