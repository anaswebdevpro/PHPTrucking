<?php
require_once '../app/core/Database.php';

class TestimonialModel extends Database {
    public function getActiveTestimonials() {
        $query = "SELECT * FROM testimonials WHERE is_active = 1 ORDER BY id DESC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTestimonials() {
        $query = "SELECT * FROM testimonials ORDER BY id DESC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTestimonialById($id) {
        $query = "SELECT * FROM testimonials WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addTestimonial($author_name, $author_role, $content, $avatar, $stars, $is_active) {
        $query = "INSERT INTO testimonials (author_name, author_role, content, avatar, stars, is_active) VALUES (:name, :role, :content, :avatar, :stars, :is_active)";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':name' => $author_name,
            ':role' => $author_role,
            ':content' => $content,
            ':avatar' => $avatar,
            ':stars' => $stars,
            ':is_active' => $is_active
        ]);
    }

    public function updateTestimonial($id, $author_name, $author_role, $content, $avatar, $stars, $is_active) {
        $query = "UPDATE testimonials SET author_name = :name, author_role = :role, content = :content, avatar = :avatar, stars = :stars, is_active = :is_active WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':id' => $id,
            ':name' => $author_name,
            ':role' => $author_role,
            ':content' => $content,
            ':avatar' => $avatar,
            ':stars' => $stars,
            ':is_active' => $is_active
        ]);
    }

    public function deleteTestimonial($id) {
        $query = "DELETE FROM testimonials WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([':id' => $id]);
    }
}
