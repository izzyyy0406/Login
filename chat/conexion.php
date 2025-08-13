<?php

$servername = "localhost";
$username = "root";
$password = "Hhzsabdio1";
$dbname = "chat";
$dbport= "3306";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $dbport);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?> 
