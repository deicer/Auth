<?php


namespace Auth\services;


use PDO;
use PDOException;
use RuntimeException;

class Db
{

    private static Db $instance;
    private PDO $connection;

    public function __construct()
    {
        $dbConfig = (require __DIR__ . '/../configs/config.php')['db'];

        try {
            $this->connection = new PDO(
                'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['dbname'],
                $dbConfig['user'],
                $dbConfig['password'],
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
            );

        } catch (PDOException $e) {
            throw new RuntimeException(__CLASS__ . $e->getMessage());
        }
    }

    /**
     * @return Db
     */
    public static function get(): Db
    {
        return self::$instance ?? self::$instance = new self();
    }

    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function queryOne(string $sql, $params = [])
    {
        $psql = $this->connection->prepare($sql);

        $psql->execute($params);

        if ($psql->rowCount() > 0) {
            return $psql->fetch(PDO::FETCH_ASSOC);

        } else {
            return null;
        }


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


        $sql = 'INSERT INTO ' . $table . '(' . implode(',', $params) . ') VALUES (' . implode(',', $this->prepareValues($params)) . ')';

        $psql = $this->connection->prepare($sql);

        $result = $psql->execute($values);


    }

    public function updateOne(string $table, $param, $value, $id)
    {
        $sql = "UPDATE $table SET $param=:$param WHERE id=:id";
        $psql = $this->connection->prepare($sql);
        $psql->execute([
            $param => $value,
            'id' => $id
        ]);
    }

    private function prepareValues(array $params)
    {
        foreach ($params as $key => $value) {
            $params[$key] = ':' . $value;
        }
        return $params;
    }


}
