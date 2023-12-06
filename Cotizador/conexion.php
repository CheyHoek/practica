<?php
$hostname = "registro";
$database = "tu_base_de_datos";
$username = "tu_usuario";
$password = "";

$conexion = new mysqli($hostname, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>