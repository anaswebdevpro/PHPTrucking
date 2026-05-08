<?php

require_once '../app/core/Controller.php';

class HomeController extends Controller {

    public function index() {
        require_once '../app/models/SettingsModel.php';
        require_once '../app/models/HeroBannerModel.php';
        require_once '../app/models/SupportSectionModel.php';
        require_once '../app/models/CtaSectionModel.php';
        require_once '../app/models/TestimonialModel.php';
        require_once '../app/models/FaqModel.php';
        require_once '../app/models/CategoryModel.php';

        $settingsModel = new SettingsModel();
        $settings = $settingsModel->getSettings();

        $heroBannerModel = new HeroBannerModel();
        $banners = $heroBannerModel->getActiveBanners();

        $supportModel = new SupportSectionModel();
        $supportSection = $supportModel->getSection();

        $ctaModel = new CtaSectionModel();
        $ctaSection = $ctaModel->getSection();

        $testimonialModel = new TestimonialModel();
        $testimonials = $testimonialModel->getActiveTestimonials();

        $faqModel = new FaqModel();
        $faqs = $faqModel->getActiveFaqs();

        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getActiveCategories();

        $data = [
            'settings' => $settings,
            'banners' => $banners,
            'support_section' => $supportSection,
            'cta_section' => $ctaSection,
            'testimonials' => $testimonials,
            'faqs' => $faqs,
            'categories' => $categories
        ];

        $this->view('home', $data);
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