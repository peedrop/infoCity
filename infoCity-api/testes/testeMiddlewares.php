<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require_once "vendor/autoload.php";

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$configuration = new \Slim\Container($configuration);

$mid01 = function(Request $request, Response $response, $next){
    $response->getBody()->write("Dentro do middleware 01<br>");
    $response = $next($request, $response);
    $response->getBody()->write("<br>Dentro do middleware 02");
    return $response;
};

$app = new \Slim\App($configuration);

$app->post('/teste1', function(Request $request, Response $response, array $args): Response {
    $data = $request->getParsedBody();
    $nome = $data['nome'] ?? ''; 
    $response->getBody()->write("Produto {$nome} [POST]");
    return $response;
})->add($mid01);


//agrupar rotas
$app->group('/teste2', function() use($app) {
    //variaas rotas dentro
    $app->get('/', );
    $app->get('/asd', );
})->add($mid01);

$app->run();