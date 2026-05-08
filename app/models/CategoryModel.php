<?php
require_once '../app/core/Database.php';

class CategoryModel extends Database {
    public function getActiveCategories() {
        $query = "SELECT * FROM parts_categories WHERE is_active = 1 ORDER BY display_order ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategories() {
        $query = "SELECT * FROM parts_categories ORDER BY display_order ASC, id DESC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $query = "SELECT * FROM parts_categories WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addCategory($title, $description, $image, $display_order, $is_active) {
        $query = "INSERT INTO parts_categories (title, description, image, display_order, is_active) VALUES (:title, :description, :image, :display_order, :is_active)";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':title' => $title,
            ':description' => $description,
            ':image' => $image,
            ':display_order' => $display_order,
            ':is_active' => $is_active
        ]);
    }

    public function updateCategory($id, $title, $description, $image, $display_order, $is_active) {
        $query = "UPDATE parts_categories SET title = :title, description = :description, image = :image, display_order = :display_order, is_active = :is_active WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':id' => $id,
            ':title' => $title,
            ':description' => $description,
            ':image' => $image,
            ':display_order' => $display_order,
            ':is_active' => $is_active
        ]);
    }

    public function deleteCategory($id) {
        $query = "DELETE FROM parts_categories WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([':id' => $id]);
    }
}
