<?php
require 'connections.php'; // فرض بر این است که اتصال به پایگاه داده در این فایل قرار دارد

// کد SQL برای ایجاد جدول
$sql = "CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,           -- شناسه یکتا برای هر مشتری
    full_name VARCHAR(255) NOT NULL,            -- نام و نام خانوادگی
    phone_number VARCHAR(15) NOT NULL,          -- شماره تماس
    national_id VARCHAR(10) NOT NULL,           -- کد ملی
    status VARCHAR(50),                         -- نوع خدمات
    consultation_status VARCHAR(50),            -- وضعیت مشاوره
    custom_datetime VARCHAR(20) DEFAULT NULL,   -- تاریخ و زمان به صورت رشته (مثلاً YYYY-MM-DD HH:MM:SS)
    job VARCHAR(100),                           -- شغل
    additional_info TEXT,                       -- اطلاعات بیشتر
    customer_image TEXT                         -- تصویر مشتری
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";  // تنظیمات پایگاه داده

// اجرای دستور SQL برای ایجاد جدول
if ($conn->query($sql) === TRUE) {
    echo "جدول 'customers' با موفقیت ایجاد شد.";
} else {
    echo "خطا در ایجاد جدول: " . $conn->error;
}

// بستن اتصال
$conn->close();
?>