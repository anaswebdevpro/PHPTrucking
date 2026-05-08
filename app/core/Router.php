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

            case 'services':
                $homeController->services();
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
            case 'sections':
                  $adminController->sections();
                  break;
            case 'admin-services':
                  $adminController->adminServices();
                  break;
            case 'add-service':
                  $adminController->addService();
                  break;
          case (preg_match('/^delete-banner\/(\d+)$/', $url, $matches) ? true : false):

                 $adminController->deleteBanner($matches[1]);

                     break;
          case (preg_match('/^edit-section\/(\d+)$/', $url, $matches) ? true : false):
                 $adminController->editSection($matches[1]);
                 break;
          case (preg_match('/^edit-service\/(\d+)$/', $url, $matches) ? true : false):
                 $adminController->editAdminService($matches[1]);
                 break;
          case (preg_match('/^delete-service\/(\d+)$/', $url, $matches) ? true : false):
                 $adminController->deleteService($matches[1]);
                 break;
            case 'messages':
                  $adminController->messages();
                  break;

            default:
                http_response_code(404);
                require_once '../app/views/404.php';
        }
    }
}