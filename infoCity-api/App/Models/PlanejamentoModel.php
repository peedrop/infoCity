<?php 

namespace App\Models;

use App\Models\TipoModel;

final class PlanejamentoModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $dataRegistro;

    /**
     * @var string
     */
    private $horaInicio;

    /**
     * @var string
     */
    private $horaTermino;

    /**
     * @var string
     */
    private $observacao;

    /**
     * @var int
     */
    private $flagSituacao;

    /**
     * @var float
     */
    private $distancia;

    /**
     * @var int
     */
    private $idTipo;

    /**
     * @var TipoModel
     */
    private $tipo;


    // ============== GET E SET ==============


    // ===============   ID ===============
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @param int $id
     * @return PlanejamentoModel
     */
    public function setId(int $id): PlanejamentoModel
    {
        $this->id = $id;
        return $this;
    }


    // ===============   DATA REGISTRO ===============
    /**
     * @return string
     */
    public function getDataRegistro(): string
    {
        return $this->dataRegistro;
    }
    /**
     * @param string $dataRegistro
     * @return PlanejamentoModel
     */
    public function setDataRegistro(string $dataRegistro): PlanejamentoModel
    {
        $this->dataRegistro = $dataRegistro;
        return $this;
    }



    // ===============   HORA INICIO ===============
    /**
     * @return string
     */
    public function getHoraInicio(): string
    {
        return $this->horaInicio;
    }
    /**
     * @param string $horaInicio
     * @return PlanejamentoModel
     */
    public function setHoraInicio(string $horaInicio): PlanejamentoModel
    {
        $this->horaInicio = $horaInicio;
        return $this;
    }



    // ===============   HORA TERMINO ===============
    /**
     * @return string
     */
    public function getHoraTermino(): string
    {
        return $this->horaTermino;
    }
    /**
     * @param string $horaTermino
     * @return PlanejamentoModel
     */
    public function setHoraTermino(string $horaTermino): PlanejamentoModel
    {
        $this->horaTermino = $horaTermino;
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
     * @return PlanejamentoModel
     */
    public function setObservacao(string $observacao): PlanejamentoModel
    {
        $this->observacao = $observacao;
        return $this;
    }





    // ===============   SITUAÇÃO ===============
    /**
     * @return int
     */
    public function getFlagSituacao(): int
    {
        return $this->flagSituacao;
    }
    /**
     * @param int $flagSituacao
     * @return PlanejamentoModel
     */
    public function setFlagSituacao(int $flagSituacao): PlanejamentoModel
    {
        $this->flagSituacao = $flagSituacao;
        return $this;
    }


    // ===============   DISTANCIA ===============
    /**
     * @return float
     */
    public function getDistancia(): float
    {
        return $this->distancia;
    }
    /**
     * @param float $distancia
     * @return PlanejamentoModel
     */
    public function setDistancia(float $distancia): PlanejamentoModel
    {
        $this->distancia = $distancia;
        return $this;
    }

    // ===============   ID TIPO ===============
    /**
     * @return int
     */
    public function getIdTipo(): int
    {
        return $this->idTipo;
    }
    /**
     * @param int $id
     * @return PlanejamentoModel
     */
    public function setIdTipo(int $idTipo): PlanejamentoModel
    {
        $this->idTipo = $idTipo;
        return $this;
    }

    // ===============  TIPO ===============
    /**
     * @return TipoModel
     */
    public function getTipo(): TipoModel
    {
        return $this->tipo;
    }
    /**
     * @param TipoModel $tipo
     * @return ColaboracaoModel
     */
    public function setTipo(TipoModel $tipo): ColaboracaoModel
    {
        $this->tipo = $tipo;
        return $this;
    }


}