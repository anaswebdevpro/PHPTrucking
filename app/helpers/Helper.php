<?php

require_once '../app/models/SettingsModel.php';

function getSettings() {

    $settingsModel = new SettingsModel();

  return $settingsModel->getSettings();
}

function setFlash($message, $type = 'success') {
    $_SESSION['flash_message'] = [
        'message' => $message,
        'type' => $type
    ];
}

function displayFlash() {
    if(isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message']['message'];
        $type = $_SESSION['flash_message']['type'];
        unset($_SESSION['flash_message']);
        
        $color = $type === 'success' ? '#155724' : '#721c24';
        $bg = $type === 'success' ? '#d4edda' : '#f8d7da';
        
        echo "<div style='padding:15px; margin:20px; border-radius:4px; color:{$color}; background-color:{$bg};'>{$message}</div>";
    }
}

function csrf_token() {
    if(empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="'.csrf_token().'">';
}