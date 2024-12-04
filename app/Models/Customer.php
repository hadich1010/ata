<?php
require_once 'Database.php';
session_start(); // شروع سشن


class Customer {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // دریافت اطلاعات مشتری
    // دریافت اطلاعات مشتری
    public function getCustomer($id) {
        // استفاده از متد query که در کلاس Database تعریف شده
        $sql = "SELECT * FROM customers WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);  // ارسال پارامتر $id به متد query
        $data = $stmt->fetch(PDO::FETCH_ASSOC);  // دریافت نتیجه به صورت آرایه
        return $data;  // بازگشت داده‌ها
    }

    

    // به‌روزرسانی اطلاعات مشتری
    public function updateCustomer($data, $id) {
        $sql = "UPDATE customers SET 
                    full_name = ?, 
                    phone_number = ?, 
                    national_id = ?, 
                    status = ?, 
                    consultation_status = ?, 
                    job = ?, 
                    additional_info = ?, 
                    customer_image = ?, 
                    registration_date = ?, 
                    registration_time = ? 
                WHERE id = ?";
        
        $params = [
            $data['full_name'],
            $data['phone_number'],
            $data['national_id'],
            $data['status'],
            $data['consultation_status'],
            $data['job'],
            $data['additional_info'],
            $data['customer_image'],
            $data['registration_date'],
            $data['registration_time'],
            $id
        ];
        $this->db->query($sql, $params);
      
      

    }
    
    public function close() {
        $this->db->close();
    }
}


?>