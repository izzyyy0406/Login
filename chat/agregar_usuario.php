<?php
include 'conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nick = $_POST['nick'];
    $correo = $_POST['correo'];
    $identificacion = $_POST['identificacion'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $celular = $_POST['celular'];
    $clave = md5($_POST['clave']);
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];

    $verificacion = "SELECT * FROM usuario WHERE nick='$nick' OR correo='$correo' OR identificacion='$identificacion'";
    $resultado = mysqli_query($conn, $verificacion);

    if (mysqli_num_rows($resultado) > 0) {
        $_SESSION['mensaje'] = "Error: El usuario ya existe con ese nick, correo o identificación.";
        $_SESSION['tipo'] = 'error';
    } else {
        $insertar = "INSERT INTO usuario (nick, correo, identificacion, nombres, apellidos, celular, clave, fk_id_rol, fk_id_estado)
                     VALUES ('$nick', '$correo', '$identificacion', '$nombres', '$apellidos', '$celular', '$clave', $rol, $estado)";
        if (mysqli_query($conn, $insertar)) {
            $_SESSION['mensaje'] = "Usuario agregado correctamente.";
            $_SESSION['tipo'] = 'success';
        } else {
            $_SESSION['mensaje'] = "Error al agregar el usuario.";
            $_SESSION['tipo'] = 'error';
        }
    }

    header("Location: gestion_usuario.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Usuario - Sistema de Apoyo</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/agregar_usuario.css">
</head>
<body>
  <div class="admin-container">
    <div class="admin-header">
      <h1><i class="fas fa-user-plus"></i> Agregar Nuevo Usuario</h1>
      <a href="gestion_usuario.php" class="back-button">
        <i class="fas fa-arrow-left"></i> Volver
      </a>
    </div>
    
    <div class="form-container">
      <form method="POST" class="user-form">
        <div class="form-grid">
          <div class="form-group">
            <label for="nick">Nombre de usuario</label>
            <input type="text" id="nick" name="nick" required placeholder="Ej: usuario123">
          </div>
          
          <div class="form-group">
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" required placeholder="ejemplo@dominio.com">
          </div>
          
          <div class="form-group">
            <label for="identificacion">Identificación</label>
            <input type="text" id="identificacion" name="identificacion" required placeholder="Número de documento">
          </div>
          
          <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" id="nombres" name="nombres" required placeholder="Nombres del usuario">
          </div>
          
          <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" required placeholder="Apellidos del usuario">
          </div>
          
          <div class="form-group">
            <label for="celular">Número de celular</label>
            <input type="text" id="celular" name="celular" required placeholder="Número de contacto">
          </div>
          
          <div class="form-group">
            <label for="clave">Contraseña</label>
            <div class="password-container">
              <input type="password" id="clave" name="clave" required placeholder="Mínimo 8 caracteres">
              <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>
          </div>
          
          <div class="form-group">
            <label for="rol">Rol</label>
            <select id="rol" name="rol" class="form-select" required>
              <option value="">Seleccione un rol</option>
              <option value="0">Administrador</option>
              <option value="1">Médico</option>
              <option value="2">Paciente</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado" name="estado" class="form-select" required>
              <option value="">Seleccione estado</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
        
        <div class="form-actions">
          <button type="submit" class="save-button">
            <i class="fas fa-save"></i> Guardar Usuario
          </button>
          <button type="reset" class="reset-button">
            <i class="fas fa-undo"></i> Limpiar
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('clave');
      const icon = document.querySelector('.toggle-password');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }
  </script>
</body>
</html>