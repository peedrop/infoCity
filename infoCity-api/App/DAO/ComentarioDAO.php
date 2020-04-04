<?php

namespace App\DAO;

use App\Models\ComentarioModel;

class ComentarioDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbComentario';

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
    public function getByIdColaboracao(int $id): array
    {    
        $registro = $this->pdo
            ->query('select * from ' . $this->tabela . ' where idColaboracao =' . $id . ';')
            ->fetch(\PDO::FETCH_ASSOC);

        return $registro;
    }
    public function verificarSeTemComentario(int $id): int
    {   
        $registro = $this->pdo
            ->query('SELECT COUNT(idColaboracao) AS qnt FROM tbComentario 
            WHERE idColaboracao = ' . $id . ';')
            ->fetch(\PDO::FETCH_ASSOC);

        $qnt = +$registro['qnt'];

        return $qnt ;
    }

    // ========================== INSERIR REGISTRO ==========================

    public function insert(ComentarioModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :comentario, :data, :avaliacao, :idUsuario, :idColaboracao
            );');
        $statement->execute([
            'comentario' => $registro->getComentario(),
            'data' => $registro->getData(),
            'avaliacao' => $registro->getAvaliacao(),
            'idUsuario' => $registro->getIdUsuario(),
            'idColaboracao' => $registro->getIdColaboracao()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(ComentarioModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                comentario = :comentario, data = :data, avaliacao = :avaliacao, 
                idUsuario = :idUsuario, idColaboracao = :idColaboracao
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'comentario' => $registro->getComentario(),
            'data' => $registro->getData(),
            'avaliacao' => $registro->getAvaliacao(),
            'idUsuario' => $registro->getIdUsuario(),
            'idColaboracao' => $registro->getIdColaboracao()
        ]);
    }

    // ========================== DELETAR REGISTRO ==========================

    public function delete(int $id): void
    {
        $statement = $this->pdo
            ->prepare('delete from ' . $this->tabela . '
                where idColaboracao = :id;');
        $statement->execute([
            'id' => $id
        ]);
    }

    // =======================================================================
}
