<?php

namespace App\DAO;

use App\Models\ColaboracaoModel;

class ColaboracaoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbColaboracao';

    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(): array
    {
        $registros = $this->pdo
            ->query('select * from ' . $this->tabela . ';')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;
    }
    public function getAllByUser(int $id): array
    {
        $registros = $this->pdo
            ->query('select * from ' . $this->tabela . '
                    WHERE idUsuario = '.$id.';')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;
    }

    public function getAllNotIn(int $idTipo): array
    {
        $registros = $this->pdo
            ->query('SELECT * FROM tbColaboracao 
            WHERE id NOT IN (SELECT idColaboracao FROM tbPlanejamentoColaboracao) 
            AND idTipo = '.$idTipo.' AND idSituacao = 2;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;
    }

    // ========================== BUSCAR REGISTRO POR ID ==========================
    
    public function getByPlanejamento(int $id): array
    {   
        $registros = $this->pdo
            ->query("SELECT D.id, D.titulo, D.descricao, D.dataRegistro, D.latitude, D.longitude, D.rua, D.numero, D.bairro, D.complemento, D.cep, D.idCidade, D.idUsuario, D.idSituacao 
            FROM tbColaboracao D, tbPlanejamentoColaboracao CD 
            WHERE D.id = CD.idColaboracao AND CD.idPlanejamento = ".$id.";")
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;

    }
    public function getIdColaboracaosByPlanejamento(int $id): array
    {   
        $registros = $this->pdo
            ->query("SELECT D.id FROM tbColaboracao D, tbPlanejamentoColaboracao CD 
                WHERE D.id = CD.idColaboracao and CD.idPlanejamento = ".$id.";")
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;

    }
    public function getBySituacao(int $situacao): array
    {   
        $registro = $this->pdo
            ->query('select * from ' . $this->tabela . ' where idSituacao =' . $situacao . ';')
            ->fetchAll(\PDO::FETCH_ASSOC);

        return $registro;
    }
    public function getById(int $id): array
    {   
        $registro = $this->pdo
            ->query('select * from ' . $this->tabela . ' where id =' . $id . ';')
            ->fetch(\PDO::FETCH_ASSOC);

        return $registro;
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(ColaboracaoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :titulo, :descricao, :dataRegistro, :latitude, :longitude, :rua, :numero, :bairro, :complemento,
                :cep, :idCidade, :idUsuario, :idTipo, :idSituacao
            );');
        $statement->execute([
            'titulo' => $registro->getTitulo(),
            'descricao' => $registro->getDescricao(),
            'dataRegistro' => $registro->getDataRegistro(),
            'latitude' => $registro->getLatitude(),
            'longitude' => $registro->getLongitude(),
            'rua' => $registro->getRua(),
            'numero' => $registro->getNumero(),
            'bairro' => $registro->getBairro(),
            'complemento' => $registro->getComplemento(),
            'cep' => $registro->getCep(),
            'idCidade' => $registro->getIdCidade(),
            'idUsuario' => $registro->getIdUsuario(),
            'idTipo' => $registro->getIdTipo(),
            'idSituacao' => $registro->getIdSituacao()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(ColaboracaoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                titulo = :titulo, descricao = :descricao, dataRegistro = :dataRegistro, latitude = :latitude, longitude = :longitude, 
                rua = :rua, numero = :numero, bairro = :bairro, complemento = :complemento, cep = :cep, idCidade = :idCidade, 
                idUsuario = :idUsuario, idTipo = :idTipo, idSituacao = :idSituacao
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'titulo' => $registro->getTitulo(),
            'descricao' => $registro->getDescricao(),
            'dataRegistro' => $registro->getDataRegistro(),
            'latitude' => $registro->getLatitude(),
            'longitude' => $registro->getLongitude(),
            'rua' => $registro->getRua(),
            'numero' => $registro->getNumero(),
            'bairro' => $registro->getBairro(),
            'complemento' => $registro->getComplemento(),
            'cep' => $registro->getCep(),
            'idCidade' => $registro->getIdCidade(),
            'idUsuario' => $registro->getIdUsuario(),
            'idTipo' => $registro->getIdTipo(),
            'idSituacao' => $registro->getIdSituacao()
        ]);
    }

    // ========================== DELETAR REGISTRO ==========================

    public function delete(int $id): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                idSituacao = :idSituacao
                where id = :id
            ;');
        $statement->execute([
            'id' => $id,
            'idSituacao' => 5
        ]);
    }

    public function trocarSituacao(int $id, int $situacao): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                idSituacao = :idSituacao
                where id = :id
            ;');
        $statement->execute([
            'id' => $id,
            'idSituacao' => $situacao
        ]);
    }

    // =======================================================================
}
