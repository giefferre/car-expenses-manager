<?php
require '../vendor/autoload.php';
require_once 'config.php';

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

// Application configuration & setup

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

// CORS implementation, simple version
// https://www.slimframework.com/docs/v3/cookbook/enable-cors.html

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// Application Routes

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

$app->get('/expenses', function (Request $request, Response $response, array $args) {
    $mapper = new ExpenseMapper($this->db);
    $aYearAgo = date("Y-m-d", time() - 60 * 60 * 24 * 365);
    $now = date("Y-m-d", time());
    $expenses = $mapper->getExpenses($aYearAgo, $now);

    $expensesReport = new ExpensesReport($expenses, $aYearAgo, $now);

    return $response->withHeader('Content-type', 'application/json')->withJson($expensesReport);
});

$app->post('/expenses', function (Request $request, Response $response, array $args) {
    $requestBody = $request->getParsedBody();

    try {
        $carMapper = new CarMapper($this->db);
        $car = $carMapper->getCarById($requestBody['carId']);
        $expense = new Expense([
            "carId" => $requestBody["carId"],
            "carPlateNumber" => $car->getPlateNumber(),
            "amount" => $requestBody["amount"],
            "type" => $requestBody["type"],
            "reason" => $requestBody["reason"],
            "date" => $requestBody["date"],
        ]);
    } catch (Exception $e) {
        return $response->withStatus(400)->write("bad request");
    }

    $expenseMapper = new ExpenseMapper($this->db);
    $expenseMapper->save($expense);

    return $response->withStatus(204);
});

$app->run();
