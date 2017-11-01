<?php
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