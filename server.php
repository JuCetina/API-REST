<?php

// *** Autenticación via HTTP:
// $user = array_key_exists('PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : '';
// $pwd = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : '';

// if($user !== 'usuario' || $pwd !== 'contrasenia'){
//     die;
// }

// *** Autenticación vía HMAC:
// if( !array_key_exists('HTTP_X_HASH', $_SERVER) ||
//     !array_key_exists('HTTP_X_UID', $_SERVER) ||
//     !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) )
// {
//     die;
// }

// list($hash, $uid, $timestamp) = [
//     $_SERVER['HTTP_X_HASH'],
//     $_SERVER['HTTP_X_UID'],
//     $_SERVER['HTTP_X_TIMESTAMP'],
// ];

// $secret = 'Frase secreta';

// $newHash = sha1($uid.$timestamp.$secret);

// if( $newHash !== $hash ){
//     die;
// }

// *** Autenticación via Access Tokens:
// if( !array_key_exists('HTTP_X_TOKEN', $_SERVER) ){
//     die;
// }

//URL servidor de autenticación:
//(NOTA: Para el ejercicio se levantó el servidor de autenticación a traves de CMD con el comando:
//php -S localhost:8001 ruta_completa_de_archivo_auth_server.php
//En el archivo auth_server.php está la lógica del servidor de autenticación)
// $url = 'http://localhost:8001';

//Para que funcione sin necesidad de levantasr el servidor de autenticación aparte:
// $url = 'http://localhost/api_rest/auth_server.php';

//Inicializar la llamada
// $ch = curl_init( $url );

//Setea opción de la información del encabezado
// curl_setopt(
//     $ch,
//     CURLOPT_HTTPHEADER,
//     [
//         "X-Token: {$_SERVER['HTTP_X_TOKEN']}"
//     ]
// );

//Setea opción que permite obtener lo que estamos recibiendo del servidor de auteticación
// curl_setopt(
//     $ch,
//     CURLOPT_RETURNTRANSFER,
//     true
// );

//Realizar la llamada completa
// $ret = curl_exec($ch);

// if( $ret !== 'true'){
//     die;
// }

// ** Fin de Autenticaciones


$allowedResources = [
    'badges',
];

$badges = [
    1 => [
        "id" => "1",
        "firstName" => "Zoie",
        "lastName"  => "Grant",
        "email" => "Efrain_Gaylord6@yahoo.com",
        "jobTitle"  => "Corporate Branding Representative",
        "twitter" => "ZoieGrant05512-2019",
        "avatarUrl" => "https://www.gravatar.com/avatar/0fc6d5ee2ee176d4581acf6a7e5644cc?d=identicon",
    ],
    2 => [
        "id" => "2",
        "firstName" => "Dustin",
        "lastName" => "Stehr",
        "email" => "Lue.Funk@hotmail.com",
        "jobTitle" => "Legacy Infrastructure Consultant",
        "twitter" => "DustinStehr77585-9157",
        "avatarUrl" => "https://picsum.photos/80",
    ],
    3 => [
        "id" => "3",
        "firstName" => "Karlee",
        "lastName" => "Satterfield",
        "email" => "Christian31@gmail.com",
        "jobTitle" => "Chief Accounts Agent",
        "twitter" => "KarleeSatterfield32692-9732",
        "avatarUrl" => "https://www.gravatar.com/avatar/c2d679f9b44e1869548ab95aac18b7c9?d=identicon",
    ],
    4 => [
        "id" => "4",
        "firstName" => "Ernie",
        "lastName" => "Schmidt",
        "email" => "Shemar63@yahoo.com",
        "jobTitle" => "Dynamic Accounts Coordinator",
        "twitter" => "ErnieSchmidt56445-6854",
        "avatarUrl" => "https://www.gravatar.com/avatar/6a7e6f60ad63c102322894ab94a26f2f?d=identicon",
    ],
    5 => [
        "id" => "5",
        "firstName" => "Kelly",
        "lastName" => "Corkery",
        "email" => "Van_Schimmel@yahoo.com",
        "jobTitle" => "Dynamic Tactics Liaison",
        "twitter" => "KellyCorkery06275-3676",
        "avatarUrl" => "https://www.gravatar.com/avatar/00e35de53a06a655fe5b6ac8b96bdb84?d=identicon",
    ]
];

$resource = $_GET['resource'];
    
if(!in_array($resource, $allowedResources)){
    http_response_code( 400 );
    die;
}


$resource_id = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';


header('Content-Type: application/json');



switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(empty($resource_id)){
            echo json_encode($badges);
        }elseif(array_key_exists($resource_id, $badges)) {
            echo json_encode($badges[ $resource_id ]);
        }else{
            http_response_code( 404 );
        }
        break;
    case 'POST':
        $json = file_get_contents('php://input');
        array_push($badges, json_decode($json, true));
        echo json_encode($badges);
        break;
    case 'PUT':
        if(!empty($resource_id) && array_key_exists($resource_id, $badges)){
            $json = file_get_contents('php://input');
            $badges[ $resource_id ] = json_decode($json, true);
            echo json_encode($badges);
        }
        break;
    case 'DELETE':
        if(!empty($resource_id) && array_key_exists($resource_id, $badges)){
            $json = file_get_contents('php://input');
            unset($badges[ $resource_id ]);
            echo json_encode($badges);
        }
        break;
}