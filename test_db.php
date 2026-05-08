<?php
require_once 'app/config/config.php';
try {
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    $stmt = $pdo->query("UPDATE settings SET logo = '' WHERE id = 1");
} catch (Exception $e) {
    echo $e->getMessage();
}
