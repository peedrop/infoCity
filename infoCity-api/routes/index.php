<?php

use function src\slimConfiguration;
use function src\basicAuth;

$app = new \Slim\App(slimConfiguration());

// ===========================================================================

use App\Controllers\UsuarioController;

$app->post('/login', UsuarioController::class . ':login'); 
$app->post('/usuario', UsuarioController::class . ':insert'); 

$app->group('', function() use ($app) {
	$app->get('/usuario', UsuarioController::class . ':getAll'); 
	$app->get('/usuarioCorporativo/{id}', UsuarioController::class . ':getAllCorporativo');//
	$app->get('/usuario/{id}', UsuarioController::class . ':getById');
	$app->get('/usuarioByPlanejamento/{id}', UsuarioController::class . ':getByColeta');//
	$app->get('/usuarioIdsByIdColeta/{id}', UsuarioController::class . ':getIdUsuarioByIdColeta');//
	$app->put('/usuario', UsuarioController::class . ':update');  
	$app->delete('/usuario/{id}', UsuarioController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\ColaboracaoController;

$app->group('', function() use ($app) {
	$app->get('/colaboracao', ColaboracaoController::class . ':getAll'); 
	$app->get('/colaboracaoByUser/{id}', ColaboracaoController::class . ':getAllByUser'); 
	$app->get('/colabBySituacao/{id}', ColaboracaoController::class . ':getBySituacao'); 
	$app->get('/colaboracaoNotIn/{idTipo}', ColaboracaoController::class . ':getAllNotIn'); 
	$app->get('/colaboracaoByPlanejamento/{id}', ColaboracaoController::class . ':getByPlanejamento');
	$app->get('/colaboracaoIdColaboracaosByPlanejamento/{id}', ColaboracaoController::class . ':getIdColaboracaosByPlanejamento');
	$app->get('/colaboracao/{id}', ColaboracaoController::class . ':getById');
	$app->post('/colaboracao', ColaboracaoController::class . ':insert'); 
	$app->put('/colaboracao', ColaboracaoController::class . ':update');  
	$app->delete('/colaboracao/trocarSituacao/{id}/{situacao}', ColaboracaoController::class . ':trocarSituacao');
	$app->delete('/colaboracao/{id}', ColaboracaoController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\CidadeController;

$app->group('', function() use ($app) {
	$app->get('/cidade', CidadeController::class . ':getAll'); 
	$app->get('/cidade/{id}', CidadeController::class . ':getById'); 
	$app->post('/cidade', CidadeController::class . ':insert'); 
	$app->put('/cidade', CidadeController::class . ':update');  
	$app->delete('/cidade/{id}', CidadeController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\PlanejamentoController;

$app->group('', function() use ($app) {
	$app->get('/planejamento', PlanejamentoController::class . ':getAll'); 
	$app->get('/planejamento/{id}', PlanejamentoController::class . ':getById'); 
	$app->post('/planejamento', PlanejamentoController::class . ':insert'); 
	$app->put('/planejamento', PlanejamentoController::class . ':update');  
	$app->delete('/planejamento/{id}', PlanejamentoController::class . ':delete');
	$app->delete('/planejamentoFinalizar/{id}', PlanejamentoController::class . ':planejamentoFinalizar');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\PlanejamentoUsuarioController;

$app->group('', function() use ($app) {
	$app->get('/planejamentoUsuario', PlanejamentoUsuarioController::class . ':getAll'); 
	$app->get('/planejamentoUsuario/{id}', PlanejamentoUsuarioController::class . ':getById'); 
	$app->post('/planejamentoUsuario', PlanejamentoUsuarioController::class . ':insert'); 
	$app->put('/planejamentoUsuario', PlanejamentoUsuarioController::class . ':update');  
	$app->delete('/planejamentoUsuario/{id}', PlanejamentoUsuarioController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\PlanejamentoColaboracaoController;

$app->group('', function() use ($app) {
	$app->get('/planejamentoColaboracao', PlanejamentoColaboracaoController::class . ':getAll'); 
	$app->get('/planejamentoColaboracao/{id}', PlanejamentoColaboracaoController::class . ':getById'); 
	$app->get('/planejamentoColaboracaoVerificarEdit/{id}', PlanejamentoColaboracaoController::class . ':verificarEditByIdPlanejamento');
	$app->post('/planejamentoColaboracao', PlanejamentoColaboracaoController::class . ':insert'); 
	$app->put('/planejamentoColaboracao', PlanejamentoColaboracaoController::class . ':update');  
	$app->delete('/planejamentoColaboracao/{id}', PlanejamentoColaboracaoController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\PerfilController;

$app->group('', function() use ($app) {
	$app->get('/perfil', PerfilController::class . ':getAll'); 
	$app->get('/perfil/{id}', PerfilController::class . ':getById'); 
	$app->post('/perfil', PerfilController::class . ':insert'); 
	$app->put('/perfil', PerfilController::class . ':update');  
	$app->delete('/perfil/{id}', PerfilController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\SituacaoController;

$app->group('', function() use ($app) {
	$app->get('/situacao', SituacaoController::class . ':getAll'); 
	$app->get('/situacao/{id}', SituacaoController::class . ':getById'); 
	$app->post('/situacao', SituacaoController::class . ':insert'); 
	$app->put('/situacao', SituacaoController::class . ':update');  
	$app->delete('/situacao/{id}', SituacaoController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\TipoController;

$app->group('', function() use ($app) {
	$app->get('/tipo', TipoController::class . ':getAll'); 
	$app->get('/tipo/{id}', TipoController::class . ':getById'); 
	$app->post('/tipo', TipoController::class . ':insert'); 
	$app->put('/tipo', TipoController::class . ':update');  
	$app->delete('/tipo/{id}', TipoController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\EstadoController;

$app->group('', function() use ($app) {
	$app->get('/estado', EstadoController::class . ':getAll'); 
	$app->get('/estado/{id}', EstadoController::class . ':getById'); 
	$app->post('/estado', EstadoController::class . ':insert'); 
	$app->put('/estado', EstadoController::class . ':update');  
	$app->delete('/estado/{id}', EstadoController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\HistoricoController;

$app->group('', function() use ($app) {
	$app->get('/historico', HistoricoController::class . ':getAll'); 
	$app->get('/historico/{id}', HistoricoController::class . ':getById'); 
	$app->post('/historico', HistoricoController::class . ':insert'); 
	$app->put('/historico', HistoricoController::class . ':update');  
	$app->delete('/historico/{id}', HistoricoController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\ComentarioController;

$app->group('', function() use ($app) {
	$app->get('/comentario', ComentarioController::class . ':getAll'); 
	$app->get('/comentario/{id}', ComentarioController::class . ':getById'); 
	$app->get('/comentarioColaboracao/{id}', ComentarioController::class . ':getByIdColaboracao'); 
	$app->post('/comentario', ComentarioController::class . ':insert'); 
	$app->put('/comentario', ComentarioController::class . ':update');  
	$app->delete('/comentario/{id}', ComentarioController::class . ':delete');
})->add(basicAuth());

// ===========================================================================

use App\Controllers\EnderecoController;

$app->group('', function() use ($app) {
	$app->get('/endereco/usuario/{id}', EnderecoController::class . ':getAllUserId'); 

	$app->get('/endereco', EnderecoController::class . ':getAll'); 
	$app->get('/endereco/{id}', EnderecoController::class . ':getById'); 
	$app->post('/endereco', EnderecoController::class . ':insert'); 
	$app->put('/endereco', EnderecoController::class . ':update');  
	$app->delete('/endereco/{id}', EnderecoController::class . ':delete');
})->add(basicAuth());

// ===========================================================================
// ============================== CONFIGURAÇÕES ==============================
// ===========================================================================

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
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});

// ===========================================================================

$app->run();