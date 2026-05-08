
<?php

require_once '../app/core/Controller.php';

class HomeController extends Controller {

    public function index() {
        require_once '../app/models/BannerModel.php';
        require_once '../app/models/SectionModel.php';
        
        $bannerModel = new BannerModel();
        $banners = $bannerModel->getAllBanners();

        $sectionModel = new SectionModel();
        $allSections = $sectionModel->getAllSections();
        
        $sections = [];
        foreach($allSections as $sec) {
            $sections[$sec['section_key']] = $sec;
        }

        $this->view('home', ['banners' => $banners, 'sections' => $sections]);
    }

    public function about() {

        $this->view('about');
    }

    public function contact() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../app/models/ContactModel.php';
            $contactModel = new ContactModel();
            
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');
            
            if(!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $contactModel->saveMessage($name, $email, $subject, $message);
                setFlash("Your message has been sent successfully. We will get back to you soon.", "success");
                header("Location: " . BASE_URL . "/contact");
                exit;
            } else {
                setFlash("Please fill in all required fields correctly.", "error");
                header("Location: " . BASE_URL . "/contact");
                exit;
            }
        }

        $this->view('contact');
    }

    public function services() {
        require_once '../app/models/ServiceModel.php';
        $serviceModel = new ServiceModel();
        $services = $serviceModel->getAllServices();
        $this->view('services', ['services' => $services]);
    }
}