<?php 

namespace App\Models;

final class UsuarioModel
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
    private $email;

    /**
     * @var string
     */
    private $senha;

    /**
     * @var string
     */
    private $dataNascimento;

    /**
     * @var string
     */
    private $sexo;

    /**
     * @var int
     */
    private $flagSituacao; 

    /**
     * @var string
     */
    private $foto; 

    /**
     * @var int
     */
    private $idPerfil;   
    

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
     * @return UsuarioModel
     */
    public function setId(int $id): UsuarioModel
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
     * @return UsuarioModel
     */
    public function setNome(string $nome): UsuarioModel
    {
        $this->nome = $nome;
        return $this;
    }
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    /**
     * @param string $email
     * @return UsuarioModel
     */
    public function setEmail(string $email): UsuarioModel
    {
        $this->email = $email;
        return $this;
    }
    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }
    /**
     * @param string $senha
     * @return UsuarioModel
     */
    public function setSenha(string $senha): UsuarioModel
    {
        $this->senha = $senha;
        return $this;
    }
    /**
     * @return string
     */
    public function getDataNascimento(): string
    {
        return $this->dataNascimento;
    }
    /**
     * @param string $dataNascimento
     * @return UsuarioModel
     */
    public function setDataNascimento(string $dataNascimento): UsuarioModel
    {
        $this->dataNascimento = $dataNascimento;
        return $this;
    }
    /**
     * @return string
     */
    public function getSexo(): string
    {
        return $this->sexo;
    }
    /**
     * @param string $sexo
     * @return UsuarioModel
     */
    public function setSexo(string $sexo): UsuarioModel
    {
        $this->sexo = $sexo;
        return $this;
    }
    /**
     * @return int
     */
    public function getFlagSituacao(): int
    {
        return $this->flagSituacao;
    }
    /**
     * @param int $flagSituacao
     * @return UsuarioModel
     */
    public function setFlagSituacao(int $flagSituacao): UsuarioModel
    {
        $this->flagSituacao = $flagSituacao;
        return $this;
    }
    /**
     * @return string
     */
    public function getFoto(): string
    {
        return $this->foto;
    }
    /**
     * @param string $foto
     * @return UsuarioModel
     */
    public function setFoto(string $foto): UsuarioModel
    {
        $this->foto = $foto;
        return $this;
    }
    /**
     * @return int
     */
    public function getIdPerfil(): int
    {
        return $this->idPerfil;
    }
    /**
     * @param int $idPerfil
     * @return UsuarioModel
     */
    public function setIdPerfil(int $idPerfil): UsuarioModel
    {
        $this->idPerfil = $idPerfil;
        return $this;
    }
}