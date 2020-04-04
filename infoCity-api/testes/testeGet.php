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

$app = new \Slim\App($configuration);

//get normal
$app->get('/teste1', function(Request $request, Response $response, array $args): Response{
    $response->getBody()->write("Produtos do banco de dados");
    return $response;
});

//get variável
$app->get('/teste2', function(Request $request, Response $response, array $args): Response{
    //pega valor da variavel da requisição, se for null atribui a 10
    $limit = $request->getQueryParams()['limit'] ?? 10; 
    $response->getBody()->write("{$limit} produtos do banco de dados");
    return $response;
});

//get com nome obrigatorio
$app->get('/teste3/{nome}', function(Request $request, Response $response, array $args): Response{
    $nome = $args['nome'];
    $response->getBody()->write("Produtos do banco de dados com o nome {$nome}");
    return $response;
});

//get com nome opcional
$app->get('/teste4[/{nome}]', function(Request $request, Response $response, array $args): Response{
    $nome = $args['nome'] ?? 'mouse';
    $response->getBody()->write("Produtos do banco de dados com o nome {$nome}");
    return $response;
});

$app->run();