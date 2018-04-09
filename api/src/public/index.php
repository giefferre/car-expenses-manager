<?php
require '../../vendor/autoload.php';
require_once 'config.php';

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

/* Application configuration & setup */

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

/* Application Routes */

$app->get('/', function (Request $request, Response $response, array $args) {
    return $response->write('CXM API 1.0');
});

$app->get('/fleet', function (Request $request, Response $response, array $args) {
    $mapper = new CarMapper($this->db);
    $cars = $mapper->getCars();

    return $response->withHeader('Content-type', 'application/json')->withJson($cars);
});

$app->post('/fleet', function (Request $request, Response $response, array $args) {
    try {
        $car = new Car($request->getParsedBody());
    } catch (Exception $e) {
        return $response->withStatus(400)->write("bad request");
    }

    $mapper = new CarMapper($this->db);
    $mapper->save($car);

    return $response->withStatus(204);
});
$app->run();
