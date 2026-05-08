<?php

session_start();

require_once '../app/config/config.php';
require_once '../app/helpers/Helper.php';
require_once '../app/core/Router.php';

$router = new Router();

$url = $_GET['url'] ?? '';

$url = trim($url, '/');

$router->route($url);