<?php

class DB
{
    private $pdo;

    private static $instance = null;

    /**
     * __construct
     *
     * @return void
     */
    private function __construct()
    {
        $dsn = 'mysql:dbname='. $_ENV['DB_NAME'] .';host=' . $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $password = '';

        $this->pdo = new \PDO($dsn, $user, $password);
    }

    /**
     * getInstance
     *
     * @return void
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }

    /**
     * select
     *
     * @param  mixed $sql
     * @return void
     */
    public function select($sql)
    {
        $sth = $this->pdo->query($sql);
        return $sth->fetchAll();
    }

    /**
     * prepare
     *
     * @param  mixed $sql
     * @return void
     */
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    /**
     * exec
     *
     * @param  mixed $sql
     * @return void
     */
    public function exec($sql)
    {
        return $this->pdo->exec($sql);
    }

    /**
     * lastInsertId
     *
     * @return int
     */
    public function lastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
}
