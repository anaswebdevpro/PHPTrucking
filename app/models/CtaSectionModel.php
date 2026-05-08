<?php
require_once '../app/core/Database.php';

class CtaSectionModel extends Database {
    public function getSection() {
        $query = "SELECT * FROM cta_section LIMIT 1";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSection($title, $content, $is_active) {
        $query = "UPDATE cta_section SET title = :title, content = :content, is_active = :is_active";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':title' => $title,
            ':content' => $content,
            ':is_active' => $is_active
        ]);
    }
}
