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

//post normal
$app->post('/teste1', function(Request $request, Response $response, array $args): Response{
    //retorna um array com todos dados passados
    $data = $request->getParsedBody(); 
    $nome = $data['nome'] ?? ''; //pega valor da variavel nome, caso null atrivui a vazio
    $response->getBody()->write("Produto {$nome} [POST]");
    return $response;
});

//post com validação simples
$app->post('/teste2', function(Request $request, Response $response, array $args): Response{
    //retorna um array com todos dados passados
    $data = $request->getParsedBody(); 
    $nome = $data['nome'];
    if(is_null($nome)){
        $response->getBody()->write("Envie um nome [POST]");
    }else{
        $response->getBody()->write("Produto {$nome} [POST]");  
    } 
    return $response;
});

//put simples
$app->put('/teste1', function(Request $request, Response $response, array $args): Response{
    //retorna um array com todos dados passados
    $data = $request->getParsedBody(); 
    $nome = $data['nome'] ?? ''; //pega valor da variavel nome, caso null atrivui a vazio
    $response->getBody()->write("Produto {$nome} [PUT]");
    return $response;
});

//delete simples
$app->delete('/teste1', function(Request $request, Response $response, array $args): Response{
    //retorna um array com todos dados passados
    $data = $request->getParsedBody(); 
    $nome = $data['nome'] ?? ''; //pega valor da variavel nome, caso null atrivui a vazio
    $response->getBody()->write("Produto {$nome} [DELETE]");
    return $response;
});

$app->run();