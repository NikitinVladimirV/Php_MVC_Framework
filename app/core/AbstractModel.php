<?php

namespace app\core;

use app\lib\Db;

abstract class AbstractModel
{
    public Db $db;

    public function __construct()
    {
        $this->db = new Db();
    }
}