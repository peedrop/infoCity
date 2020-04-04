<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\EnderecoDAO;
use App\DAO\CidadeDAO;
use App\DAO\EstadoDAO;
use App\DAO\UsuarioDAO;
use App\Models\EnderecoModel;

final class EnderecoController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new EnderecoDAO(); 
        $registros = $registroDAO->getAll(); 

        if (count($registros) > 0){
            //colocando cidade no endereco
            $cidadeDAO = new CidadeDAO();  
            $estadoDAO = new EstadoDAO();  
            foreach ($registros as &$registro){
                $registro['cidade'] = $cidadeDAO->getById($registro['idCidade']);
                $registro['cidade']['estado'] = $estadoDAO->getById($registro['cidade']['idEstado']);
                //converter latitude e longitude
                $registro['latitude'] = floatval ($registro['latitude']);
                $registro['longitude'] = floatval ($registro['longitude']);
            }
            //fim
            //colocando usuario no endereco
            $usuarioDAO = new UsuarioDAO();  
            foreach ($registros as &$registro) 
                $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
            //fim
        }

        $response = $response->withJson($registros);
        return $response;     
    }

    // ========================== PEGAR TODOS REGISTROS POR ID USER ==========================

    public function getAllUserId(Request $request, Response $response, array $args): Response
    {   
        $idUser = $args['id'];
        $registroDAO = new EnderecoDAO(); 
        $registros = $registroDAO->getAllUserId($idUser); 
        
        if (count($registros) > 0){
            //colocando cidade no endereco
            $cidadeDAO = new CidadeDAO();  
            $estadoDAO = new EstadoDAO();  
            foreach ($registros as &$registro){
                $registro['cidade'] = $cidadeDAO->getById($registro['idCidade']);
                $registro['cidade']['estado'] = $estadoDAO->getById($registro['cidade']['idEstado']);
                //converter latitude e longitude
                $registro['latitude'] = floatval ($registro['latitude']);
                $registro['longitude'] = floatval ($registro['longitude']);
            }
            //fim
            //colocando usuario no endereco
            $usuarioDAO = new UsuarioDAO();  
            foreach ($registros as &$registro) 
                $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
            //fim

            $response = $response->withJson($registros);
            return $response;  
        }
        
        $response = $response->withJson($registros);
        return $response;     
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================

    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new EnderecoDAO();
        $registro = $registroDAO->getById($id);
        //colocando cidade no endereco
        $cidadeDAO = new CidadeDAO();
        $estadoDAO = new EstadoDAO();  
        $registro['cidade'] = $cidadeDAO->getById($registro['idCidade']);
        $registro['cidade']['estado'] = $estadoDAO->getById($registro['cidade']['idEstado']);
        //converter latitude e longitude
        $registro['latitude'] = floatval ($registro['latitude']);
        $registro['longitude'] = floatval ($registro['longitude']);
        //fim
        //colocando usuario no endereco
        $usuarioDAO = new UsuarioDAO();  
        $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
        //fim
        $response = $response->withJson($registro);
        return $response;  
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new EnderecoDAO();
        $registro = new EnderecoModel;
        $registro
                ->setLatitude($data['latitude'])
                ->setLongitude($data['longitude'])
                ->setRua($data['rua'])
                ->setNumero($data['numero'])
                ->setBairro($data['bairro'])
                ->setComplemento($data['complemento'])
                ->setCep($data['cep'])
                ->setIdCidade($data['idCidade'])
                ->setIdUsuario($data['idUsuario']);
        $registroDAO->insert($registro);
        $response = $response->withJson($data);
        return $response;    
    }
    
    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new EnderecoDAO();
        $registro = new EnderecoModel;
        $registro
                ->setId($data['id'])
                ->setLatitude($data['latitude'])
                ->setLongitude($data['longitude'])
                ->setRua($data['rua'])
                ->setNumero($data['numero'])
                ->setBairro($data['bairro'])
                ->setComplemento($data['complemento'])
                ->setCep($data['cep'])
                ->setIdCidade($data['idCidade'])
                ->setIdUsuario($data['idUsuario']);
        $registroDAO->update($registro);
        $response = $response->withJson($data);
        return $response;   
    }
    
    // ========================== DELETAR REGISTRO ==========================
    
    public function delete(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new EnderecoDAO();
        $registroDAO->delete($id);
        $response = $response->withJson([
            'message' => 'Registro excluido com sucesso'
        ]);
        return $response; 
    }

    // =======================================================================
}