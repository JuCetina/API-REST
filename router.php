<?php

// Excepcion para que la url principal sea index.html
// if (in_array( $_SERVER["REQUEST_URI"], [ '/index.html', '/', '' ] )) {
//     echo file_get_contents( 'index.html' );

//     die;
// }

$matches = [];

//Para local  /api_rest/router.php/badges/1
//if(preg_match('/\/([^\/]+)\/([^\/]+)\/([^\/]+)\/([^\/]+)/', $_SERVER["REQUEST_URI"], $matches)){
    // $_GET['resource'] = $matches[3];
    // $_GET['resource_id'] = $matches[4];
//Para producción  /router.php/badges/1
if(preg_match('/\/([^\/]+)\/([^\/]+)\/([^\/]+)/', $_SERVER["REQUEST_URI"], $matches)){
    $_GET['resource'] = $matches[2];
    $_GET['resource_id'] = $matches[3];

    error_log(print_r($matches, 1));
    require 'server.php';

//Para local /api_rest/router.php/badges
//} elseif(preg_match('/\/([^\/]+)\/([^\/]+)\/([^\/]+)\/?/', $_SERVER["REQUEST_URI"], $matches)){
    // $_GET['resource'] = $matches[3];
//Para producción /router.php/badges/
} elseif(preg_match('/\/([^\/]+)\/([^\/]+)\/?/', $_SERVER["REQUEST_URI"], $matches)){
    $_GET['resource'] = $matches[2];

    error_log(print_r($matches, 1));
    require 'server.php';

} else{
    error_log('No matches');
    http_response_code(404);
}
