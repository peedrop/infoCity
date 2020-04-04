<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\PlanejamentoColaboracaoDAO;
use App\Models\PlanejamentoColaboracaoModel;

final class PlanejamentoColaboracaoController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new PlanejamentoColaboracaoDAO();  
        $registros = $registroDAO->getAll();
        $response = $response->withJson($registros);
        return $response;    
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================

    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new PlanejamentoColaboracaoDAO();
        $registro = $registroDAO->getById($id);
        $response = $response->withJson($registro);
        return $response;  
    }
    public function verificarEditByIdPlanejamento(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new PlanejamentoColaboracaoDAO();
        $qnt = $registroDAO->verificarEditByIdPlanejamento($id);
        $response = $response->withJson($qnt);
        return $response;  
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new PlanejamentoColaboracaoDAO();
        $registro = new PlanejamentoColaboracaoModel;
        $registro
                ->setDataRealizacao($data['dataRealizacao'])
                ->setObservacao($data['observacao'])
                ->setIdPlanejamento($data['idPlanejamento'])
                ->setIdColaboracao($data['idColaboracao']);
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
        $registroDAO = new PlanejamentoColaboracaoDAO();
        $registro = new PlanejamentoColaboracaoModel;
        $registro
                ->setId($data['id'])
                ->setDataRealizacao($data['dataRealizacao'])
                ->setObservacao($data['observacao'])
                ->setIdPlanejamento($data['idPlanejamento'])
                ->setIdColaboracao($data['idColaboracao']);
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
        $registroDAO = new PlanejamentoColaboracaoDAO();
        $registroDAO->delete($id);
        $response = $response->withJson([
            'message' => 'Registro excluido com sucesso'
        ]);
        return $response; 
    }

    // =======================================================================
}