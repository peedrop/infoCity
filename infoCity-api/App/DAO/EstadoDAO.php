<?php

namespace App\DAO;

use App\Models\EstadoModel;

class EstadoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbEstado';

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

    public function insert(EstadoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :nome, :sigla
            );');
        $statement->execute([
            'nome' => $registro->getNome(),
            'sigla' => $registro->getSigla()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(EstadoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                nome = :nome, sigla = :sigla
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'nome' => $registro->getNome(),
            'sigla' => $registro->getSigla()
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
