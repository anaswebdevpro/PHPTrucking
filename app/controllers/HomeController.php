<?php

class HomeController {

    public function index() {
        require_once '../app/views/home.php';
    }

    public function about() {
        require_once '../app/views/about.php';
    }

    public function contact() {
        require_once '../app/views/contact.php';
    }
}