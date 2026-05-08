<?php

require_once '../app/core/Controller.php';
require_once '../app/models/AdminModel.php';
require_once '../app/models/SettingsModel.php';
require_once '../app/models/BannerModel.php';

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

                echo "Invalid Username or Password";
            }

        } else {

            $this->view('login');
        }
    }

    public function dashboard() {

    if(!isset($_SESSION['admin_id'])) {

        header("Location: " . BASE_URL . "/login");
        exit;
    }

    echo "<h1>Admin Dashboard</h1>";
    echo "<pre>";

print_r($_SESSION);

echo "</pre>";
echo session_id();

    echo "<br><br>";

    echo "<a href='" . BASE_URL . "/logout'>Logout</a>";
}
    public function logout() {

    session_unset();

    session_destroy();

    header("Location: " . BASE_URL . "/login");

    exit;
}
// admin panel 

public function settings() {

    if(!isset($_SESSION['admin_id'])) {

        header("Location: " . BASE_URL . "/login");
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $this->settingsModel->updateSettings($_POST);

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

            die("Banner title is required");
        }

        if(!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {

            die("Image upload failed");
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        $fileName = $_FILES['image']['name'];

        $fileTmp = $_FILES['image']['tmp_name'];

        $extension = strtolower(
            pathinfo($fileName, PATHINFO_EXTENSION)
        );

        if(!in_array($extension, $allowedExtensions)) {

            die("Invalid image format");
        }

        $newFileName = time() . '_' . uniqid() . '.' . $extension;

        move_uploaded_file(
            $fileTmp,
            "../public/uploads/" . $newFileName
        );

        $this->bannerModel->createBanner(
            $title,
            $newFileName
        );

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

        die("Banner not found");
    }

    $filePath = "../public/uploads/" . $banner['image'];

    if(file_exists($filePath)) {

        unlink($filePath);
    }

    $this->bannerModel->deleteBanner($id);

    header("Location: " . BASE_URL . "/banners");

    exit;
}
}
