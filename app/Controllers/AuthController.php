<?php
require_once '../models/User.php'; // بارگذاری مدل

class AuthController {
    private $db;
    private $userModel;
    public function __construct($db) {
        $this->db = $db;
        $this->userModel = new User($this->db); // مدل کاربری
    }

    public function login() {
        $base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/ata/';
        // بررسی اینکه آیا فرم ارسال شده است یا نه
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);

            if ($user) {
                // ذخیره سشن
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                // هدایت به صفحه اصلی
                $message = ' شما وارد شدید';
                
                header('Location: ' . $base_url . 'index.php');   
                exit;
            } else {
                // در صورت اشتباه بودن اطلاعات کاربری
                $message =  $base_url ;
                require_once $_SERVER['DOCUMENT_ROOT'] . '/ata/app/views/dashboard/login.php';
            }
        } 
        else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/ata/app/views/dashboard/login.php';    
            }
     }

    public function checkLogin() {
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'login') {
    
// ایجاد شیء از کلاس Database (اتصال به پایگاه داده)
$db = new Database();

// گرفتن اتصال به پایگاه داده
$conn = $db->getConnection();

// ایجاد شیء از کلاس AuthController و ارسال اتصال به دیتابیس
$authController = new AuthController($conn);

// فراخوانی متد login
$authController->login();
}

?>