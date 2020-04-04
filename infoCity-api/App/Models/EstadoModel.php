<?php 

namespace App\Models;

final class EstadoModel
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
     * @var string
     */
    private $sigla;


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
     * @return EstadoModel
     */
    public function setId(int $id): EstadoModel
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
     * @return EstadoModel
     */
    public function setNome(string $nome): EstadoModel
    {
        $this->nome = $nome;
        return $this;
    }
    /**
     * @return string
     */
    public function getSigla(): string
    {
        return $this->sigla;
    }
    /**
     * @param string $sigla
     * @return EstadoModel
     */
    public function setSigla(string $sigla): EstadoModel
    {
        $this->sigla = $sigla;
        return $this;
    }
}