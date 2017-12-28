<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

date_default_timezone_set('America/La_Paz');


$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

$base = __DIR__ . '/../app/';

$folders = [
    'common',
    'entitie',
    'exception',
    'helper',
    'http',
    'lib',
    'model',
    'route'
];

foreach($folders as $f)
{
    foreach (glob($base . "$f/*.php") as $k => $filename)
    {
        require $filename;
    }
}