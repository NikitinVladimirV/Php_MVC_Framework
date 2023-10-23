<?php

namespace app\lib;

use PDO;

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

    public function query($sql, $params = [])
    {
        $statement = $this->db->prepare($sql);

        $statement->execute($params);

        return $statement;
    }

    /**
     * @noinspection PhpUnused
     */
    public function row($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @noinspection PhpUnused
     */
    public function column($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchColumn();
    }
}