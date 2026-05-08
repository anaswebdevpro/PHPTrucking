<?php

require_once '../app/models/SettingsModel.php';

function getSettings() {

    $settingsModel = new SettingsModel();

    return $settingsModel->getAllSettings();
}