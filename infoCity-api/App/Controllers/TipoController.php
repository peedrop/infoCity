<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\TipoDAO;
use App\Models\TipoModel;

final class TipoController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new TipoDAO();  
        $registros = $registroDAO->getAll();
        $response = $response->withJson($registros);
        return $response;    
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================

    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new TipoDAO();
        $registro = $registroDAO->getById($id);
        $response = $response->withJson($registro);
        return $response;  
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new TipoDAO();
        $registro = new TipoModel;
        $registro
                ->setNome($data['nome']);
        $registroDAO->insert($registro);

        $response = $response->withJson($data);
        return $response;     
    }
    
    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new TipoDAO();
        $registro = new TipoModel;
        $registro
                ->setId($data['id'])
                ->setNome($data['nome']);
        $registroDAO->update($registro);

        $response = $response->withJson($data);
        return $response;   
    }
    
    // ========================== DELETAR REGISTRO ==========================
    
    public function delete(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new TipoDAO();
        $registroDAO->delete($id);
        $response = $response->withJson([
            'message' => 'Registro excluido com sucesso'
        ]);
        return $response; 
    }

    // =======================================================================
}