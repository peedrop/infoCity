<?php 

namespace App\Models;

final class TipoModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nome;


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
     * @return TipoModel
     */
    public function setId(int $id): TipoModel
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
     * @return TipoModel
     */
    public function setNome(string $nome): TipoModel
    {
        $this->nome = $nome;
        return $this;
    }
}