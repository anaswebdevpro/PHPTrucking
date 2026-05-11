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

            case 'transportation':
                $homeController->transportation();
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

            case 'hero-banners':
                  $adminController->heroBanners();
                  break;
            case 'add-hero-banner':
                  $adminController->addHeroBanner();
                  break;
            case (preg_match('/^edit-hero-banner\/(\d+)$/', $url, $matches) ? true : false):
                  $adminController->editHeroBanner($matches[1]);
                  break;
            case (preg_match('/^delete-hero-banner\/(\d+)$/', $url, $matches) ? true : false):
                  $adminController->deleteHeroBanner($matches[1]);
                  break;

            case 'support-section':
                  $adminController->supportSection();
                  break;

            case 'cta-section':
                  $adminController->ctaSection();
                  break;

            case 'admin-services':
                  $adminController->adminServices();
                  break;
            case 'add-service':
                  $adminController->addService();
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

            case 'testimonials':
                  $adminController->testimonials();
                  break;
            case 'add-testimonial':
                  $adminController->addTestimonial();
                  break;
            case (preg_match('/^edit-testimonial\/(\d+)$/', $url, $matches) ? true : false):
                  $adminController->editTestimonial($matches[1]);
                  break;
            case (preg_match('/^delete-testimonial\/(\d+)$/', $url, $matches) ? true : false):
                  $adminController->deleteTestimonial($matches[1]);
                  break;

            case 'faqs':
                  $adminController->faqs();
                  break;
            case 'add-faq':
                  $adminController->addFaq();
                  break;
            case (preg_match('/^edit-faq\/(\d+)$/', $url, $matches) ? true : false):
                  $adminController->editFaq($matches[1]);
                  break;
            case (preg_match('/^delete-faq\/(\d+)$/', $url, $matches) ? true : false):
                  $adminController->deleteFaq($matches[1]);
                  break;

            case 'categories':
                  $adminController->categories();
                  break;
            case 'add-category':
                  $adminController->addCategory();
                  break;
            case (preg_match('/^edit-category\/(\d+)$/', $url, $matches) ? true : false):
                  $adminController->editCategory($matches[1]);
                  break;
            case (preg_match('/^delete-category\/(\d+)$/', $url, $matches) ? true : false):
                  $adminController->deleteCategory($matches[1]);
                  break;

            default:
                http_response_code(404);
                require_once '../app/views/404.php';
        }
    }
}