<?php

require_once '../app/core/Database.php';

class SettingsModel extends Database {

    public function getSettings() {

        $query = "SELECT * FROM settings LIMIT 1";

        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSettings($data) {

        $query = "UPDATE settings SET
            site_name = :site_name,
            display_branding = :display_branding,
            phone = :phone,
            email = :email,
            address = :address,
            facebook = :facebook,
            instagram = :instagram,
            twitter = :twitter,
            linkedin = :linkedin,
            logo = :logo
            WHERE id = 1
        ";

        $statement = $this->connection->prepare($query);

        return $statement->execute([
            ':site_name' => $data['site_name'],
            ':display_branding' => $data['display_branding'] ?? 'both',
            ':phone' => $data['phone'],
            ':email' => $data['email'],
            ':address' => $data['address'],
            ':facebook' => $data['facebook'],
            ':instagram' => $data['instagram'],
            ':twitter' => $data['twitter'],
            ':linkedin' => $data['linkedin'],
            ':logo' => isset($data['logo']) ? $data['logo'] : null
        ]);
    }
}