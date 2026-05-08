<?php

require_once '../app/core/Database.php';

class BannerModel extends Database {

    public function getAllBanners() {

        $query = "SELECT * FROM banners ORDER BY id DESC";

        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createBanner($title, $image) {

        $query = "INSERT INTO banners (title, image)
                  VALUES (:title, :image)";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(':title', $title);

        $statement->bindParam(':image', $image);

        return $statement->execute();
    }
    public function getBannerById($id) {

    $query = "SELECT * FROM banners WHERE id = :id";

    $statement = $this->connection->prepare($query);

    $statement->bindParam(':id', $id);

    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

public function deleteBanner($id) {

    $query = "DELETE FROM banners WHERE id = :id";

    $statement = $this->connection->prepare($query);

    $statement->bindParam(':id', $id);

    return $statement->execute();
}
}