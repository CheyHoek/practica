<?php
$servername = "localhost";
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["operation"]) && $_POST["operation"] == "insert") {
    $nombre = isset($_POST["nomamigurumi"]) ? $_POST["nomamigurumi"] : "";
    $altura = isset($_POST["altura"]) ? $_POST["altura"] : 0;
    $ancho = isset($_POST["ancho"]) ? $_POST["ancho"] : 0;
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : "";
    $costoMateriales = isset($_POST["costoMateriales"]) ? $_POST["costoMateriales"] : 0;
    $horasTrabajo = isset($_POST["horasTrabajo"]) ? $_POST["horasTrabajo"] : 0;
    $tarifaHora = isset($_POST["tarifaHora"]) ? $_POST["tarifaHora"] : 0;
    $factorGanancia = isset($_POST["factorGanancia"]) ? $_POST["factorGanancia"] : 0;

// Calcular el precio
$precioRecomendado = ($costoMateriales + ($horasTrabajo * $tarifaHora)) * $factorGanancia;

// Insertar datos en la base de datos
$sql = $conn->prepare("INSERT INTO amigurumi (nombre, altura, ancho, descripcion, costoMateriales, horasTrabajo, tarifaHora, factorGanancia) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("sddsddds", $nombre, $altura, $ancho, $descripcion, $costoMateriales, $horasTrabajo, $tarifaHora, $factorGanancia);

if ($sql->execute()) {
    echo "Registro guardado exitosamente";
} else {
    echo "Error al guardar el registro: " . $sql->error;
}

$sql->close();
}
// Cerrar la conexión
$conn->close();
?>
