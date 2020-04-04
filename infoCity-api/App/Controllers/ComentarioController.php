<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\ComentarioDAO;
use App\DAO\ColaboracaoDAO;
use App\DAO\UsuarioDAO;
use App\Models\ComentarioModel;

final class ComentarioController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new ComentarioDAO();  
        $registros = $registroDAO->getAll();
        //colocando registros no historico
        $colaboracaoDAO = new ColaboracaoDAO();  
        $usuarioDAO = new UsuarioDAO();   
        foreach ($registros as &$registro) {
            $registro['colaboracao'] = $colaboracaoDAO->getById($registro['idColaboracao']);
            $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
        }  
        //fim
        $response = $response->withJson($registros);
        return $response;    
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================
    
    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new ComentarioDAO();
        $registro = $registroDAO->getById($id);
        //colocando registros no historico
        $colaboracaoDAO = new ColaboracaoDAO();  
        $usuarioDAO = new UsuarioDAO();  
        $registro['colaboracao'] = $colaboracaoDAO->getById($registro['idColaboracao']);
        $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
        //fim
        $response = $response->withJson($registro);
        return $response;  
    }
    public function getByIdColaboracao(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new ComentarioDAO();
        $tem = $registroDAO->verificarSeTemComentario($id);
        
        $retorno['comentario'] = '';
        $retorno['avaliacao'] = 0;
        if($tem == 0){
            $response = $response->withJson($retorno);
            return $response; 
        }
        $registro = $registroDAO->getByIdColaboracao($id);
        $response = $response->withJson($registro);
        return $response; 
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new ComentarioDAO();
        $registro = new ComentarioModel;
        $registro
                ->setComentario($data['comentario'])
                ->setData($data['data'])
                ->setAvaliacao($data['avaliacao'])
                ->setIdUsuario($data['idUsuario'])
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
        $registroDAO = new ComentarioDAO();
        $registro = new ComentarioModel;
        $registro
                ->setId($data['id'])
                ->setComentario($data['comentario'])
                ->setData($data['data'])
                ->setAvaliacao($data['avaliacao'])
                ->setIdUsuario($data['idUsuario'])
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
        $registroDAO = new ComentarioDAO();
        $registroDAO->delete($id);
        $response = $response->withJson([
            'message' => 'Registro excluido com sucesso'
        ]);
        return $response; 
    }

    // =======================================================================
}