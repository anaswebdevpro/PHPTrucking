<?php

require_once '../app/core/Router.php';

$router = new Router();

$url = $_GET['url'] ?? '';

$url = trim($url, '/');

$router->route($url);