<?php

class Router {

    public function route($url) {

        require_once '../app/controllers/HomeController.php';

        $controller = new HomeController();

        if(empty($url)) {
            $controller->index();
            return;
        }

        switch($url) {

            case 'about':
                $controller->about();
                break;

            case 'contact':
                $controller->contact();
                break;

            default:
                echo "404 Page Not Found";
        }
    }
}
