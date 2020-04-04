<?php

namespace App\DAO;

use App\Models\PlanejamentoColaboracaoModel;

class PlanejamentoColaboracaoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbPlanejamentoColaboracao';

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
    public function verificarEditByIdPlanejamento(int $id): int
    {   
        $registro = $this->pdo
            ->query('SELECT COUNT(idPlanejamento) AS qnt 
            FROM ' . $this->tabela . ' 
            WHERE idPlanejamento = ' . $id . ';')
            ->fetch(\PDO::FETCH_ASSOC);

        $qnt = +$registro['qnt'];

        return $qnt ;
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(PlanejamentoColaboracaoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :dataRealizacao, :observacao, :idPlanejamento, :idColaboracao
            );');
        $statement->execute([
            'dataRealizacao' => $registro->getDataRealizacao(),
            'observacao' => $registro->getObservacao(),
            'idPlanejamento' => $registro->getIdPlanejamento(),
            'idColaboracao' => $registro->getIdColaboracao()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(PlanejamentoColaboracaoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                dataRealizacao = :dataRealizacao, observacao = :observacao, idPlanejamento = :idPlanejamento, idColaboracao = :idColaboracao
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'dataRealizacao' => $registro->getDataRealizacao(),
            'observacao' => $registro->getObservacao(),
            'idPlanejamento' => $registro->getIdPlanejamento(),
            'idColaboracao' => $registro->getIdColaboracao()
        ]);
    }

    // ========================== DELETAR REGISTRO ==========================

    public function delete(int $id): void
    {
        $statement = $this->pdo
            ->prepare('delete from ' . $this->tabela . '
                where idPlanejamento = :id;');
        $statement->execute([
            'id' => $id
        ]);
    }

    // =======================================================================
}
