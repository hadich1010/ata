<?php
require_once 'core/Database.php';

class TableManager {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // متد برای ایجاد جدول customers
    public function createCustomersTable() {
        $sql = "CREATE TABLE IF NOT EXISTS customers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            phone_number VARCHAR(15) NOT NULL,
            national_id VARCHAR(10) NOT NULL,
            status VARCHAR(50),
            consultation_status VARCHAR(50),
            custom_datetime VARCHAR(20) DEFAULT NULL,
            job VARCHAR(100),
            additional_info TEXT,
            customer_image TEXT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if ($this->conn->query($sql) === TRUE) {
            echo "جدول 'customers' با موفقیت ایجاد شد.";
        } else {
            echo "خطا در ایجاد جدول: " . $this->conn->error;
        }
    }
    
}
?>
