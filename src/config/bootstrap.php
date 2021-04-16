<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . "/Db.php";

$app = AppFactory::create();
require __DIR__ . '/../../src/routes.php';


return $app;