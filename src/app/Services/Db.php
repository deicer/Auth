<?php

namespace Auth\Services;

use PDO;
use PDOException;
use RuntimeException;

class Db
{
    private static Db $instance;
    private PDO       $connection;

    public function __construct()
    {
        $dbConfig = (require __DIR__.'/../Configs/config.php')['db'];

        try {
            $this->connection = new PDO(
                'mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['dbname'],
                $dbConfig['user'],
                $dbConfig['password'],
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
            );
        } catch (PDOException $e) {
            throw new RuntimeException(__CLASS__.$e->getMessage());
        }
    }

    /**
     * @return Db
     */
    public static function get(): self
    {
        return self::$instance ?? self::$instance = new self();
    }

    /**
     * @param string $sql
     * @param array  $params
     *
     * @return array|null
     */
    public function queryOne(string $sql, $params = []): ?array
    {
        $psql = $this->connection->prepare($sql);
        $psql->execute($params);

        return $psql->rowCount() > 0 ? $psql->fetch(PDO::FETCH_ASSOC) : null;
    }

    public function query(string $sql, $params = []): ?array
    {
        $psql = $this->connection->prepare($sql);

        $psql->execute($params);

        if ($psql->rowCount() > 0) {
            return $psql->fetchAll(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }

    public function insert(string $table, $params = [], $values = []): void
    {
        $sql = 'INSERT INTO '.$table.'('.implode(',', $params).') VALUES ('.implode(
            ',',
            $this->prepareInsertValues($params)
        ).')';

        $psql = $this->connection->prepare($sql);

        $psql->execute($values);
    }

    public function updateOne(string $table, string $param, string $value, int $id)
    {
        $sql = "UPDATE $table SET $param=:$param WHERE id=:id";
        $psql = $this->connection->prepare($sql);
        $psql->execute([
            $param => $value,
            'id'   => $id,
        ]);
    }

    public function update(string $table, array $params)
    {
        $sql = 'UPDATE '.$table.' SET '.$this->prepareUpdateValues($params).' WHERE id=:id';
        $psql = $this->connection->prepare($sql);
        $psql->execute($params);
        var_dump($sql);
        var_dump($psql->errorCode());
    }

    private function prepareInsertValues(array $params)
    {
        foreach ($params as $key => $value) {
            $params[$key] = ':'.$value;
        }

        return $params;
    }

    private function prepareUpdateValues(array $params)
    {
        $sql = '';

        foreach ($params as $param => $value) {
            if (!next($params)) {
                $sql .= $param.'=:'.$param;
            } else {
                $sql .= $param.'=:'.$param.',';
            }
        }

        return $sql;
    }
}
