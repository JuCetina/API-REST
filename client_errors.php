<?php

//Para el manejo de errores en el lado del cliente
//En CMD ubicarse en la carpeta del proyectoy escribir: php client_errors.php http://localhost/api_rest/router.php/badges
//Y hacer varias pruebas cambiando la url generando errores

$ch = curl_init( $argv[1] );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

switch ($httpCode) {
    case 200:
        echo 'Todo bien!';
        break;

    case 400:
        echo 'Pedido incorrecto';
        break;

    case 403:
        echo 'No autorizado';
        break;

    case 404:
        echo 'Pedido no encontrado';
        break;

    case 500:
        echo 'El servidor falló';
        break;
}