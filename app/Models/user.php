<?php
require_once 'Database.php';
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // ورود کاربر
    public function login($username, $password) {
            echo $username . $password;
        $username = filter_var($username, FILTER_SANITIZE_STRING);

        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {         
            return $user; // برمی‌گرداند کاربر در صورت موفقیت
        } else {
            return false; // در صورت خطا
        }
    }
}
?>
