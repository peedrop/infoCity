<?php

namespace App\DAO;

abstract class Conexao
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        $host = getenv('infocity_host');
        $dbname = getenv('infocity_dbname');
        $user = getenv('infocity_user');
        $pass = getenv('infocity_password');
        $port = getenv('infocity_port');

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }
}