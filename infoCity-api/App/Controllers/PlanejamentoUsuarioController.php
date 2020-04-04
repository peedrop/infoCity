<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\PlanejamentoUsuarioDAO;
use App\Models\PlanejamentoUsuarioModel;

final class PlanejamentoUsuarioController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new PlanejamentoUsuarioDAO();  
        $registros = $registroDAO->getAll();
        $response = $response->withJson($registros);
        return $response;    
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================

    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new PlanejamentoUsuarioDAO();
        $registro = $registroDAO->getById($id);
        $response = $response->withJson($registro);
        return $response;  
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new PlanejamentoUsuarioDAO();
        $registro = new PlanejamentoUsuarioModel;
        $registro
                ->setIdPlanejamento($data['idPlanejamento'])
                ->setIdUsuario($data['idUsuario']);
        $registroDAO->insert($registro);

        $response = $response->withJson($data);
        return $response;     
    }
    
    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new PlanejamentoUsuarioDAO();
        $registro = new PlanejamentoUsuarioModel;
        $registro
                ->setId($data['id'])
                ->setIdPlanejamento($data['idPlanejamento'])
                ->setIdUsuario($data['idUsuario']);
        $registroDAO->update($registro);

        $response = $response->withJson($data);
        return $response;   
    }
    
    // ========================== DELETAR REGISTRO ==========================
    
    public function delete(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new PlanejamentoUsuarioDAO();
        $registroDAO->delete($id);
        $response = $response->withJson([
            'message' => 'Registro excluido com sucesso'
        ]);
        return $response; 
    }

    // =======================================================================
}