<?php
require_once 'Database.php';
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // ورود کاربر
    public function login($username, $password) {
        $username = trim($username);

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
