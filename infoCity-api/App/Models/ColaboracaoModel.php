<?php 

namespace App\Models;

use App\Models\CidadeModel;
use App\Models\UsuarioModel;
use App\Models\TipoModel;
use App\Models\SituacaoModel;

final class ColaboracaoModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var string
     */
    private $dataRegistro;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var string
     */
    private $rua;

    /**
     * @var string
     */
    private $numero;

    /**
     * @var string
     */
    private $bairro;

    /**
     * @var string
     */
    private $complemento;

    /**
     * @var string
     */
    private $cep;

    /**
     * @var int
     */
    private $idCidade;

    /**
     * @var int
     */
    private $idUsuario;

    /**
     * @var int
     */
    private $idTipo;

    /**
     * @var int
     */
    private $idSituacao;

    /**
     * @var CidadeModel
     */
    private $cidade;

    /**
     * @var UsuarioModel
     */
    private $usuario;

    /**
     * @var TipoModel
     */
    private $tipo;

    /**
     * @var SituacaoModel
     */
    private $situacao;


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
     * @return ColaboracaoModel
     */
    public function setId(int $id): ColaboracaoModel
    {
        $this->id = $id;
        return $this;
    }
    // =================================
    /**
     * @return string
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    /**
     * @param string $titulo
     * @return ColaboracaoModel
     */
    public function setTitulo(string $titulo): ColaboracaoModel
    {
        $this->titulo = $titulo;
        return $this;
    }
    // =================================
    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }
    /**
     * @param string $descricao
     * @return ColaboracaoModel
     */
    public function setDescricao(string $descricao): ColaboracaoModel
    {
        $this->descricao = $descricao;
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
     * @return ColaboracaoModel
     */
    public function setDataRegistro(string $dataRegistro): ColaboracaoModel
    {
        $this->dataRegistro = $dataRegistro;
        return $this;
    }
    // =================================
    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }
    /**
     * @param float $latitude
     * @return ColaboracaoModel
     */
    public function setLatitude(float $latitude): ColaboracaoModel
    {
        $this->latitude = $latitude;
        return $this;
    }
    // =================================
    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }
    /**
     * @param float $longitude
     * @return ColaboracaoModel
     */
    public function setLongitude(float $longitude): ColaboracaoModel
    {
        $this->longitude = $longitude;
        return $this;
    }
    // =================================
    /**
     * @return string
     */
    public function getRua(): string
    {
        return $this->rua;
    }
    /**
     * @param string $rua
     * @return ColaboracaoModel
     */
    public function setRua(string $rua): ColaboracaoModel
    {
        $this->rua = $rua;
        return $this;
    }
    // =================================
    /**
     * @return string
     */
    public function getNumero(): string
    {
        return $this->numero;
    }
    /**
     * @param string $numero
     * @return ColaboracaoModel
     */
    public function setNumero(string $numero): ColaboracaoModel
    {
        $this->numero = $numero;
        return $this;
    }
    // =================================
    /**
     * @return string
     */
    public function getBairro(): string
    {
        return $this->bairro;
    }
    /**
     * @param string $bairro
     * @return ColaboracaoModel
     */
    public function setBairro(string $bairro): ColaboracaoModel
    {
        $this->bairro = $bairro;
        return $this;
    }
    // =================================
    /**
     * @return string
     */
    public function getComplemento(): string
    {
        return $this->complemento;
    }
    /**
     * @param string $complemento
     * @return ColaboracaoModel
     */
    public function setComplemento(string $complemento): ColaboracaoModel
    {
        $this->complemento = $complemento;
        return $this;
    }
    // =================================
    /**
     * @return string
     */
    public function getCep(): string
    {
        return $this->cep;
    }
    /**
     * @param string $cep
     * @return ColaboracaoModel
     */
    public function setCep(string $cep): ColaboracaoModel
    {
        $this->cep = $cep;
        return $this;
    }
    // =================================
    /**
     * @return int
     */
    public function getIdCidade(): int
    {
        return $this->idCidade;
    }
    /**
     * @param int $id
     * @return ColaboracaoModel
     */
    public function setIdCidade(int $idCidade): ColaboracaoModel
    {
        $this->idCidade = $idCidade;
        return $this;
    }
    // =================================
    /**
     * @return int
     */
    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }
    /**
     * @param int $id
     * @return ColaboracaoModel
     */
    public function setIdUsuario(int $idUsuario): ColaboracaoModel
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }
    // =================================
    /**
     * @return int
     */
    public function getIdTipo(): int
    {
        return $this->idTipo;
    }
    /**
     * @param int $id
     * @return ColaboracaoModel
     */
    public function setIdTipo(int $idTipo): ColaboracaoModel
    {
        $this->idTipo = $idTipo;
        return $this;
    }
    // =================================
    /**
     * @return int
     */
    public function getIdSituacao(): int
    {
        return $this->idSituacao;
    }
    /**
     * @param int $id
     * @return ColaboracaoModel
     */
    public function setIdSituacao(int $idSituacao): ColaboracaoModel
    {
        $this->idSituacao = $idSituacao;
        return $this;
    }
    // =================================
    /**
     * @return CidadeModel
     */
    public function getCidade(): CidadeModel
    {
        return $this->cidade;
    }
    /**
     * @param CidadeModel $cidade
     * @return ColaboracaoModel
     */
    public function setCidade(CidadeModel $cidade): ColaboracaoModel
    {
        $this->cidade = $cidade;
        return $this;
    }
    // =================================
    /**
     * @return UsuarioModel
     */
    public function getUsuario(): UsuarioModel
    {
        return $this->usuario;
    }
    /**
     * @param UsuarioModel $usuario
     * @return ColaboracaoModel
     */
    public function setUsuario(UsuarioModel $usuario): ColaboracaoModel
    {
        $this->usuario = $usuario;
        return $this;
    }
    // =================================
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
    // =================================
    /**
     * @return SituacaoModel
     */
    public function getSituacao(): SituacaoModel
    {
        return $this->situacao;
    }
    /**
     * @param SituacaoModel $situacao
     * @return ColaboracaoModel
     */
    public function setSituacao(SituacaoModel $situacao): ColaboracaoModel
    {
        $this->situacao = $situacao;
        return $this;
    }
    // =================================
}