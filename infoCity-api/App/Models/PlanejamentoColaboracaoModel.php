<?php 

namespace App\Models;

final class PlanejamentoColaboracaoModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $dataRealizacao;

    /**
     * @var int
     */
    private $observacao;

    /**
     * @var int
     */
    private $idPlanejamento;

    /**
     * @var int
     */
    private $idColaboracao;


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
     * @return PlanejamentoColaboracaoModel
     */
    public function setId(int $id): PlanejamentoColaboracaoModel
    {
        $this->id = $id;
        return $this;
    }


// ===============================================


    /**
     * @return string
     */
    public function getDataRealizacao(): string
    {
        return $this->dataRealizacao;
    }
    /**
     * @param string $dataRealizacao
     * @return PlanejamentoColaboracaoModel
     */
    public function setDataRealizacao(string $dataRealizacao): PlanejamentoColaboracaoModel
    {
        $this->dataRealizacao = $dataRealizacao;
        return $this;
    }



// ===============   OBSERVAÇÃO ===============
    /**
     * @return string
     */
    public function getObservacao(): string
    {
        return $this->observacao;
    }
    /**
     * @param string $observacao
     * @return PlanejamentoColaboracaoModel
     */
    public function setObservacao(string $observacao): PlanejamentoColaboracaoModel
    {
        $this->observacao = $observacao;
        return $this;
    }


// ==============================================

    /**
     * @return int
     */
    public function getIdPlanejamento(): int
    {
        return $this->idPlanejamento;
    }
    /**
     * @param int $idPlanejamento
     * @return PlanejamentoColaboracaoModel
     */
    public function setIdPlanejamento(int $idPlanejamento): PlanejamentoColaboracaoModel
    {
        $this->idPlanejamento = $idPlanejamento;
        return $this;
    }


// ===============================================


    /**
     * @return int
     */
    public function getIdColaboracao(): int
    {
        return $this->idColaboracao;
    }
    /**
     * @param int $idColaboracao
     * @return PlanejamentoColaboracaoModel
     */
    public function setIdColaboracao(int $idColaboracao): PlanejamentoColaboracaoModel
    {
        $this->idColaboracao = $idColaboracao;
        return $this;
    }
}