<?php

namespace App\DAO;

use App\Models\CidadeModel;

class CidadeDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbCidade';

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

    public function insert(CidadeModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :nome, :idEstado
            );');
        $statement->execute([
            'nome' => $registro->getNome(),
            'idEstado' => $registro->getIdEstado()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(CidadeModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                nome = :nome, idEstado = :idEstado
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'nome' => $registro->getNome(),
            'idEstado' => $registro->getIdEstado()
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
