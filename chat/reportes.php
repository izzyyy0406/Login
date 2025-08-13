<?php
include 'conexion.php';
$query = "SELECT s.id_sesion, p.nick AS paciente, a.nick AS asesor, s.estado, s.fecha_inicio, s.fecha_fin
          FROM sesion s
          LEFT JOIN usuario p ON s.fk_id_paciente = p.id
          LEFT JOIN usuario a ON s.fk_id_asesor = a.id";
$res = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reportes y Estadísticas - Sistema de Apoyo</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/reporte.css">
</head>
<body>
  <div class="admin-container">
    <div class="admin-header">
      <h1><i class="fas fa-chart-line"></i> Reportes y Estadísticas</h1>
      <div class="report-actions">
        <a href="http://localhost/colectivo/PROYECTO INTEGRADOR/chat/admin.php" class="back-button">
      <i class="fas fa-arrow-left"></i> Volver
       </a>
       
      </div>
    </div>
    
    <div class="stats-summary">
      <div class="stat-card">
        <div class="stat-value"><?= mysqli_num_rows($res) ?></div>
        <div class="stat-label">Sesiones Totales</div>
        <div class="stat-icon"><i class="fas fa-comments"></i></div>
      </div>
      <!-- Puedes agregar más estadísticas aquí -->
    </div>
    
    <div class="reports-table-container">
      <table class="reports-table">
        <thead>
          <tr>
            <th>ID Sesión</th>
            <th>Paciente</th>
            <th>Asesor</th>
            <th>Estado</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
              <td><?= htmlspecialchars($row['id_sesion']) ?></td>
              <td><?= htmlspecialchars($row['paciente']) ?></td>
              <td><?= htmlspecialchars($row['asesor'] ?? 'Sin asignar') ?></td>
              <td><span class="status-badge status-<?= strtolower($row['estado']) ?>"><?= htmlspecialchars($row['estado']) ?></span></td>
              <td><?= htmlspecialchars($row['fecha_inicio']) ?></td>
              <td><?= htmlspecialchars($row['fecha_fin'] ?? 'En curso') ?></td>
              <td class="actions">
                <a href="ver_chat.php?id=<?= $row['id_sesion'] ?>" class="view-btn" title="Ver chat">
                  <i class="fas fa-eye"></i> Ver
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>


