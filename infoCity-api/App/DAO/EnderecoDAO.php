<?php

namespace App\DAO;

use App\Models\EnderecoModel;

class EnderecoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tabela = 'tbEndereco';

    // ========================== PEGAR TODOS REGISTROS ==========================

    public function getAll(): array
    {
        $registros = $this->pdo
            ->query('select * from ' . $this->tabela . ';')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return $registros;
    }

    // ========================== PEGAR TODOS REGISTROS DE UM USER ==========================

    public function getAllUserId(int $idUsuario): array
    {
        $registros = $this->pdo
            ->query('select * from ' . $this->tabela . ' where idUsuario =' . $idUsuario . ';')
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

    public function insert(EnderecoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('insert into ' . $this->tabela . ' values(
                null, :latitude, :longitude, :rua, :numero, :bairro, :complemento, :cep, :idCidade, :idUsuario
            );');
        $statement->execute([
            'latitude' => $registro->getLatitude(),
            'longitude' => $registro->getLongitude(),
            'rua' => $registro->getRua(),
            'numero' => $registro->getNumero(),
            'bairro' => $registro->getBairro(),
            'complemento' => $registro->getComplemento(),
            'cep' => $registro->getCep(),
            'idCidade' => $registro->getIdCidade(),
            'idUsuario' => $registro->getIdUsuario()
        ]);
    }

    // ========================== ATUALIZAR REGISTRO ==========================

    public function update(EnderecoModel $registro): void
    {
        $statement = $this->pdo
            ->prepare('update ' . $this->tabela . ' set 
                latitude = :latitude, longitude = :longitude, rua = :rua, numero = :numero, bairro = :bairro, 
                complemento = :complemento, cep = :cep, idCidade = :idCidade, idUsuario = :idUsuario
                where id = :id
            ;');
        $statement->execute([
            'id' => $registro->getId(),
            'latitude' => $registro->getLatitude(),
            'longitude' => $registro->getLongitude(),
            'rua' => $registro->getRua(),
            'numero' => $registro->getNumero(),
            'bairro' => $registro->getBairro(),
            'complemento' => $registro->getComplemento(),
            'cep' => $registro->getCep(),
            'idCidade' => $registro->getIdCidade(),
            'idUsuario' => $registro->getIdUsuario()
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
