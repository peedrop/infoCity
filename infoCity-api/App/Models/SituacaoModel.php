<?php 

namespace App\Models;

final class SituacaoModel
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
     * @return SituacaoModel
     */
    public function setId(int $id): SituacaoModel
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
     * @return SituacaoModel
     */
    public function setNome(string $nome): SituacaoModel
    {
        $this->nome = $nome;
        return $this;
    }
}