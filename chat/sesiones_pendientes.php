<?php
include('conexion.php');

// Consulta SQL
$sql = "SELECT id_sesion, nombres, apellidos, 'En Espera' AS estado FROM sesion
INNER JOIN usuario ON(id=fk_id_paciente)
WHERE estado='espera'";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
// Mostrar los resultados
    while($row = $result->fetch_assoc()) 
    {   echo("<tr>");
        echo("<td>".$row["nombres"]."</td>");
        echo("<td>".$row["apellidos"]."</td>");
        echo("<td>".$row["estado"]."</td>");
        echo("<td><a href='chat_asesor.php?id=".$row["id_sesion"]."' class='btn'>Atender</a></td>");

        echo("</tr>");
    }
} 

// Cerrar la conexión
$conn->close();
?>