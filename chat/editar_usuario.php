<?php
include 'conexion.php';

$id = $_GET['id'];
$usuario = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM usuario WHERE id = $id"));
$roles = mysqli_query($conn, "SELECT * FROM rol");
$estados = mysqli_query($conn, "SELECT * FROM estado");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $correo = $_POST['correo'];
    $identificacion = $_POST['identificacion'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];

    mysqli_query($conn, "UPDATE usuario SET
      nick='$nick',
      correo='$correo',
      identificacion='$identificacion',
      nombres='$nombres',
      apellidos='$apellidos',
      celular='$celular',
      fk_id_rol=$rol,
      fk_id_estado=$estado
      WHERE id = $id
    ");

    
header("Location: http://localhost/colectivo/PROYECTO INTEGRADOR/chat/gestion_usuario.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuario - Sistema de Apoyo</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/editar_usuario.css">
</head>
<body>
  <div class="admin-container">
    <div class="admin-header">
      <h1><i class="fas fa-user-edit"></i> Editar Usuario</h1>
      <a href="http://localhost/colectivo/PROYECTO INTEGRADOR/chat/gestion_usuario.php" class="back-button">
       <i class="fas fa-arrow-left"></i> Volver
      </a>
    </div>
    
    <div class="edit-form-container">
      <form method="POST" class="user-form">
        <div class="form-grid">
          <div class="form-group">
            <label for="nick">Nombre de usuario</label>
            <input type="text" id="nick" name="nick" value="<?= htmlspecialchars($usuario['nick']) ?>" required>
          </div>
          
          <div class="form-group">
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
          </div>
          
          <div class="form-group">
            <label for="identificacion">Identificación</label>
            <input type="text" id="identificacion" name="identificacion" value="<?= htmlspecialchars($usuario['identificacion']) ?>">
          </div>
          
          <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" id="nombres" name="nombres" value="<?= htmlspecialchars($usuario['nombres']) ?>">
          </div>
          
          <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>">
          </div>
          
          <div class="form-group">
            <label for="celular">Número de celular</label>
            <input type="text" id="celular" name="celular" value="<?= htmlspecialchars($usuario['celular']) ?>">
          </div>
          
          <div class="form-group">
            <label for="rol">Rol</label>
            <select id="rol" name="rol" class="form-select">
              <?php while ($r = mysqli_fetch_assoc($roles)) { ?>
                <option value="<?= $r['id_rol'] ?>" <?= $r['id_rol'] == $usuario['fk_id_rol'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($r['nom_rol']) ?>
                </option>
              <?php } ?>
            </select>
          </div>
          
          <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado" name="estado" class="form-select">
              <?php while ($e = mysqli_fetch_assoc($estados)) { ?>
                <option value="<?= $e['id_estado'] ?>" <?= $e['id_estado'] == $usuario['fk_id_estado'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($e['nom_estado']) ?>
                </option>
              <?php } ?>
            </select>
          </div>
        </div>
        
        <div class="form-actions">
          <button type="submit" class="save-button">
            <i class="fas fa-save"></i> Guardar Cambios
          </button>
          <a href="http://localhost/colectivo/PROYECTO INTEGRADOR/chat/gestion_usuario.php" class="cancel-button">
            <i class="fas fa-times"></i> Cancelar
          </a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>