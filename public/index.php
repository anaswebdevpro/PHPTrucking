<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
session_start();

require_once '../app/config/config.php';
require_once '../app/helpers/Helper.php';

// Global CSRF Check
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token.");
    }
}

require_once '../app/core/Router.php';

$router = new Router();

$url = $_GET['url'] ?? '';

$url = trim($url, '/');

$router->route($url);