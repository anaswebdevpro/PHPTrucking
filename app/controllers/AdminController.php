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

    public function banners() {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);

            if(empty($title)) {
                setFlash("Banner title is required", "error");
                header("Location: " . BASE_URL . "/banners");
                exit;
            }

            if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
                setFlash("Image upload failed", "error");
                header("Location: " . BASE_URL . "/banners");
                exit;
            }

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $fileName = $_FILES['image']['name'];
            $fileTmp = $_FILES['image']['tmp_name'];
            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if(!in_array($extension, $allowedExtensions)) {
                setFlash("Invalid image format", "error");
                header("Location: " . BASE_URL . "/banners");
                exit;
            }

            $newFileName = time() . '_' . uniqid() . '.' . $extension;
            $uploadPath = dirname(__DIR__, 2) . '/public/uploads/';
            move_uploaded_file($fileTmp, $uploadPath . $newFileName);

            $this->bannerModel->createBanner($title, $newFileName);
            setFlash("Banner uploaded successfully.", "success");
            header("Location: " . BASE_URL . "/banners");
            exit;
        }

        $banners = $this->bannerModel->getAllBanners();
        require_once '../app/views/admin/banners.php';
    }

    public function deleteBanner($id) {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

        $banner = $this->bannerModel->getBannerById($id);

        if(!$banner) {
            setFlash("Banner not found", "error");
            header("Location: " . BASE_URL . "/banners");
            exit;
        }

        $uploadPath = dirname(__DIR__, 2) . '/public/uploads/';
        $filePath = $uploadPath . $banner['image'];
        if(file_exists($filePath)) {
            unlink($filePath);
        }

        $this->bannerModel->deleteBanner($id);
        setFlash("Banner deleted successfully.", "success");
        header("Location: " . BASE_URL . "/banners");
        exit;
    }

    public function sections() {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        $sectionModel = new SectionModel();
        $sections = $sectionModel->getAllSections();
        require_once '../app/views/admin/sections.php';
    }

    public function editSection($id) {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
        $sectionModel = new SectionModel();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
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
            $sectionModel->updateSection($id, $title, $content, $image);
            setFlash("Section updated successfully.", "success");
            header("Location: " . BASE_URL . "/sections");
            exit;
        }
        
        $section = $sectionModel->getSectionById($id);
        require_once '../app/views/admin/edit_section.php';
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
}
