<?php

namespace app\models;


use app\core\AbstractModel;

/**
 * @noinspection PhpUnused
 */
class MainModel extends AbstractModel
{
    /**
     * @return array
     */
    public function getNews(): array
    {
        return $this->db->row('SELECT title, description FROM news');
    }
}