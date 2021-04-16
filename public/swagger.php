<?php
require __DIR__ . "/../vendor/autoload.php";


$openapi = \OpenApi\scan('../src');
header('Content-Type: application/json');
echo $openapi->toJson();
