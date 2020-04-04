<?php 

namespace App\Models;

final class HistoricoModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $observacao;

    /**
     * @var string
     */
    private $dataRegistro;

    /**
     * @var int
     */
    private $idColaboracao;

    /**
     * @var int
     */
    private $idUsuario;

    /**
     * @var int
     */
    private $idSituacao;


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
     * @return HistoricoModel
     */
    public function setId(int $id): HistoricoModel
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return string
     */
    public function getObservacao(): string
    {
        return $this->observacao;
    }
    /**
     * @param string $observacao
     * @return HistoricoModel
     */
    public function setObservacao(string $observacao): HistoricoModel
    {
        $this->observacao = $observacao;
        return $this;
    }
    // =================================
    /**
     * @return string
     */
    public function getDataRegistro(): string
    {
        return $this->dataRegistro;
    }
    /**
     * @param string $dataRegistro
     * @return HistoricoModel
     */
    public function setDataRegistro(string $dataRegistro): HistoricoModel
    {
        $this->dataRegistro = $dataRegistro;
        return $this;
    }
    // =================================
    /**
     * @return int
     */
    public function getIdColaboracao(): int
    {
        return $this->idColaboracao;
    }
    /**
     * @param int $idColaboracao
     * @return HistoricoModel
     */
    public function setIdColaboracao(int $idColaboracao): HistoricoModel
    {
        $this->idColaboracao = $idColaboracao;
        return $this;
    }
    /**
     * @return int
     */
    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }
    /**
     * @param int $idUsuario
     * @return HistoricoModel
     */
    public function setIdUsuario(int $idUsuario): HistoricoModel
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }
    /**
     * @return int
     */
    public function getIdSituacao(): int
    {
        return $this->idSituacao;
    }
    /**
     * @param int $idSituacao
     * @return HistoricoModel
     */
    public function setIdSituacao(int $idSituacao): HistoricoModel
    {
        $this->idSituacao = $idSituacao;
        return $this;
    }
}