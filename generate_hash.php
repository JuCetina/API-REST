<?php

//Autenticación HMAC:
//Archivo que genera el hash para el cliente
//Ejecutar en CMD entrando a la carpeta del proyecto:
//php generate_hash.php 1

$time = time();
echo "Time: $time".PHP_EOL."Hash: ".sha1($argv[1].$time.'Frase secreta').PHP_EOL;