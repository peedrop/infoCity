<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\PlanejamentoDAO;
use App\DAO\TipoDAO;
use App\Models\PlanejamentoModel;

final class PlanejamentoController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new PlanejamentoDAO();  
        $registros = $registroDAO->getAll();
        //colocando tipo no planejamento
        $tipoDAO = new TipoDAO();  
        foreach ($registros as &$registro) 
            $registro['tipo'] = $tipoDAO->getById($registro['idTipo']);
        //fim
        $response = $response->withJson($registros);
        return $response;    
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================

    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new PlanejamentoDAO();
        $registro = $registroDAO->getById($id);
        //colocando tipo no planejamento
        $tipoDAO = new TipoDAO(); 
        $registro['tipo'] = $tipoDAO->getById($registro['idTipo']);
        //fim 
        $response = $response->withJson($registro);
        return $response;  
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new PlanejamentoDAO();
        $id = $registroDAO->proximoId();
        $data['id'] = $id;
        $registro = new PlanejamentoModel;
        $registro
                ->setDataRegistro($data['dataRegistro'])
                ->setHoraInicio($data['horaInicio'])
                ->setHoraTermino($data['horaTermino'])
                ->setObservacao($data['observacao'])
                ->setFlagSituacao($data['flagSituacao'])
                ->setDistancia($data['distancia'])
                ->setIdTipo($data['idTipo']);
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
        $registroDAO = new PlanejamentoDAO();
        $registro = new PlanejamentoModel;
        $registro
                ->setId($data['id'])
                ->setDataRegistro($data['dataRegistro'])
                ->setHoraInicio($data['horaInicio'])
                ->setHoraTermino($data['horaTermino'])
                ->setObservacao($data['observacao'])
                ->setFlagSituacao($data['flagSituacao'])
                ->setDistancia($data['distancia'])
                ->setIdTipo($data['idTipo']);
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
        $registroDAO = new PlanejamentoDAO();
        $registroDAO->delete($id);
        $response = $response->withJson([
            'message' => 'Registro excluido com sucesso'
        ]);
        return $response; 
    }
    public function planejamentoFinalizar(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new PlanejamentoDAO();
        $registroDAO->planejamentoFinalizar($id);
        $response = $response->withJson([
            'message' => 'Finalizado com sucesso'
        ]);
        return $response; 
    }
    
    // =======================================================================
}