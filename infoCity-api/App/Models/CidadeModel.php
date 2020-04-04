<?php 

namespace App\Models;
use App\Models\EstadoModel;

final class CidadeModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var id
     */
    private $idEstado;

    /**
     * @var EstadoModel
     */
    private $estado;


    // ============== GET E SET ==============

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @param int $id
     * @return CidadeModel
     */
    public function setId(int $id): CidadeModel
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }
    /**
     * @param string $nome
     * @return CidadeModel
     */
    public function setNome(string $nome): CidadeModel
    {
        $this->nome = $nome;
        return $this;
    }
    /**
     * @return int
     */
    public function getIdEstado(): int
    {
        return $this->idEstado;
    }
    /**
     * @param int $id
     * @return CidadeModel
     */
    public function setIdEstado(int $idEstado): CidadeModel
    {
        $this->idEstado = $idEstado;
        return $this;
    }
    /**
     * @return EstadoModel
     */
    public function getEstado(): EstadoModel
    {
        return $this->estado;
    }
    /**
     * @param EstadoModel $estado
     * @return CidadeModel
     */
    public function setEstado(EstadoModel $estado): CidadeModel
    {
        $this->estado = $estado;
        return $this;
    }
}