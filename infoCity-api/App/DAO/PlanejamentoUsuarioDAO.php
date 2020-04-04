<?php

namespace App\DAO;

use App\Models\PlanejamentoUsuarioModel;

class PlanejamentoUsuarioDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbPlanejamentoUsuario';

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

    public function insert(PlanejamentoUsuarioModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :idPlanejamento, :idUsuario
            );');
        $statement->execute([
            'idPlanejamento' => $registro->getIdPlanejamento(),
            'idUsuario' => $registro->getIdUsuario()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(PlanejamentoUsuarioModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                idPlanejamento = :idPlanejamento, idUsuario = :idUsuario
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'idPlanejamento' => $registro->getIdPlanejamento(),
            'idUsuario' => $registro->getIdUsuario()
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
