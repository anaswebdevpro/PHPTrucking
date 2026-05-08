<?php

require_once '../app/core/Database.php';

class SettingsModel extends Database {

    public function getAllSettings() {

        $query = "SELECT * FROM settings";

        $statement = $this->connection->prepare($query);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $settings = [];

        foreach($results as $row) {

            $settings[$row['setting_key']] = $row['setting_value'];
        }

        return $settings;
    }

    public function updateSetting($key, $value) {

        $query = "UPDATE settings
                  SET setting_value = :value
                  WHERE setting_key = :key";

        $statement = $this->connection->prepare($query);

        $statement->bindParam(':key', $key);

        $statement->bindParam(':value', $value);

        return $statement->execute();
    }
}