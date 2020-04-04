<?php 

namespace App\Models;
use App\Models\EstadoModel;
use App\Models\CidadeModel;
use App\Models\UsuarioModel;

final class EnderecoModel
{
    /**
     * @var int
     */
    private $id;

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
     * @var CidadeModel
     */
    private $cidade;

    /**
     * @var UsuarioModel
     */
    private $usuario;


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
     * @return EnderecoModel
     */
    public function setId(int $id): EnderecoModel
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }
    /**
     * @param float $latitude
     * @return EnderecoModel
     */
    public function setLatitude(float $latitude): EnderecoModel
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
     * @return EnderecoModel
     */
    public function setLongitude(float $longitude): EnderecoModel
    {
        $this->longitude = $longitude;
        return $this;
    }
    /**
     * @return string
     */
    public function getRua(): string
    {
        return $this->rua;
    }
    /**
     * @param string $rua
     * @return EnderecoModel
     */
    public function setRua(string $rua): EnderecoModel
    {
        $this->rua = $rua;
        return $this;
    }
    /**
     * @return string
     */
    public function getNumero(): string
    {
        return $this->numero;
    }
    /**
     * @param string $numero
     * @return EnderecoModel
     */
    public function setNumero(string $numero): EnderecoModel
    {
        $this->numero = $numero;
        return $this;
    }
    /**
     * @return string
     */
    public function getBairro(): string
    {
        return $this->bairro;
    }
    /**
     * @param string $bairro
     * @return EnderecoModel
     */
    public function setBairro(string $bairro): EnderecoModel
    {
        $this->bairro = $bairro;
        return $this;
    }
    /**
     * @return string
     */
    public function getComplemento(): string
    {
        return $this->complemento;
    }
    /**
     * @param string $complemento
     * @return EnderecoModel
     */
    public function setComplemento(string $complemento): EnderecoModel
    {
        $this->complemento = $complemento;
        return $this;
    }
    /**
     * @return string
     */
    public function getCep(): string
    {
        return $this->cep;
    }
    /**
     * @param string $cep
     * @return EnderecoModel
     */
    public function setCep(string $cep): EnderecoModel
    {
        $this->cep = $cep;
        return $this;
    }
    /**
     * @return int
     */
    public function getIdCidade(): int
    {
        return $this->idCidade;
    }
    /**
     * @param int $id
     * @return EnderecoModel
     */
    public function setIdCidade(int $idCidade): EnderecoModel
    {
        $this->idCidade = $idCidade;
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
     * @param int $id
     * @return EnderecoModel
     */
    public function setIdUsuario(int $idUsuario): EnderecoModel
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }
    /**
     * @return CidadeModel
     */
    public function getCidade(): CidadeModel
    {
        return $this->cidade;
    }
    /**
     * @param CidadeModel $cidade
     * @return EnderecoModel
     */
    public function setCidade(CidadeModel $cidade): EnderecoModel
    {
        $this->cidade = $cidade;
        return $this;
    }
    /**
     * @return UsuarioModel
     */
    public function getUsuario(): UsuarioModel
    {
        return $this->usuario;
    }
    /**
     * @param UsuarioModel $usuario
     * @return EnderecoModel
     */
    public function setUsuario(UsuarioModel $usuario): EnderecoModel
    {
        $this->usuario = $usuario;
        return $this;
    }
}