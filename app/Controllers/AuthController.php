<?php
require_once __DIR__ . '/../Models/Database.php';
require_once __DIR__ . '/../Models/user.php';

class AuthController {
    private $db;
    private $userModel;

    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new User($this->db);
    }

    public function login() {
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        $basePath = preg_replace('#/app/Controllers$#', '', $basePath);
        $basePath = ($basePath === '' || $basePath === '.') ? '' : $basePath;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->login($username, $password);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                header('Location: ' . ($basePath ?: '') . '/index.php');
                exit;
            }

            $message = 'نام کاربری یا رمز عبور اشتباه است.';
            require __DIR__ . '/../Views/dashboard/login.php';
            return;
        }

        require __DIR__ . '/../Views/dashboard/login.php';
    }

    public function checkLogin() {
        return isset($_SESSION['user_id']);
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'login') {
    $db = new Database();
    $conn = $db->getConnection();

    $authController = new AuthController($conn);
    $authController->login();
}
