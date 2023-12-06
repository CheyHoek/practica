<?php
$servername = "127.0.0.1:8080";
$username = "root";
$password = "";
$dbname = "amigurumi_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener valores del formulario
$nombre = $_POST['nomamigurumi'];
$altura = $_POST['altura'];
$ancho = $_POST['ancho'];
$descripcion = $_POST['descripcion'];
$costoMateriales = $_POST['costoMateriales'];
$horasTrabajo = $_POST['horasTrabajo'];
$tarifaHora = $_POST['tarifaHora'];
$factorGanancia = $_POST['factorGanancia'];

// Calcular el precio
$precioRecomendado = ($costoMateriales + ($horasTrabajo * $tarifaHora)) * $factorGanancia;

// Insertar datos en la base de datos
$sql = "INSERT INTO Amigurumi (nombre, altura, ancho, descripcion, costoMateriales, horasTrabajo, tarifaHora, factorGanancia, precioRecomendado)
VALUES ('$nombre', $altura, $ancho, '$descripcion', $costoMateriales, $horasTrabajo, $tarifaHora, $factorGanancia, $precioRecomendado)";

if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
} else {
    echo "Error al insertar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>