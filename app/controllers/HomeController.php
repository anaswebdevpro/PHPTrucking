
<?php

require_once '../app/core/Controller.php';

class HomeController extends Controller {

    public function index() {

        $this->view('home');
    }

    public function about() {

        $this->view('about');
    }

    public function contact() {

        $this->view('contact');
    }
}