<?php
class Database {
    private $host = 'localhost';    // میزبان
    private $username = 'root';     // نام کاربری
    private $password = '';         // رمز عبور
    private $dbname = 'ataholding'; // نام پایگاه داده
    private $conn;

    // سازنده برای اتصال به پایگاه داده
    public function __construct() {
        $this->connect();
    }

    // متد برای اتصال به دیتابیس
    private function connect() {
        try {
            // استفاده از PDO برای اتصال به پایگاه داده
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // تنظیم حالت خطا به استثناء برای گرفتن خطاها
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "اتصال به پایگاه داده برقرار نشد: " . $e->getMessage();
        }
    }

    // متد برای اجرای یک پرس و جو (Query)
    // متد برای اجرای یک پرس و جو (Query)
    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);  // آماده‌سازی پرس‌وجو
        $stmt->execute($params);  // ارسال پارامترها به execute
        return $stmt;  // بازگشت نتیجه (PDOStatement)
    }

 

    // متد برای بستن اتصال به پایگاه داده
    public function close() {
        $this->conn = null;
    }
}
?>