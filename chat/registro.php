<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Apoyo Psicológico</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/registro.css">
  <script type="text/javascript" src="jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="js/registro.js"></script>
</head>
<body>

  


  <div class="contenedor">
    <h1>Crea tu cuenta</h1>
    <form id="formulario">
      <div class="campo">
        <label for="nick">Nombre de usuario</label>
        <input type="text" id="nick" name="nick" placeholder="Ej: usuario123" required>
        <span class="error-message">Por favor ingresa un nombre de usuario válido</span>
      </div>
      <div class="campo">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" placeholder="tucorreo@ejemplo.com" required>
        <span class="error-message">Por favor ingresa un correo válido</span>
      </div>
      <div class="campo">
        <label for="identificacion">Número de identificación</label>
        <input type="text" id="identificacion" name="identificacion" placeholder="Número de documento" required>
        <span class="error-message">Por favor ingresa tu identificación</span>
      </div>
      <div class="campo">
        <label for="nombres">Nombres</label>
        <input type="text" id="nombres" name="nombres" placeholder="Tus nombres" required>
        <span class="error-message">Por favor ingresa tus nombres</span>
      </div>
      <div class="campo">
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Tus apellidos" required>
        <span class="error-message">Por favor ingresa tus apellidos</span>
      </div>
      <div class="campo">
        <label for="celular">Número de celular</label>
        <input type="text" id="celular" name="celular" placeholder="Número de contacto" required>
        <span class="error-message">Por favor ingresa un número válido</span>
      </div>
      <!-- Mensaje de error para contraseñas -->
<div class="error-message" id="error-password" style="display: none;">
  Las contraseñas no coinciden
</div>

<!-- Actualiza los spans de error -->
<div class="campo">
  <label for="password">Contraseña</label>
  <input type="password" id="clave" name="clave" required>
  <span class="error-message" id="error-clave"></span>
</div>

<div class="campo">
  <label for="confirmar-password">Confirmar contraseña</label>
  <input type="password" id="confirmar" name="confirmar" required>
  <span class="error-message" id="error-confirmar"></span>
</div>
      <button type="button" id="enviar">Registrarse</button>
    </form>
    <p class="login">¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
  </div>
</body>
</html>