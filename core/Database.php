<?php
class Database {
    private static $instance = null; // ذخیره یک نمونه از اتصال
    private $conn; // اتصال به پایگاه داده

    // اطلاعات اتصال
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ataholding";

    // جلوگیری از ساخت مستقیم شیء
    private function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // بررسی اتصال
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // تنظیم charset
        $this->conn->set_charset("utf8mb4");
    }

    // دریافت نمونه Singleton
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        var_dump(self::$instance);
        return self::$instance;
    }

    // دسترسی به شیء اتصال
    public function getConnection() {
        return $this->conn;
    }

    // جلوگیری از کلون شدن
    private function __clone() {}

    // جلوگیری از unserialize شدن
    private function __wakeup() {}
}
?>
