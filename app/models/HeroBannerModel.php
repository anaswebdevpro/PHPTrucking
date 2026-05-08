<?php
require_once '../app/core/Database.php';

class HeroBannerModel extends Database {
    public function getAllBanners() {
        $query = "SELECT * FROM hero_banners ORDER BY display_order ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActiveBanners() {
        $query = "SELECT * FROM hero_banners WHERE is_active = 1 ORDER BY display_order ASC";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBannerById($id) {
        $query = "SELECT * FROM hero_banners WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createBanner($title, $subtitle, $image, $display_order) {
        $query = "INSERT INTO hero_banners (title, subtitle, image, display_order) VALUES (:title, :subtitle, :image, :display_order)";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':image' => $image,
            ':display_order' => $display_order
        ]);
    }

    public function updateBanner($id, $title, $subtitle, $image, $display_order, $is_active) {
        $query = "UPDATE hero_banners SET title = :title, subtitle = :subtitle, image = :image, display_order = :display_order, is_active = :is_active WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            ':id' => $id,
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':image' => $image,
            ':display_order' => $display_order,
            ':is_active' => $is_active
        ]);
    }

    public function deleteBanner($id) {
        $query = "DELETE FROM hero_banners WHERE id = :id";
        $statement = $this->connection->prepare($query);
        return $statement->execute([':id' => $id]);
    }
}
