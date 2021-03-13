<?php

//Autenticación Access Token:
//Archivo para simular el servidor de autenticación
//Usando el metodo POST para responder al cliente su Token
//Usando GET para respuesta al servidor de recursos si el Token enviado por el cliente es correcto o no

$method = strtoupper( $_SERVER['REQUEST_METHOD'] );

$token = "Token5d0937455b6744.68357201";

if ( $method === 'POST' ) {
    if ( !array_key_exists( 'HTTP_X_CLIENT_ID', $_SERVER ) || !array_key_exists( 'HTTP_X_SECRET', $_SERVER ) ) {
        http_response_code( 400 );

        die( 'Faltan parametros' );
    }

    // Obtiene credenciales del ciliente y las valida
    $clientId = $_SERVER['HTTP_X_CLIENT_ID'];
    $secret = $_SERVER['HTTP_X_SECRET'];

    if ( $clientId !== '1' || $secret !== 'SuperSecreto!' ) {
        http_response_code( 403 );

        die ( "No autorizado");
    }

    //Si todo OK, devuelve el TOKEN al cliente
    echo "$token";

} elseif ( $method === 'GET' ) {
    if ( !array_key_exists( 'HTTP_X_TOKEN', $_SERVER ) ) {
        http_response_code( 400 );

        die ( 'Faltan parametros' );
    }

    //Si llega un token y es igual al token almacenado, devuelve true en string al servidor de recursos
    if ( $_SERVER['HTTP_X_TOKEN'] === $token ) {
        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}