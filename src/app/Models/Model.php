<?php

namespace Auth\Models;

use Auth\Services\Db;

abstract class Model
{
    protected  $db;
    protected  $params;

    /**
     * Model constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {

        $this->db = Db::get();
        $this->params = $params;

    }
}
