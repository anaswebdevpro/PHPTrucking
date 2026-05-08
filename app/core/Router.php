<?php

require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/AdminController.php';

class Router {

    public function route($url) {

        $url = trim($url, '/');

        $homeController = new HomeController();
        $adminController = new AdminController();

        switch($url) {

            case '':
                $homeController->index();
                break;

            case 'about':
                $homeController->about();
                break;

            case 'contact':
                $homeController->contact();
                break;

            case 'login':
                $adminController->login();
                break;
            case 'dashboard':
                 $adminController->dashboard();
                 break;
             case 'logout':
                 $adminController->logout();
                 break; 
            case 'settings':
                 $adminController->settings();
                break; 
            case 'banners':
                  $adminController->banners();
                  break;
          case (preg_match('/^delete-banner\/(\d+)$/', $url, $matches) ? true : false):

                 $adminController->deleteBanner($matches[1]);

                     break;

            default:
                echo "404 Page Not Found";
        }
    }
}