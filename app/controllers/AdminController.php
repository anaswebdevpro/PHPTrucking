<?php

require_once '../app/core/Controller.php';
require_once '../app/models/AdminModel.php';
require_once '../app/models/SettingsModel.php';
require_once '../app/models/BannerModel.php';
require_once '../app/models/SectionModel.php';
require_once '../app/models/ServiceModel.php';
require_once '../app/models/ContactModel.php';

class AdminController extends Controller {

    private $adminModel;
    private $settingsModel;
    private $bannerModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
        $this->settingsModel = new SettingsModel();
        $this->bannerModel = new BannerModel();
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $admin = $this->adminModel->findAdminByUsername($username);

            if($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                header("Location: " . BASE_URL . "/dashboard");
                exit;
            } else {
                setFlash("Invalid Username or Password", "error");
                header("Location: " . BASE_URL . "/login");
                exit;
            }
        } else {
            $this->view('login');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    public function dashboard() {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        require_once '../app/views/admin/dashboard.php';
    }

    public function settings() {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updateData = $_POST;

            if(isset($_FILES['logo'])) {
                if ($_FILES['logo']['error'] === 0) {
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                    $fileName = $_FILES['logo']['name'];
                    $fileTmp = $_FILES['logo']['tmp_name'];
                    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    if(in_array($extension, $allowedExtensions)) {
                        $newFileName = 'logo_' . time() . '_' . uniqid() . '.' . $extension;
                        $uploadPath = dirname(__DIR__, 2) . '/public/uploads/';
                        if(move_uploaded_file($fileTmp, $uploadPath . $newFileName)) {
                            $updateData['logo'] = $newFileName;
                            
                            $oldSettings = $this->settingsModel->getSettings();
                            if(!empty($oldSettings['logo'])) {
                                $oldFilePath = $uploadPath . $oldSettings['logo'];
                                if(file_exists($oldFilePath)) {
                                    unlink($oldFilePath);
                                }
                            }
                        } else {
                            setFlash("Failed to move uploaded logo file.", "error");
                            header("Location: " . BASE_URL . "/settings");
                            exit;
                        }
                    } else {
                        setFlash("Invalid logo format. Only JPG, PNG, WEBP, GIF allowed.", "error");
                        header("Location: " . BASE_URL . "/settings");
                        exit;
                    }
                } elseif ($_FILES['logo']['error'] !== UPLOAD_ERR_NO_FILE) {
                    setFlash("Logo upload error code: " . $_FILES['logo']['error'], "error");
                    header("Location: " . BASE_URL . "/settings");
                    exit;
                } else {
                    $oldSettings = $this->settingsModel->getSettings();
                    $updateData['logo'] = $oldSettings['logo'];
                }
            } else {
                $oldSettings = $this->settingsModel->getSettings();
                $updateData['logo'] = $oldSettings['logo'];
            }

            $this->settingsModel->updateSettings($updateData);
            setFlash("Settings updated successfully.", "success");
            header("Location: " . BASE_URL . "/settings");
            exit;
        }

        $settings = $this->settingsModel->getSettings();
        require_once '../app/views/admin/settings.php';
    }

    // --- HERO BANNERS CRUD ---
    public function heroBanners() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/HeroBannerModel.php';
        $model = new HeroBannerModel();
        $banners = $model->getAllBanners();
        require_once '../app/views/admin/hero_banners.php';
    }

    public function addHeroBanner() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/HeroBannerModel.php';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new HeroBannerModel();
            $title = trim($_POST['title']);
            $subtitle = trim($_POST['subtitle']);
            $display_order = (int)$_POST['display_order'];
            $image = '';
            
            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $image = time() . '_' . uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], dirname(__DIR__, 2) . '/public/uploads/' . $image);
                }
            }
            $model->createBanner($title, $subtitle, $image, $display_order);
            setFlash("Banner added.", "success");
            header("Location: " . BASE_URL . "/hero-banners");
            exit;
        }
        require_once '../app/views/admin/add_hero_banner.php';
    }

    public function editHeroBanner($id) {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/HeroBannerModel.php';
        $model = new HeroBannerModel();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $subtitle = trim($_POST['subtitle']);
            $display_order = (int)$_POST['display_order'];
            $is_active = (int)$_POST['is_active'];
            $image = $_POST['existing_image'] ?? '';
            
            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $newImage = time() . '_' . uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], dirname(__DIR__, 2) . '/public/uploads/' . $newImage);
                    $image = $newImage;
                    if(!empty($_POST['existing_image']) && file_exists(dirname(__DIR__, 2) . '/public/uploads/' . $_POST['existing_image']) && strpos($_POST['existing_image'], 'http') === false) {
                        unlink(dirname(__DIR__, 2) . '/public/uploads/' . $_POST['existing_image']);
                    }
                }
            }
            $model->updateBanner($id, $title, $subtitle, $image, $display_order, $is_active);
            setFlash("Banner updated.", "success");
            header("Location: " . BASE_URL . "/hero-banners");
            exit;
        }
        $banner = $model->getBannerById($id);
        require_once '../app/views/admin/edit_hero_banner.php';
    }

    public function deleteHeroBanner($id) {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/HeroBannerModel.php';
        $model = new HeroBannerModel();
        $banner = $model->getBannerById($id);
        if($banner) {
            if(!empty($banner['image']) && file_exists(dirname(__DIR__, 2) . '/public/uploads/' . $banner['image']) && strpos($banner['image'], 'http') === false) {
                unlink(dirname(__DIR__, 2) . '/public/uploads/' . $banner['image']);
            }
            $model->deleteBanner($id);
            setFlash("Banner deleted.", "success");
        }
        header("Location: " . BASE_URL . "/hero-banners");
        exit;
    }

    // --- SUPPORT SECTION ---
    public function supportSection() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/SupportSectionModel.php';
        $model = new SupportSectionModel();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $is_active = (int)$_POST['is_active'];
            $image = $_POST['existing_image'] ?? '';
            
            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $newImage = time() . '_' . uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], dirname(__DIR__, 2) . '/public/uploads/' . $newImage);
                    $image = $newImage;
                    if(!empty($_POST['existing_image']) && file_exists(dirname(__DIR__, 2) . '/public/uploads/' . $_POST['existing_image']) && strpos($_POST['existing_image'], 'http') === false) {
                        unlink(dirname(__DIR__, 2) . '/public/uploads/' . $_POST['existing_image']);
                    }
                }
            }
            $model->updateSection($title, $content, $image, $is_active);
            setFlash("Support section updated.", "success");
            header("Location: " . BASE_URL . "/support-section");
            exit;
        }
        
        $section = $model->getSection();
        require_once '../app/views/admin/support_section.php';
    }

    // --- CTA SECTION ---
    public function ctaSection() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/CtaSectionModel.php';
        $model = new CtaSectionModel();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $is_active = (int)$_POST['is_active'];
            
            $model->updateSection($title, $content, $is_active);
            setFlash("CTA section updated.", "success");
            header("Location: " . BASE_URL . "/cta-section");
            exit;
        }
        
        $section = $model->getSection();
        require_once '../app/views/admin/cta_section.php';
    }

    public function adminServices() {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        $serviceModel = new ServiceModel();
        $services = $serviceModel->getAllServices();
        require_once '../app/views/admin/services.php';
    }

    public function addService() {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        $serviceModel = new ServiceModel();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            
            $image = '';
            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                $fileName = $_FILES['image']['name'];
                $fileTmp = $_FILES['image']['tmp_name'];
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if(in_array($extension, $allowedExtensions)) {
                    $newFileName = time() . '_' . uniqid() . '.' . $extension;
                    $uploadPath = dirname(__DIR__, 2) . '/public/uploads/';
                    move_uploaded_file($fileTmp, $uploadPath . $newFileName);
                    $image = $newFileName;
                }
            }
            $serviceModel->addService($title, $description, $image);
            setFlash("Service added successfully.", "success");
            header("Location: " . BASE_URL . "/admin-services");
            exit;
        }
        require_once '../app/views/admin/add_service.php';
    }

    public function editAdminService($id) {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        $serviceModel = new ServiceModel();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $existingImage = $_POST['existing_image'] ?? '';
            
            $image = $existingImage;
            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
                $fileName = $_FILES['image']['name'];
                $fileTmp = $_FILES['image']['tmp_name'];
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if(in_array($extension, $allowedExtensions)) {
                    $newFileName = time() . '_' . uniqid() . '.' . $extension;
                    move_uploaded_file($fileTmp, "../public/uploads/" . $newFileName);
                    $image = $newFileName;
                    if(!empty($existingImage) && file_exists("../public/uploads/" . $existingImage)) {
                        unlink("../public/uploads/" . $existingImage);
                    }
                }
            }
            $serviceModel->updateService($id, $title, $description, $image);
            setFlash("Service updated successfully.", "success");
            header("Location: " . BASE_URL . "/admin-services");
            exit;
        }
        
        $service = $serviceModel->getServiceById($id);
        require_once '../app/views/admin/edit_service.php';
    }

    public function deleteService($id) {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        $serviceModel = new ServiceModel();
        $service = $serviceModel->getServiceById($id);
        if($service) {
            $uploadPath = dirname(__DIR__, 2) . '/public/uploads/';
            if(!empty($service['image']) && file_exists($uploadPath . $service['image'])) {
                unlink($uploadPath . $service['image']);
            }
            $serviceModel->deleteService($id);
            setFlash("Service deleted successfully.", "success");
        } else {
            setFlash("Service not found.", "error");
        }
        header("Location: " . BASE_URL . "/admin-services");
        exit;
    }

    public function messages() {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        $contactModel = new ContactModel();
        
        if(isset($_GET['mark_read'])) {
            $contactModel->markAsRead($_GET['mark_read']);
            setFlash("Message marked as read.", "success");
            header("Location: " . BASE_URL . "/messages");
            exit;
        }

        $messages = $contactModel->getAllMessages();
        require_once '../app/views/admin/messages.php';
    }

    // --- TESTIMONIALS CRUD ---
    public function testimonials() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/TestimonialModel.php';
        $model = new TestimonialModel();
        $testimonials = $model->getAllTestimonials();
        require_once '../app/views/admin/testimonials.php';
    }

    public function addTestimonial() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/TestimonialModel.php';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new TestimonialModel();
            $name = trim($_POST['author_name']);
            $role = trim($_POST['author_role']);
            $content = trim($_POST['content']);
            $stars = (int)$_POST['stars'];
            $is_active = (int)$_POST['is_active'];
            $avatar = '';
            
            if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $avatar = time() . '_' . uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES['avatar']['tmp_name'], dirname(__DIR__, 2) . '/public/uploads/' . $avatar);
                }
            }
            $model->addTestimonial($name, $role, $content, $avatar, $stars, $is_active);
            setFlash("Testimonial added.", "success");
            header("Location: " . BASE_URL . "/testimonials");
            exit;
        }
        require_once '../app/views/admin/add_testimonial.php';
    }

    public function editTestimonial($id) {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/TestimonialModel.php';
        $model = new TestimonialModel();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['author_name']);
            $role = trim($_POST['author_role']);
            $content = trim($_POST['content']);
            $stars = (int)$_POST['stars'];
            $is_active = (int)$_POST['is_active'];
            $avatar = $_POST['existing_avatar'] ?? '';
            
            if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $newAvatar = time() . '_' . uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES['avatar']['tmp_name'], dirname(__DIR__, 2) . '/public/uploads/' . $newAvatar);
                    $avatar = $newAvatar;
                    if(!empty($_POST['existing_avatar']) && file_exists(dirname(__DIR__, 2) . '/public/uploads/' . $_POST['existing_avatar']) && strpos($_POST['existing_avatar'], 'http') === false) {
                        unlink(dirname(__DIR__, 2) . '/public/uploads/' . $_POST['existing_avatar']);
                    }
                }
            }
            $model->updateTestimonial($id, $name, $role, $content, $avatar, $stars, $is_active);
            setFlash("Testimonial updated.", "success");
            header("Location: " . BASE_URL . "/testimonials");
            exit;
        }
        $testimonial = $model->getTestimonialById($id);
        require_once '../app/views/admin/edit_testimonial.php';
    }

    public function deleteTestimonial($id) {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/TestimonialModel.php';
        $model = new TestimonialModel();
        $t = $model->getTestimonialById($id);
        if($t) {
            if(!empty($t['avatar']) && file_exists(dirname(__DIR__, 2) . '/public/uploads/' . $t['avatar']) && strpos($t['avatar'], 'http') === false) {
                unlink(dirname(__DIR__, 2) . '/public/uploads/' . $t['avatar']);
            }
            $model->deleteTestimonial($id);
            setFlash("Testimonial deleted.", "success");
        }
        header("Location: " . BASE_URL . "/testimonials");
        exit;
    }

    // --- FAQS CRUD ---
    public function faqs() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/FaqModel.php';
        $model = new FaqModel();
        $faqs = $model->getAllFaqs();
        require_once '../app/views/admin/faqs.php';
    }

    public function addFaq() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/FaqModel.php';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new FaqModel();
            $model->addFaq(trim($_POST['question']), trim($_POST['answer']), (int)$_POST['display_order'], (int)$_POST['is_active']);
            setFlash("FAQ added.", "success");
            header("Location: " . BASE_URL . "/faqs");
            exit;
        }
        require_once '../app/views/admin/add_faq.php';
    }

    public function editFaq($id) {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/FaqModel.php';
        $model = new FaqModel();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->updateFaq($id, trim($_POST['question']), trim($_POST['answer']), (int)$_POST['display_order'], (int)$_POST['is_active']);
            setFlash("FAQ updated.", "success");
            header("Location: " . BASE_URL . "/faqs");
            exit;
        }
        $faq = $model->getFaqById($id);
        require_once '../app/views/admin/edit_faq.php';
    }

    public function deleteFaq($id) {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/FaqModel.php';
        $model = new FaqModel();
        $model->deleteFaq($id);
        setFlash("FAQ deleted.", "success");
        header("Location: " . BASE_URL . "/faqs");
        exit;
    }

    // --- PARTS CATEGORIES CRUD ---
    public function categories() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/CategoryModel.php';
        $model = new CategoryModel();
        $categories = $model->getAllCategories();
        require_once '../app/views/admin/categories.php';
    }

    public function addCategory() {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/CategoryModel.php';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new CategoryModel();
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $display_order = (int)$_POST['display_order'];
            $is_active = (int)$_POST['is_active'];
            $image = '';
            
            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $image = time() . '_' . uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], dirname(__DIR__, 2) . '/public/uploads/' . $image);
                }
            }
            $model->addCategory($title, $description, $image, $display_order, $is_active);
            setFlash("Category added.", "success");
            header("Location: " . BASE_URL . "/categories");
            exit;
        }
        require_once '../app/views/admin/add_category.php';
    }

    public function editCategory($id) {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/CategoryModel.php';
        $model = new CategoryModel();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $display_order = (int)$_POST['display_order'];
            $is_active = (int)$_POST['is_active'];
            $image = $_POST['existing_image'] ?? '';
            
            if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $newImage = time() . '_' . uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES['image']['tmp_name'], dirname(__DIR__, 2) . '/public/uploads/' . $newImage);
                    $image = $newImage;
                    if(!empty($_POST['existing_image']) && file_exists(dirname(__DIR__, 2) . '/public/uploads/' . $_POST['existing_image']) && strpos($_POST['existing_image'], 'http') === false) {
                        unlink(dirname(__DIR__, 2) . '/public/uploads/' . $_POST['existing_image']);
                    }
                }
            }
            $model->updateCategory($id, $title, $description, $image, $display_order, $is_active);
            setFlash("Category updated.", "success");
            header("Location: " . BASE_URL . "/categories");
            exit;
        }
        $category = $model->getCategoryById($id);
        require_once '../app/views/admin/edit_category.php';
    }

    public function deleteCategory($id) {
        if(!isset($_SESSION['admin_id'])) { header("Location: " . BASE_URL . "/login"); exit; }
        require_once '../app/models/CategoryModel.php';
        $model = new CategoryModel();
        $cat = $model->getCategoryById($id);
        if($cat) {
            if(!empty($cat['image']) && file_exists(dirname(__DIR__, 2) . '/public/uploads/' . $cat['image']) && strpos($cat['image'], 'http') === false) {
                unlink(dirname(__DIR__, 2) . '/public/uploads/' . $cat['image']);
            }
            $model->deleteCategory($id);
            setFlash("Category deleted.", "success");
        }
        header("Location: " . BASE_URL . "/categories");
        exit;
    }
}
