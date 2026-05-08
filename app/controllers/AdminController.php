<?php

require_once '../app/core/Controller.php';
require_once '../app/models/AdminModel.php';
require_once '../app/models/SettingsModel.php';

class AdminController extends Controller {

    private $adminModel;
    private $settingsModel;

    public function __construct() {

        $this->adminModel = new AdminModel();
        $this->settingsModel = new SettingsModel();
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

        foreach($_POST as $key => $value) {

            $this->settingsModel->updateSetting($key, $value);
        }

        header("Location: " . BASE_URL . "/settings");
        exit;
    }

    $settings = $this->settingsModel->getAllSettings();

    require_once '../app/views/admin/settings.php';
}
}
