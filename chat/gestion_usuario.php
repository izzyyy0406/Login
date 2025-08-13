<?php
include 'conexion.php';
$query = "SELECT u.id, u.nick, u.nombres, u.apellidos, r.nom_rol, e.nom_estado
          FROM usuario u
          JOIN rol r ON u.fk_id_rol = r.id_rol
          JOIN estado e ON u.fk_id_estado = e.id_estado";
$resultado = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Usuarios - Sistema de Apoyo</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" href="css/gestion_usuario.css" />
    
  </head>
  <body>
    <?php
session_start();

if (isset($_SESSION['mensaje'])) {
    echo '<div id="alerta" style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 5px;">'
        . htmlspecialchars($_SESSION['mensaje']) .
        '</div>';
    unset($_SESSION['mensaje']);
}
?>

<script>
// Ocultar alerta tras 3 segundos
setTimeout(() => {
    const alerta = document.getElementById('alerta');
    if (alerta) alerta.style.display = 'none';
}, 3000);
</script>
    <div class="admin-container">
      <div class="admin-header">
  <h1><i class="fas fa-users-cog"></i> Gestión de Usuarios</h1>
  <div class="header-buttons">
    <a href="http://localhost/colectivo/PROYECTO INTEGRADOR/chat/admin.php" class="back-button">
      <i class="fas fa-arrow-left"></i> Volver
    </a>
    <a href="agregar_usuario.php" class="add-button">
      <i class="fas fa-user-plus"></i> Nuevo Usuario
    </a>
  </div>
</div>

      <div class="users-table-container">
        <table class="users-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Nombre Completo</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['nick']) ?></td>
              <td>
                <?= htmlspecialchars($row['nombres'] . ' ' . $row['apellidos']) ?>
              </td>
              <td>
                <span class="role-badge role-<?= strtolower($row['nom_rol']) ?>"
                  ><?= htmlspecialchars($row['nom_rol']) ?></span
                >
              </td>
              <td>
                <span
                  class="status-badge status-<?= strtolower($row['nom_estado']) ?>"
                  ><?= htmlspecialchars($row['nom_estado']) ?></span
                >
              </td>
              <td class="actions">
                <a
                  href="editar_usuario.php?id=<?= $row['id'] ?>"
                  class="edit-btn"
                  title="Editar"
                >
                  <i class="fas fa-edit"></i>
                </a>
                <a
                  href="eliminar_usuario.php?id=<?= $row['id'] ?>"
                  class="delete-btn"
                  title="Eliminar"
                  onclick="return confirm('¿Estás seguro de eliminar este usuario?')"
                >
                  <i class="fas fa-trash-alt"></i>
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
