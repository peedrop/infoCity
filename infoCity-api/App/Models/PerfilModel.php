<?php 

namespace App\Models;

final class PerfilModel
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
     * @return PerfilModel
     */
    public function setId(int $id): PerfilModel
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
     * @return PerfilModel
     */
    public function setNome(string $nome): PerfilModel
    {
        $this->nome = $nome;
        return $this;
    }
}