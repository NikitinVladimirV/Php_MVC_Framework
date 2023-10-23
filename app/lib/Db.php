<?php

namespace app\lib;

use PDO;
use PDOStatement;

/**
 * @noinspection PhpUnused
 */
class Db
{
    protected PDO $db;

    public function __construct()
    {
        $config = require 'app/config/db.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';', $config['user'], $config['password']);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return PDOStatement
     */
    public function query(string $sql, array $params = []): PDOStatement
    {
        $statement = $this->db->prepare($sql);
        $statement->execute($params);

        return $statement;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array|false
     */
    public function row(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @noinspection PhpUnused
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function column(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchColumn();
    }
}