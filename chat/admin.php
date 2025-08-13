<?php
  include('validar_sesion_admin.php'); 
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel de Administración - Apoyo Psicológico</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="css/admin.css" />
  </head>
  <body>
    <div class="container">
      <div class="admin-header">
        <h1>Bienvenido, Administrador</h1>
        <p>Panel exclusivo para la gestión del sistema de apoyo psicológico</p>
      </div>

      <div class="admin-panel">
        <div class="admin-card">
          <div class="card-icon">
            <i class="fas fa-users-cog"></i>
          </div>
          <h2>Gestión de Usuarios</h2>
          <p>
            Administra los usuarios registrados en el sistema, sus permisos y
            roles.
          </p>
          <button class="btn-primary" onclick="location.href='http://localhost/colectivo/PROYECTO INTEGRADOR/chat/gestion_usuario.php'">
            <span>Acceder</span>
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>

        <div class="admin-card">
          <div class="card-icon">
            <i class="fas fa-chart-line"></i>
          </div>
          <h2>Reportes</h2>
          <p>Visualiza historial de chats anteriores.</p>
          <button class="btn-primary" onclick="location.href='reportes.php'">
            <span>Acceder</span>
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>

        <div class="admin-card">
          <div class="card-icon">
            <i class="fas fa-cogs"></i>
          </div>
          <h2>Configuración del Sistema</h2>
          <p>
            Ajusta los parámetros y configuraciones generales de la plataforma y usuarios.
          </p>
          <button class="btn-primary" onclick="location.href='configuracion.php'">
            <span>Acceder</span>
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>
      </div>

      <form action="logout.php" method="post">
        <button type="submit" class="logout">
          <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </button>
      </form>
    </div>
  </body>
</html>