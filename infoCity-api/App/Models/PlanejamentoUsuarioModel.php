<?php 

namespace App\Models;

final class PlanejamentoUsuarioModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idPlanejamento;

    /**
     * @var int
     */
    private $idUsuario;


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
     * @return PlanejamentoUsuarioModel
     */
    public function setId(int $id): PlanejamentoUsuarioModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdPlanejamento(): int
    {
        return $this->idPlanejamento;
    }
    /**
     * @param int $idPlanejamento
     * @return PlanejamentoUsuarioModel
     */
    public function setIdPlanejamento(int $idPlanejamento): PlanejamentoUsuarioModel
    {
        $this->idPlanejamento = $idPlanejamento;
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
     * @return PlanejamentoUsuarioModel
     */
    public function setIdUsuario(int $idUsuario): PlanejamentoUsuarioModel
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }
    
}