<?php

require_once '../app/core/Database.php';


class AdminModel extends Database {

    public function findAdminByUsername($username) {

        $query = "SELECT * FROM admins WHERE username = :username";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(':username', $username);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}