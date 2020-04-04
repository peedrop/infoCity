<?php

namespace App\DAO;

use App\Models\HistoricoModel;

class HistoricoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbHistorico';

    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(): array
    {
        $registros = $this->pdo
            ->query('select * from ' . $this->tabela . ';')
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

    public function insert(HistoricoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :observacao, :dataRegistro, :idColaboracao, :idUsuario, :idSituacao
            );');
        $statement->execute([
            'observacao' => $registro->getObservacao(),
            'dataRegistro' => $registro->getDataRegistro(),
            'idColaboracao' => $registro->getIdColaboracao(),
            'idUsuario' => $registro->getIdUsuario(),
            'idSituacao' => $registro->getIdSituacao()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(HistoricoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                observacao = :observacao, dataRegistro = :dataRegistro, idColaboracao = :idColaboracao, 
                idUsuario = :idUsuario, idSituacao = :idSituacao
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'observacao' => $registro->getObservacao(),
            'dataRegistro' => $registro->getDataRegistro(),
            'idColaboracao' => $registro->getIdColaboracao(),
            'idUsuario' => $registro->getIdUsuario(),
            'idSituacao' => $registro->getIdSituacao()
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
