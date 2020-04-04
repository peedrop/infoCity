<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\ColaboracaoDAO;

use App\Controllers\CidadeController;
use App\Controllers\UsuarioController;
use App\DAO\CidadeDAO;
use App\DAO\EstadoDAO;
use App\DAO\UsuarioDAO;
use App\DAO\TipoDAO;
use App\DAO\SituacaoDAO;
use App\Models\ColaboracaoModel;

final class ColaboracaoController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================
    
    public function getAllByUser(Request $request, Response $response, array $args): Response
    {       
        $id = $args['id'];
        $registroDAO = new ColaboracaoDAO(); 
        $registros = $registroDAO->getAllByUser($id); 

        if (count($registros) > 0){

            $cidadeDAO = new CidadeDAO();  
            $estadoDAO = new EstadoDAO();  
            foreach ($registros as &$registro) {
                $registro['cidade'] = $cidadeDAO->getById($registro['idCidade']);
                $registro['cidade']['estado'] = $estadoDAO->getById($registro['cidade']['idEstado']);
            }
            //fim
            //colocando usuario no endereco
            $usuarioDAO = new UsuarioDAO();  
            foreach ($registros as &$registro) {
                $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
            }
            //fim
            //colocando tipo na colaboracao
            $tipoDAO = new TipoDAO();  
            foreach ($registros as &$registro) {
                $registro['tipo'] = $tipoDAO->getById($registro['idTipo']);
            }
            //fim
            //colocando situacao na colaboracao
            $situacaoDAO = new SituacaoDAO();  
            foreach ($registros as &$registro) {
                $registro['situacao'] = $situacaoDAO->getById($registro['idSituacao']);
            }
            //fim
        }

        $response = $response->withJson($registros);
        return $response;     
    }
    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new ColaboracaoDAO(); 
        $registros = $registroDAO->getAll(); 

        if (count($registros) > 0){

            $cidadeDAO = new CidadeDAO();  
            $estadoDAO = new EstadoDAO();  
            foreach ($registros as &$registro) {
                $registro['cidade'] = $cidadeDAO->getById($registro['idCidade']);
                $registro['cidade']['estado'] = $estadoDAO->getById($registro['cidade']['idEstado']);
            }
            //fim
            //colocando usuario no endereco
            $usuarioDAO = new UsuarioDAO();  
            foreach ($registros as &$registro) {
                $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
            }
            //fim
            //colocando tipo na colaboracao
            $tipoDAO = new TipoDAO();  
            foreach ($registros as &$registro) {
                $registro['tipo'] = $tipoDAO->getById($registro['idTipo']);
            }
            //fim
            //colocando situacao na colaboracao
            $situacaoDAO = new SituacaoDAO();  
            foreach ($registros as &$registro) {
                $registro['situacao'] = $situacaoDAO->getById($registro['idSituacao']);
            }
            //fim
        }

        $response = $response->withJson($registros);
        return $response;     
    }
    public function getBySituacao(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new ColaboracaoDAO();
        $registros = $registroDAO->getBySituacao($id);

        if (count($registros) > 0){

            $cidadeDAO = new CidadeDAO();  
            $estadoDAO = new EstadoDAO();  
            foreach ($registros as &$registro) {
                $registro['cidade'] = $cidadeDAO->getById($registro['idCidade']);
                $registro['cidade']['estado'] = $estadoDAO->getById($registro['cidade']['idEstado']);
            }
            //fim
            //colocando usuario no endereco
            $usuarioDAO = new UsuarioDAO();  
            foreach ($registros as &$registro) {
                $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
            }
            //fim
            //colocando tipo na colaboracao
            $tipoDAO = new TipoDAO();  
            foreach ($registros as &$registro) {
                $registro['tipo'] = $tipoDAO->getById($registro['idTipo']);
            }
            //fim
            //colocando situacao na colaboracao
            $situacaoDAO = new SituacaoDAO();  
            foreach ($registros as &$registro) {
                $registro['situacao'] = $situacaoDAO->getById($registro['idSituacao']);
            }
            //fim
        }

        $response = $response->withJson($registros);
        return $response;     
    }


    public function getAllNotIn(Request $request, Response $response, array $args): Response
    {   
        $idTipo = $args['idTipo'];
        $registroDAO = new ColaboracaoDAO(); 
        $registros = $registroDAO->getAllNotIn($idTipo); 

        if (count($registros) > 0){

            $cidadeDAO = new CidadeDAO();  
            $estadoDAO = new EstadoDAO();  
            foreach ($registros as &$registro) {
                $registro['cidade'] = $cidadeDAO->getById($registro['idCidade']);
                $registro['cidade']['estado'] = $estadoDAO->getById($registro['cidade']['idEstado']);
            }
            //fim
            //colocando usuario no endereco
            $usuarioDAO = new UsuarioDAO();  
            foreach ($registros as &$registro) {
                $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
            }
        }

        $response = $response->withJson($registros);
        return $response;     
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================
    
    
    public function getByPlanejamento(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new ColaboracaoDAO(); 
        $registros = $registroDAO->getByPlanejamento($id); 

        if (count($registros) > 0){

            $cidadeDAO = new CidadeDAO();  
            $estadoDAO = new EstadoDAO();  
            foreach ($registros as &$registro) {
                $registro['cidade'] = $cidadeDAO->getById($registro['idCidade']);
                $registro['cidade']['estado'] = $estadoDAO->getById($registro['cidade']['idEstado']);
            }
            //fim
            //colocando usuario na colaboracao
            $usuarioDAO = new UsuarioDAO();  
            foreach ($registros as &$registro) {
                $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
            }
            //colocando situacao na colaboracao
            $situacaoDAO = new SituacaoDAO();  
            foreach ($registros as &$registro) {
                $registro['situacao'] = $situacaoDAO->getById($registro['idSituacao']);
            }
        }

        $response = $response->withJson($registros);
        return $response;
    }

    public function getIdColaboracaosByPlanejamento(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new ColaboracaoDAO(); 
        $registros = $registroDAO->getIdColaboracaosByPlanejamento($id); 
        $var = array();

        foreach ($registros as &$registro) {
            array_push($var, $registro['id']);
        }


        $response = $response->withJson($var);
        return $response;
    }

    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new ColaboracaoDAO();
        $registro = $registroDAO->getById($id);
        //colocando cidade na colaboracao
        $cidadeDAO = new CidadeDAO();
        $estadoDAO = new EstadoDAO();  
        $registro['cidade'] = $cidadeDAO->getById($registro['idCidade']);
        $registro['cidade']['estado'] = $estadoDAO->getById($registro['cidade']['idEstado']);
        //fim
        //colocando usuario na colaboracao
        $usuarioDAO = new UsuarioDAO();  
        $registro['usuario'] = $usuarioDAO->getById($registro['idUsuario']);
        //fim
        //colocando tipo na colaboracao
        $tipoDAO = new TipoDAO();  
        $registro['tipo'] = $tipoDAO->getById($registro['idTipo']);
        //fim
        //colocando situacao na colaboracao
        $situacaoDAO = new SituacaoDAO();  
        $registro['situacao'] = $situacaoDAO->getById($registro['idSituacao']);
        //fim
        $response = $response->withJson($registro);
        return $response;  
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new ColaboracaoDAO();
        $registro = new ColaboracaoModel;
        $registro
                ->setTitulo($data['titulo'])
                ->setDescricao($data['descricao'])
                ->setDataRegistro($data['dataRegistro'])
                ->setLatitude($data['latitude'])
                ->setLongitude($data['longitude'])
                ->setRua($data['rua'])
                ->setNumero($data['numero'])
                ->setBairro($data['bairro'])
                ->setComplemento($data['complemento'])
                ->setCep($data['cep'])
                ->setIdCidade($data['idCidade'])
                ->setIdUsuario($data['idUsuario'])
                ->setIdTipo($data['idTipo'])
                ->setIdSituacao($data['idSituacao']);
        $registroDAO->insert($registro);

        $response = $response->withJson($data);
        return $response;    
    }
    
    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new ColaboracaoDAO();
        $registro = new ColaboracaoModel;
        $registro
                ->setId($data['id'])
                ->setTitulo($data['titulo'])
                ->setDescricao($data['descricao'])
                ->setDataRegistro($data['dataRegistro'])
                ->setLatitude($data['latitude'])
                ->setLongitude($data['longitude'])
                ->setRua($data['rua'])
                ->setNumero($data['numero'])
                ->setBairro($data['bairro'])
                ->setComplemento($data['complemento'])
                ->setCep($data['cep'])
                ->setIdCidade($data['idCidade'])
                ->setIdUsuario($data['idUsuario'])
                ->setIdTipo($data['idTipo'])
                ->setIdSituacao($data['idSituacao']);
        $registroDAO->update($registro);

        $response = $response->withJson($data);
        return $response;   
    }
    
    // ========================== DELETAR REGISTRO ==========================
    
    public function delete(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new ColaboracaoDAO();
        $registroDAO->delete($id);
        $response = $response->withJson([
            'message' => 'Registro excluido com sucesso'
        ]);
        return $response; 
    }

    public function trocarSituacao(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $situacao = $args['situacao'];
        $registroDAO = new ColaboracaoDAO();
        $registroDAO->trocarSituacao($id, $situacao);
        $response = $response->withJson([
            'message' => 'Situação trocada com sucesso'
        ]);
        return $response; 
    }

    // =======================================================================
}