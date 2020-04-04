<?php

namespace App\DAO;

use App\Models\UsuarioModel;

class UsuarioDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbUsuario';

    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(): array
    {
        $registros = $this->pdo
            ->query('select * from ' . $this->tabela . ';')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;
    }

    public function getAllCorporativo(int $idPlanejamento): array
    {
        $registros = $this->pdo
            ->query('select U.id, U.nome, U.email, U.senha, U.dataNascimento, U.sexo, U.flagSituacao, U.foto, U.idPerfil
            FROM ' . $this->tabela . ' U, tbPerfil 
            WHERE idPerfil = tbPerfil.id AND tbPerfil.nome = "Corporação"
            AND U.id NOT IN (SELECT idUsuario FROM tbPlanejamentoUsuario 
                            WHERE idPlanejamento = ' . $idPlanejamento . ' );')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;
    }
    
    public function getByColeta(int $id): array
    {
        $registros = $this->pdo
            ->query('SELECT U.id, U.nome, U.email, U.senha, U.dataNascimento, U.sexo, U.flagSituacao, U.foto, U.idPerfil 
            FROM tbUsuario U, tbPlanejamentoUsuario PU
            WHERE U.id = PU.idUsuario
            AND PU.idPlanejamento = ' . $id . ';')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;
    }
    public function getIdUsuarioByIdColeta(int $id): array
    {
        $registros = $this->pdo
            ->query('SELECT U.id
             FROM tbUsuario U, tbPlanejamentoUsuario PU
            WHERE U.id = PU.idUsuario
            AND PU.idPlanejamento = ' . $id . ';')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================

    public function getById(int $id): array
    {   
        $registro = $this->pdo
            ->query('select * from ' . $this->tabela . ' where id =' . $id . ';')
            ->fetch(\PDO::FETCH_ASSOC);

        return $registro;
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(UsuarioModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :nome, :email, :senha, :dataNascimento, :sexo, :flagSituacao, :foto, :idPerfil
            );');
        $statement->execute([
            'nome' => $registro->getNome(),
            'email' => $registro->getEmail(),
            'senha' => $registro->getSenha(),
            'dataNascimento' => $registro->getDataNascimento(),
            'sexo' => $registro->getSexo(),
            'flagSituacao' => $registro->getFlagSituacao(),
            'foto' => $registro->getFoto(),
            'idPerfil' => $registro->getIdPerfil()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(UsuarioModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                nome = :nome, email = :email, senha = :senha, dataNascimento = :dataNascimento, sexo = :sexo, 
                flagSituacao = :flagSituacao, foto = :foto, idPerfil = :idPerfil
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'nome' => $registro->getNome(),
            'email' => $registro->getEmail(),
            'senha' => $registro->getSenha(),
            'dataNascimento' => $registro->getDataNascimento(),
            'sexo' => $registro->getSexo(),
            'flagSituacao' => $registro->getFlagSituacao(),
            'foto' => $registro->getFoto(),
            'idPerfil' => $registro->getIdPerfil()
        ]);
    }

    // ========================== DELETAR REGISTRO ==========================

    public function delete(int $id): void
    {
        $statement = $this->pdo
            ->prepare('delete from ' . $this->tabela . '
                where id = :id;');
        $statement->execute([
            'id' => $id
        ]);
    }

    // =======================================================================
}

