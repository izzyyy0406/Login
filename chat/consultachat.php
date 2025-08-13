<?php
session_start();
include('conexion.php');

$sesion = isset($_POST['id_conv']) ? intval($_POST['id_conv']) : 0;
$id_usuario_actual = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

if ($sesion <= 0) {
    echo "<div class='mensaje-info'>ID de sesión no válido</div>";
    exit();
}

$sql = "CALL sp_obtener_chat(?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sesion);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nombre = htmlspecialchars($row['nombres'] . ' ' . $row['apellidos']);
        $mensaje = htmlspecialchars($row['mensaje']);
        $fecha = date("H:i", strtotime($row['fecha_registro']));
        $id_remitente = $row['fk_id_remitente'];
        
        // Determinar si el mensaje es del usuario actual
        $es_propio = ($id_remitente == $id_usuario_actual);
        $clase = $es_propio ? 'mensaje-propio' : 'mensaje-otro';
        
        echo "<div class='$clase'>
                <span class='nombre'>$nombre</span>
                <p class='texto'>$mensaje</p>
                <span class='fecha'>$fecha</span>
              </div>";
    }
} else {
    echo "<div class='mensaje-info'>Inicia la conversación</div>";
}

$stmt->close();
$conn->close();
?>