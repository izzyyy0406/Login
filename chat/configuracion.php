<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('validar_sesion_admin.php');
include('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuración del Sistema</title>
    <link rel="stylesheet" href="css/configuracion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="jquery/jquery-3.6.0.min.js"></script>
    <script src="js/configuracion.js" defer></script>
</head>
<body>
    <div class="container">
        <a href="http://localhost/colectivo/PROYECTO INTEGRADOR/chat/admin.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h1>Configuración del Sistema</h1>

        <!-- Parámetros del Sistema -->
        <div class="config-section">
            <h2>Parámetros Generales</h2>
            <form id="config-form">
                <div class="form-group">
                    <label for="max_sesiones">Límite de sesiones simultáneas:</label>
                    <input type="number" id="max_sesiones" value="50" min="1">
                </div>
                <div class="form-group">
                    <label for="inactividad">Tiempo de inactividad (minutos):</label>
                    <input type="number" id="inactividad" value="15" min="5">
                </div>
                <button type="submit">Guardar Configuración</button>
            </form>
        </div>

        <!-- Moderación de Usuarios -->
        <div class="config-section">
            <h2>Moderación de Usuarios</h2>
            <div class="user-moderation">
                <?php
                try {
                    $sql = "SELECT 
                                u.id,
                                IFNULL(u.nick, 'Sin nick') AS nick,
                                e.nom_estado AS estado,
                                u.fecha_registro AS ultima_conexion
                            FROM usuario u
                            JOIN estado e ON u.fk_id_estado = e.id_estado";

                    $result = $conn->query($sql);

                    if (!$result) {
                        throw new Exception("Error en la consulta: " . $conn->error);
                    }

                    if ($result->num_rows > 0) {
                        echo "<table id='tabla-moderacion'>
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Última actividad</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        while ($row = $result->fetch_assoc()) {
                            $id = htmlspecialchars($row['id']);
                            $nick = htmlspecialchars($row['nick']);
                            $estado = strtolower($row['estado']);
                            $ultima = htmlspecialchars($row['ultima_conexion']);

                            echo "<tr data-userid='$id'>
                                    <td>$nick</td>
                                    <td>$ultima</td>
                                    <td class='estado'>$estado</td>
                                    <td>";
                            if ($estado === 'activo') {
                                echo "<button class='suspender'>Suspender</button>";
                            } else {
                                echo "<button class='activar'>Reactivar</button>";
                            }
                            echo "</td></tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p>No hay usuarios registrados.</p>";
                    }
                } catch (Exception $e) {
                    echo "<div class='error'>Error crítico: " . $e->getMessage() . "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
