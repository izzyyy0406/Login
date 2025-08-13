<?php
include 'conexion.php';

$id_sesion = $_GET['id'];

$mensajes = mysqli_query($conn, "
  SELECT m.mensaje, m.fecha_registro AS fecha_hora, u.nick, u.fk_id_rol
  FROM mensaje m
  JOIN usuario u ON m.fk_id_remitente = u.id
  WHERE m.fk_id_sesion = $id_sesion
  ORDER BY m.fecha_registro ASC
");


// Obtener información de la sesión
$sesion_info = mysqli_query($conn, "
  SELECT s.fecha_inicio, s.fecha_fin, s.estado,
         p.nick AS paciente, a.nick AS asesor
  FROM sesion s
  LEFT JOIN usuario p ON s.fk_id_paciente = p.id
  LEFT JOIN usuario a ON s.fk_id_asesor = a.id
  WHERE s.id_sesion = $id_sesion
");
$info = mysqli_fetch_assoc($sesion_info);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial de Chat #<?= $id_sesion ?> - Sistema de Apoyo</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/ver_chat.css">
</head>
<body>
  <div class="chat-history-container">
    <div class="chat-header">
      <h1><i class="fas fa-history"></i> Historial de Chat #<?= $id_sesion ?></h1>
      <div class="session-info">
        <div><span class="info-label">Paciente:</span> <?= htmlspecialchars($info['paciente']) ?></div>
        <div><span class="info-label">Asesor:</span> <?= htmlspecialchars($info['asesor'] ?? 'No asignado') ?></div>
        <div><span class="info-label">Estado:</span> <span class="status-badge status-<?= strtolower($info['estado']) ?>"><?= htmlspecialchars($info['estado']) ?></span></div>
        <div><span class="info-label">Duración:</span> <?= htmlspecialchars($info['fecha_inicio']) ?> - <?= htmlspecialchars($info['fecha_fin'] ?? 'En curso') ?></div>
      </div>
    </div>
    
    <div class="chat-messages">
      <?php while ($m = mysqli_fetch_assoc($mensajes)) { ?>
        <div class="message <?= $m['fk_id_rol'] == 1 ? 'asesor' : 'paciente' ?>">
          <div class="message-header">
            <span class="user-name"><?= htmlspecialchars($m['nick']) ?></span>
            <span class="message-time"><?= date('H:i', strtotime($m['fecha_hora'])) ?></span>
          </div>
          <div class="message-content"><?= htmlspecialchars($m['mensaje']) ?></div>
        </div>
      <?php } ?>
    </div>
    
    <div class="chat-footer">
      <a href="reportes.php" class="back-button">
        <i class="fas fa-arrow-left"></i> Volver a Reportes
      </a>
    </div>
  </div>
</body>
</html>