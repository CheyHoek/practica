<?php
require_once('conexion.php');

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
        // Procesar el inicio de sesión (verificación en la base de datos)
        $stmt = $conexion->prepare("SELECT password FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            // Las credenciales son correctas, redirigir a cotizar.html
            header('Location: cotizar.html');
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
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