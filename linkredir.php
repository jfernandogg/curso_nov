<?php
// Cargar variables de entorno desde .env
function loadEnv($path) {
    if(!file_exists($path)) {
        die('El archivo .env no existe');
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) continue;
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        if (!empty($name)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
        }
    }
}

// Cargar variables de entorno
loadEnv(__DIR__ . '/.env');

// Configuración de la API
$apiKey = getenv('BOLD_API_KEY');
$apiUrl = 'https://integrations.api.bold.co/online/link/v1';

// Función para crear el link de pago
function crearLinkDePago($monto, $descripcion) {
    global $apiKey, $apiUrl;

    $data = [
        'amount_type' => 'CLOSE',
        'amount' => [
            'currency' => 'COP',
            'total_amount' => $monto,
            'tip_amount' => 0
        ],
        'description' => $descripcion
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: x-api-key $apiKey\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($apiUrl, false, $context);

    if ($result === FALSE) {
        die('Error al crear el link de pago');
    }

    $response = json_decode($result, true);
    return $response['payload']['url'];
}

// Recibir el valor y la descripción desde la URL
$monto = $_GET['monto'];
$descripcion = $_GET['descripcion'];

// Crear el link de pago
$linkDePago = crearLinkDePago($monto, $descripcion);

// Redirigir al navegador al link de pago
header("Location: $linkDePago");
exit();
?>
