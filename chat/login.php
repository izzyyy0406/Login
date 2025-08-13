<?php
// Recibir datos
$usuario = $_POST["usuario"];
$clave = $_POST["clave"];
$rol = $_POST["rol"];

include('conexion.php');

// Aquí pega el código para llamar y manejar la respuesta del procedimiento almacenado:
$query = "CALL sp_validar_usuario('$usuario', '$clave', $rol)";
if (mysqli_multi_query($conn, $query)) {
    if ($result = mysqli_store_result($conn)) {
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($row['resultado'] === 'OK') {
            session_start();

            $_SESSION['nick'] = $usuario;
            $_SESSION['id'] = $row['id'];
            $_SESSION['rol'] = $row['rol_nombre'];  // ¡Aquí está la clave!

            echo "Acceso permitido";
        } else {
            echo trim($row['resultado']);
        }
    }
    while (mysqli_more_results($conn) && mysqli_next_result($conn)) {}
} else {
    echo "Error en la consulta: " . $conn->error;
}
?>
