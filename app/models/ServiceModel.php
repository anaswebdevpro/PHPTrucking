<?php

require_once '../app/core/Database.php';

class ServiceModel extends Database {

    public function getAllServices() {
        $query = "SELECT * FROM services ORDER BY id DESC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServiceById($id) {
        $query = "SELECT * FROM services WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addService($title, $description, $image) {
        $query = "INSERT INTO services (title, description, image) VALUES (:title, :description, :image)";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':title' => $title,
            ':description' => $description,
            ':image' => $image
        ]);
    }

    public function updateService($id, $title, $description, $image) {
        $query = "UPDATE services SET title = :title, description = :description, image = :image WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':id' => $id,
            ':title' => $title,
            ':description' => $description,
            ':image' => $image
        ]);
    }

    public function deleteService($id) {
        $query = "DELETE FROM services WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([':id' => $id]);
    }
}
