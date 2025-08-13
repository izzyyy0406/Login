<?php
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de Sesión - Apoyo Psicológico</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/index.css" />
    <script type="text/javascript" src="jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
  </head>
  <body>
    <div class="contenedor">
      <h1>Bienvenido</h1>
      <form id="formulario">
        <div class="campo">
          <label for="usuario">Usuario</label>
          <input
            type="text"
            id="usuario"
            name="usuario"
            required
            placeholder="Ingresa tu usuario"
          />
        </div>
        <div class="campo">
          <label for="password">Contraseña</label>
          <input
            type="password"
            id="clave"
            name="clave"
            required
            placeholder="••••••••"
          />
        </div>

        
        <div class="campo">
          <label for="rol">Tipo de usuario</label>
          <select id="rol" name="rol" required>
            <option value="">Selecciona tu rol</option>
            <option value="0">Administrador</option>
            <option value="2">Solicitante de Ayuda</option>
            <option value="1">Orientador</option>
          </select>
        </div>
        <button type="button" id="loguear">Iniciar Sesión</button>
      </form>
      <p class="registro">
        ¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>
      </p>
    </div>
  </body>
</html>
