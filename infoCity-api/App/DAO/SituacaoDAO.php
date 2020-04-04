<?php

namespace App\DAO;

use App\Models\SituacaoModel;

class SituacaoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbSituacao';

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

    public function insert(SituacaoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :nome
            );');
        $statement->execute([
            'nome' => $registro->getNome()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(SituacaoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                nome = :nome
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'nome' => $registro->getNome()
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
