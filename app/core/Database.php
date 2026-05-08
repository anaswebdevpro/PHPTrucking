<?php

class Database {

    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;

    protected $connection;

    public function __construct() {

        try {

            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->pass
            );

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch(PDOException $e) {

            die("Database Connection Failed: " . $e->getMessage());
        }
    }
}