<?php include('validar_sesion_asesor.php') ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel del Asesor - Apoyo Psicológico</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/asesor.css">
  <meta http-equiv="refresh" content="10">  
</head> 
<body>
  <div class="container">
    <h1>Panel de Sesiones</h1>
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Estado</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody id="sesiones">
        <?php include ('sesiones_pendientes.php'); ?>
      </tbody>
    </table>
  </div>
</body>
</html>