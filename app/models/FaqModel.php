<?php
require_once '../app/core/Database.php';

class FaqModel extends Database {
    public function getActiveFaqs() {
        $query = "SELECT * FROM faqs WHERE is_active = 1 ORDER BY display_order ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllFaqs() {
        $query = "SELECT * FROM faqs ORDER BY display_order ASC, id DESC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFaqById($id) {
        $query = "SELECT * FROM faqs WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addFaq($question, $answer, $display_order, $is_active) {
        $query = "INSERT INTO faqs (question, answer, display_order, is_active) VALUES (:question, :answer, :display_order, :is_active)";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':question' => $question,
            ':answer' => $answer,
            ':display_order' => $display_order,
            ':is_active' => $is_active
        ]);
    }

    public function updateFaq($id, $question, $answer, $display_order, $is_active) {
        $query = "UPDATE faqs SET question = :question, answer = :answer, display_order = :display_order, is_active = :is_active WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':id' => $id,
            ':question' => $question,
            ':answer' => $answer,
            ':display_order' => $display_order,
            ':is_active' => $is_active
        ]);
    }

    public function deleteFaq($id) {
        $query = "DELETE FROM faqs WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([':id' => $id]);
    }
}
