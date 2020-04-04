<?php 

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\UsuarioDAO;
use App\DAO\PerfilDAO;
use App\Models\UsuarioModel;
use function src\logins;

final class UsuarioController
{   
    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(Request $request, Response $response, array $args): Response
    {   
        $registroDAO = new UsuarioDAO();  
        $registros = $registroDAO->getAll();
        //colocando perfil no usuario
        $perfilDAO = new PerfilDAO();  
        foreach ($registros as &$registro) 
            $registro['perfil'] = $perfilDAO->getById($registro['idPerfil']);
        //fim
        $response = $response->withJson($registros);
        return $response;    
    }

    public function getAllCorporativo(Request $request, Response $response, array $args): Response
    {   
        $idPlanejamento = $args['id'];
        $registroDAO = new UsuarioDAO();  
        $registros = $registroDAO->getAllCorporativo($idPlanejamento);
        //colocando perfil no usuario
        $perfilDAO = new PerfilDAO();  
        foreach ($registros as &$registro) 
            $registro['perfil'] = $perfilDAO->getById($registro['idPerfil']);
        //fim
        $response = $response->withJson($registros);
        return $response;    
    }
    public function getByColeta(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new UsuarioDAO();  
        $registros = $registroDAO->getByColeta($id);
        //colocando perfil no usuario
        $perfilDAO = new PerfilDAO();  
        foreach ($registros as &$registro) 
            $registro['perfil'] = $perfilDAO->getById($registro['idPerfil']);
        //fim
        $response = $response->withJson($registros);
        return $response;    
    }
    public function getIdUsuarioByIdColeta(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new UsuarioDAO();  
        $registros = $registroDAO->getIdUsuarioByIdColeta($id);
        $var = array();
        foreach ($registros as &$registro) {
            array_push($var, $registro['id']);
        }
        $response = $response->withJson($var);
        return $response;    
    }
    
    // ========================== BUSCAR REGISTRO POR ID ==========================

    public function getById(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];
        $registroDAO = new UsuarioDAO();
        $registro = $registroDAO->getById($id);
        //colocando perfil no usuario
        $perfilDAO = new PerfilDAO();  
        $registro['perfil'] = $perfilDAO->getById($registro['idPerfil']);
        //fim
        $response = $response->withJson($registro);
        return $response;  
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new UsuarioDAO();
        $registro = new UsuarioModel;
        $registro  
                ->setNome($data['nome'])
                ->setEmail($data['email'])
                ->setSenha($data['senha'])
                ->setDataNascimento($data['dataNascimento'])
                ->setSexo($data['sexo'])
                ->setFlagSituacao($data['flagSituacao'])
                ->setFoto($data['foto'])
                ->setIdPerfil($data['idPerfil']);
        $registroDAO->insert($registro);
        $response = $response->withJson($data);
        return $response;    
    }
    
    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $registroDAO = new UsuarioDAO();
        $registro = new UsuarioModel;
        $registro
                ->setId($data['id'])
                ->setNome($data['nome'])
                ->setEmail($data['email'])
                ->setSenha($data['senha'])
                ->setDataNascimento($data['dataNascimento'])
                ->setSexo($data['sexo'])
                ->setFlagSituacao($data['flagSituacao'])
                ->setFoto($data['foto'])
                ->setIdPerfil($data['idPerfil']);
        $registroDAO->update($registro);
        $response = $response->withJson($data);
        return $response;   
    }
    
    // ========================== DELETAR REGISTRO ==========================
    
    public function delete(Request $request, Response $response, array $args): Response
    {   
        $id = $args['id'];

        $registroDAO = new UsuarioDAO();
        $registro = $registroDAO->getById($id);

        echo $registro['flagSituacao'];
        if ($registro['flagSituacao'] == 1)
            $registro['flagSituacao'] = 0;
        else
            $registro['flagSituacao'] = 1;

        $user = new UsuarioModel;
        $user
                ->setId($registro['id'])
                ->setNome($registro['nome'])
                ->setEmail($registro['email'])
                ->setSenha($registro['senha'])
                ->setDataNascimento($registro['dataNascimento'])
                ->setSexo($registro['sexo'])
                ->setFlagSituacao($registro['flagSituacao'])
                ->setFoto($registro['foto'])
                ->setIdPerfil($registro['idPerfil']);
        $registroDAO->update($user);
        
        $response = $response->withJson([
            'message' => 'Situação alterada com sucesso' . $registro['flagSituacao']
        ]);
        return $response; 
    }

    // ========================== LOGIN ==========================

    public function login(Request $request, Response $response, array $args): Response
    {   
        $data = $request->getParsedBody();
        $usuarioDAO = new UsuarioDAO();  
        $usuarios = $usuarioDAO->getAll();

        foreach ($usuarios as $usuario) {
            if( ($usuario['email'] == $data['email']) && ($usuario['senha'] == $data['senha'])){
                //colocando perfil no usuario
                $perfilDAO = new PerfilDAO();  
                $usuario['perfil'] = $perfilDAO->getById($usuario['idPerfil']);
                //fim
                $response = $response->withJson($usuario);
                return $response;
            }
        }
        $response = $response->withJson('Erro: Email ou senha incorreto.');
        return $response;
    }

    // =======================================================================
}
