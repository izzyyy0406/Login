<?php
session_start();
$id_sesion = $_GET['id'];
$id_usuario = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Chat de Apoyo Psicológico</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/chat_solicitante.css" />
  <script src="jquery/jquery-3.6.0.min.js"></script>
  <script src="js/chat_solicitante.js"></script>
</head>
<body>
  <div class="chat-container">
    <input type="hidden" id="id_sesion" value="<?php echo htmlspecialchars($id_sesion); ?>" />
    <input type="hidden" id="id_usuario" value="<?php echo $id_usuario; ?>" />
    
    <div class="chat-header">Chat de Apoyo</div>
    
    <div class="chat-panel" id="chat-panel">
      <!-- Los mensajes se cargarán aquí automáticamente -->
    </div>
    
    <div class="chat-input">
      <input type="text" id="mensaje" placeholder="Escribe tu mensaje aquí..." />
      <button id="enviar">Enviar</button>
    </div>
  </div>
</body>
</html>