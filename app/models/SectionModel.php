<?php

require_once '../app/core/Database.php';

class SectionModel extends Database {

    public function getAllSections() {
        $query = "SELECT * FROM homepage_sections ORDER BY id ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSectionById($id) {
        $query = "SELECT * FROM homepage_sections WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSection($id, $title, $content, $image, $is_active) {
        $query = "UPDATE homepage_sections SET title = :title, content = :content, image = :image, is_active = :is_active WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':id' => $id,
            ':title' => $title,
            ':content' => $content,
            ':image' => $image,
            ':is_active' => $is_active
        ]);
    }
}
