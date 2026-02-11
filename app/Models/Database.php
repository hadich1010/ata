<?php
class Database {
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $lastError;

    // سازنده برای اتصال به پایگاه داده
    public function __construct() {
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->username = getenv('DB_USERNAME') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';
        $this->dbname = getenv('DB_NAME') ?: 'ataholding';
        $this->connect();
    }

    // متد برای اتصال به دیتابیس
    private function connect() {
        try {
            // استفاده از PDO برای اتصال به پایگاه داده
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            // تنظیم حالت خطا به استثناء برای گرفتن خطاها
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->lastError = null;
        } catch (PDOException $e) {
            $this->conn = null;
            $this->lastError = $e->getMessage();
            error_log('Database connection failed: ' . $e->getMessage());
        }
    }

    // متد برای اجرای یک پرس و جو (Query)
    public function query($sql, $params = []) {
        if (!$this->conn) {
            return false;
        }

        $stmt = $this->conn->prepare($sql);  // آماده‌سازی پرس‌وجو
        $stmt->execute($params);  // ارسال پارامترها به execute
        return $stmt;  // بازگشت نتیجه (PDOStatement)
    }

    public function getConnection() {
        return $this->conn;
    }

    public function hasConnection() {
        return $this->conn instanceof PDO;
    }

    public function getLastError() {
        return $this->lastError;
    }

    // متد برای بستن اتصال به پایگاه داده
    public function close() {
        $this->conn = null;
    }
}
?>
