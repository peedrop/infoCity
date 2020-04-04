<?php

namespace App\DAO;

use App\Models\PlanejamentoModel;

class PlanejamentoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbPlanejamento';

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

    public function insert(PlanejamentoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :dataRegistro, :horaInicio, :horaTermino, :observacao, :flagSituacao, :distancia, :idTipo
            );');
        $statement->execute([
            'dataRegistro' => $registro->getDataRegistro(),
            'horaInicio' => $registro->getHoraInicio(),
            'horaTermino' => $registro->getHoraTermino(),
            'observacao' => $registro->getObservacao(),
            'flagSituacao' => $registro->getFlagSituacao(),
            'distancia' => $registro->getDistancia(),
            'idTipo' => $registro->getIdTipo(),
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================
    
    public function planejamentoFinalizar(int $id): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                flagSituacao = :flagSituacao
                where id = :id
            ;');
        $statement->execute([
            'id' => $id,
            'flagSituacao' => 2,
        ]);
    }
    public function update(PlanejamentoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                dataRegistro = :dataRegistro, horaInicio = :horaInicio, horaTermino = :horaTermino, 
                observacao = :observacao, flagSituacao = :flagSituacao, distancia = :distancia, idTipo = :idTipo
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'dataRegistro' => $registro->getDataRegistro(),
            'horaInicio' => $registro->getHoraInicio(),
            'horaTermino' => $registro->getHoraTermino(),
            'observacao' => $registro->getObservacao(),
            'flagSituacao' => $registro->getFlagSituacao(),
            'distancia' => $registro->getDistancia(),
            'idTipo' => $registro->getIdTipo(),
        ]);
    }

    // ========================== DELETAR REGISTRO ==========================

    public function delete(int $id): void
    {   
        $statement = $this->pdo
            ->prepare('delete from tbPlanejamentoUsuario
                where idPlanejamento = :id;');
        $statement->execute([
            'id' => $id
        ]);

        $statement = $this->pdo
            ->prepare('delete from tbPlanejamentoColaboracao
                where idPlanejamento = :id;');
        $statement->execute([
            'id' => $id
        ]);

        $statement = $this->pdo
            ->prepare('delete from ' . $this->tabela . '
                where id = :id;');
        $statement->execute([
            'id' => $id
        ]);
    }

    // =======================================================================

    public function proximoId(): int
    {
        $dbname = getenv('infocity_dbname');
        $registro = $this->pdo
            ->query("SELECT AUTO_INCREMENT
                        FROM   information_schema.tables
                        WHERE  table_name = 'tbPlanejamento'
                        AND    table_schema = '" . $dbname . "';")
            ->fetch(\PDO::FETCH_ASSOC);

        $id = +$registro['AUTO_INCREMENT'];

        return $id;
    }
}
