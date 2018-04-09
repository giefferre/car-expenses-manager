<?php
require '../../vendor/autoload.php';
require_once 'config.php';

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/* Application configuration & setup */

$app = new \Slim\App(['settings' => $config]);

/* Application Routes */

$app->get('/', function (Request $request, Response $response, array $args) {
    return $response->write('CXM API 1.0');
});

$app->run();
