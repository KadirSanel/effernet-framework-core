<?php

namespace Effernet\Core\Data;

use Effernet\Core\Config\Config;
use PDO;

class Core
{
    /**
     * PDO Object
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Config Path
     *
     * @var string
     */
    private string $db_conf_path;

    /**
     * Database Credentials
     *
     * @var array
     */
    private array $db_credentials;

    /**
     * Database Name
     *
     * @var string
     */
    private string $db;

    /**
     * Core Database Class
     *
     * @param string $database
     */
    public function __construct(string $database)
    {
        $this->db = $database;
        $this->db_credentials = $this->collectDbCredentials();
        $this->pdo = $this->connect();
    }

    /**
     * Config Path Getter
     *
     * @return string
     */
    public function getDbConfPath(): string
    {
        return $this->db_conf_path;
    }

    /**
     * Config Path Setter
     *
     * @param string $db_conf_path
     */
    public function setDbConfPath(string $db_conf_path): void
    {
        $this->db_conf_path = $db_conf_path;
    }

    public function runQuery(string $query)
    {
        return $this->pdo->query($query);
    }

    /**
     * Connect DB Method
     *
     * @return PDO
     */
    private function connect(): PDO
    {
        $pdo = new PDO($this->createDsn());
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    /**
     * Credentials Collector
     *
     * @return array
     */
    private function collectDbCredentials(): array
    {
        $config = new Config("db");
        return $config->getConfig();
    }

    /**
     * Dsn Creator
     *
     * @return string
     */
    private function createDsn(): string
    {
        return sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            $this->db_credentials['host'],
            $this->db_credentials['port'],
            $this->db,
            $this->db_credentials['db_user'],
            $this->db_credentials['db_password']);
    }



}