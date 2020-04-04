<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\HistoricoDAO;
use App\DAO\ColaboracaoDAO;
use App\DAO\UsuarioDAO;
use App\DAO\SituacaoDAO;
use App\Models\HistoricoModel;

final class HistoricoController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new HistoricoDAO();  
        $registros = $registroDAO->getAll();
        //colocando registros no historico
        $colaboracaoDAO = new ColaboracaoDAO();  
        $usuarioDAO = new UsuarioDAO();  
        $situacaoDAO = new SituacaoDAO();  
        foreach ($registros as &$registro) {
            $registro['colaboracao'] = $colaboracaoDAO->getById($registro['idColaboracao']);
            $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
            $registro['situacao'] = $situacaoDAO->getById($registro['idSituacao']);
        }  
        //fim
        $response = $response->withJson($registros);
        return $response;    
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================

    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new HistoricoDAO();
        $registro = $registroDAO->getById($id);
        //colocando registros no historico
        $colaboracaoDAO = new ColaboracaoDAO();  
        $usuarioDAO = new UsuarioDAO();  
        $situacaoDAO = new SituacaoDAO(); 
        $registro['colaboracao'] = $colaboracaoDAO->getById($registro['idColaboracao']);
        $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
        $registro['situacao'] = $situacaoDAO->getById($registro['idSituacao']);
        //fim
        $response = $response->withJson($registro);
        return $response;  
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new HistoricoDAO();
        $registro = new HistoricoModel;
        $registro
                ->setObservacao($data['observacao'])
                ->setDataRegistro($data['dataRegistro'])
                ->setIdColaboracao($data['idColaboracao'])
                ->setIdUsuario($data['idUsuario'])
                ->setIdSituacao($data['idSituacao']);
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
        $registroDAO = new HistoricoDAO();
        $registro = new HistoricoModel;
        $registro
                ->setId($data['id'])
                ->setObservacao($data['observacao'])
                ->setDataRegistro($data['dataRegistro'])
                ->setIdColaboracao($data['idColaboracao'])
                ->setIdUsuario($data['idUsuario'])
                ->setIdSituacao($data['idSituacao']);
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
        $registroDAO = new HistoricoDAO();
        $registroDAO->delete($id);
        $response = $response->withJson([
            'message' => 'Registro excluido com sucesso'
        ]);
        return $response; 
    }

    // =======================================================================
}