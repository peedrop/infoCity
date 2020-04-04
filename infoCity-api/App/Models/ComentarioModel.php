<?php 

namespace App\Models;

final class ComentarioModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var string
     */
    private $data;

    /**
     * @var int
     */
    private $avaliacao;

    /**
     * @var int
     */
    private $idUsuario;

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
     * @return ComentarioModel
     */
    public function setId(int $id): ComentarioModel
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return string
     */
    public function getComentario(): string
    {
        return $this->comentario;
    }
    /**
     * @param string $comentario
     * @return ComentarioModel
     */
    public function setComentario(string $comentario): ComentarioModel
    {
        $this->comentario = $comentario;
        return $this;
    }
    // =================================
    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }
    /**
     * @param string $data
     * @return ComentarioModel
     */
    public function setData(string $data): ComentarioModel
    {
        $this->data = $data;
        return $this;
    }
    // =================================
    /**
     * @return int
     */
    public function getAvaliacao(): int
    {
        return $this->avaliacao;
    }
    /**
     * @param int $avaliacao
     * @return ComentarioModel
     */
    public function setAvaliacao(int $avaliacao): ComentarioModel
    {
        $this->avaliacao = $avaliacao;
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
     * @return ComentarioModel
     */
    public function setIdUsuario(int $idUsuario): ComentarioModel
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }
    /**
     * @return int
     */
    public function getIdColaboracao(): int
    {
        return $this->idColaboracao;
    }
    /**
     * @param int $idColaboracao
     * @return ComentarioModel
     */
    public function setIdColaboracao(int $idColaboracao): ComentarioModel
    {
        $this->idColaboracao = $idColaboracao;
        return $this;
    }
    
}