<?php

require_once '../app/core/Database.php';

class ContactModel extends Database {

    public function saveMessage($name, $email, $subject, $message) {
        $query = "INSERT INTO contact_messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);
    }

    public function getAllMessages() {
        $query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function markAsRead($id) {
        $query = "UPDATE contact_messages SET is_read = 1 WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([':id' => $id]);
    }
}
