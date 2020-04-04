<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\CidadeDAO;
use App\DAO\EstadoDAO;
use App\Models\CidadeModel;

final class CidadeController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new CidadeDAO(); 
        $registros = $registroDAO->getAll(); 
        //colocando estado na cidade
        $estadoDAO = new EstadoDAO();  
        foreach ($registros as &$registro) 
            $registro['estado'] = $estadoDAO->getById($registro['idEstado']);
        //fim
        $response = $response->withJson($registros);
        return $response;     
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================

    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new CidadeDAO();
        $registro = $registroDAO->getById($id);
        //colocando estado na cidade
        $estadoDAO = new EstadoDAO();
        $registro['estado'] = $estadoDAO->getById($registro['idEstado']);
        //fim
        $response = $response->withJson($registro);
        return $response;  
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new CidadeDAO();
        $registro = new CidadeModel;
        $registro
                ->setNome($data['nome'])
                ->setIdEstado($data['idEstado']);
        $registroDAO->insert($registro);
        /*
        $response = $response->withJson([
            'message' => 'Registro inserido com sucesso!'
        ]);*/
        $response = $response->withJson($data);
        return $response;   
    }
    
    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new CidadeDAO();
        $registro = new CidadeModel;
        $registro
                ->setId($data['id'])
                ->setNome($data['nome'])
                ->setIdEstado($data['idEstado']);
        $registroDAO->update($registro);
        /*
        $response = $response->withJson([
            'message' => 'Registro alterado com sucesso!'
        ]);*/
        $response = $response->withJson($data);
        return $response;   
    }
    
    // ========================== DELETAR REGISTRO ==========================
    
    public function delete(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new CidadeDAO();
        $registroDAO->delete($id);
        $response = $response->withJson([
            'message' => 'Registro excluido com sucesso'
        ]);
        return $response; 
    }

    // =======================================================================
}