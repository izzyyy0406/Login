<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION['id'])) {
  header("Location: login.php");
  exit();
}

$id_asesor = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Chat de Apoyo Psicológico - Orientador</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/chat_asesor.css" />
  <script src="jquery/jquery-3.6.0.min.js"></script>
</head>
<body>
  <?php if (isset($_GET['id'])): 
    $id_sesion = $_GET['id'];
  ?>
    <div class="chat-container">
      <input type="hidden" id="id_usuario" value="<?php echo $id_asesor; ?>" />
      <div class="chat-header">
        Chat de Apoyo
        <span id="id_conv">ID: <?php echo $id_sesion; ?></span>
      </div>
      <div class="chat-panel" id="chat-panel">
        <!-- Los mensajes se insertarán aquí -->
      </div>
      <div class="chat-input">
        <input type="text" id="mensaje" placeholder="Escribe tu mensaje aquí..." />
        <button id="enviar">Enviar</button>
      </div>
      <div class="chat-footer">
        <button id="finalizar-chat">Finalizar Chat</button>
      </div>
    </div>
    <script src="js/chat_asesor.js"></script>

  <?php else: ?>
    <div class="lista-sesiones">
      <h2>Sesiones Activas</h2>
      <ul>
        <?php
        $sql = "SELECT s.id_sesion, u.nombre 
                FROM sesiones s 
                JOIN usuarios u ON s.fk_id_usuario = u.id_usuario 
                WHERE s.estado = 'Activo'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
            echo "<li>
                    <strong>{$row['nombre']}</strong> - 
                    <a href='chat_asesor.php?id={$row['id_sesion']}'>Ingresar al chat</a>
                  </li>";
          }
        } else {
          echo "<p>No hay sesiones activas.</p>";
        }
        ?>
      </ul>
    </div>
  <?php endif; ?>
</body>
</html>
