<?php
require_once('conexion.php'); // Asegúrate de tener un archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $recaptchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

    // Verificar el reCAPTCHA
    $secretKey = '6LcryhspAAAAAPGs4OeCBYLrxtVYs7Q8xEpEUh1m';
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $secretKey,
        'response' => $recaptchaResponse
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);

    // Verificar la respuesta del reCAPTCHA
    if ($response['success']) {
        // Procesar el registro en la base de datos
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registro exitoso.";
        } else {
            echo "Error al registrar usuario.";
        }

        $stmt->close();
    } else {
        echo "Error de reCAPTCHA. Intenta de nuevo.";
    }
} else {
    // Si no es una solicitud POST, redirige a la página principal
    header('Location: index.html');
    exit();
}
?>