<?php
require_once '../app/core/Database.php';

class SupportSectionModel extends Database {
    public function getSection() {
        $query = "SELECT * FROM support_section LIMIT 1";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSection($title, $content, $image, $is_active) {
        $query = "UPDATE support_section SET title = :title, content = :content, image = :image, is_active = :is_active";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':title' => $title,
            ':content' => $content,
            ':image' => $image,
            ':is_active' => $is_active
        ]);
    }
}
