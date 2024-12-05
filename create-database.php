<?php
require_once('time-bar.php');  // درج فایل زمان
require_once 'connections.php'; // اتصال به پایگاه داده

// دریافت تاریخ شمسی و تبدیل آن به فرمت 'Y-m-d H:i:s'
// تبدیل تاریخ شمسی به میلادی
$persian_date = jdate('Y-m-d'); // تاریخ شمسی به فرمت 'YYYY-MM-DD'
$persian_time = date('H:i:s'); // ساعت به فرمت 'HH:MM:SS'

// تبدیل تاریخ شمسی به میلادی برای استفاده در پایگاه داده
$datetime = jdate('Y-m-d H:i:s'); // تاریخ و ساعت شمسی تبدیل به میلادی

// کد SQL برای ایجاد جدول
$sql = "CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    national_id VARCHAR(15) NOT NULL,
    status VARCHAR(50),
    consultation_status VARCHAR(50),
    job VARCHAR(100),
    additional_info TEXT,
    customer_image TEXT,
    registration_date VARCHAR(10) DEFAULT NULL,
    registration_time TIME DEFAULT NULL,
    created_at VARCHAR(10) DEFAULT NULL -- فیلد تاریخ و زمان ایجاد
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// اجرای دستور SQL برای ایجاد جدول
if ($conn->query($sql) === TRUE) {
    echo "جدول 'customers' با موفقیت ایجاد شد.";
} else {
    echo "خطا در ایجاد جدول: " . $conn->error;
}

// کد SQL برای ایجاد جدول users با مقادیر پیش‌فرض
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE DEFAULT 'admin',  -- مقدار پیش‌فرض 'admin' برای نام کاربری
    password VARCHAR(255) DEFAULT 'admin',       -- مقدار پیش‌فرض 'admin' برای پسورد
    role ENUM('admin', 'user', 'vip') DEFAULT 'admin',  -- مقدار پیش‌فرض 'admin' برای نقش
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";

// اجرای دستور SQL برای ایجاد جدول users
if ($conn->query($sql_users) === TRUE) {
    echo "جدول 'users' با موفقیت ایجاد شد.";
} else {
    echo "خطا در ایجاد جدول users: " . $conn->error;
}
// پرس‌وجو برای وارد کردن داده‌ها
$sql_insert = "INSERT INTO customers (full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// آماده‌سازی و اجرای پرس‌وجو
if ($stmt = $conn->prepare($sql_insert)) {
    // بایند کردن داده‌ها به پرس‌وجو
    $stmt->bind_param("sssssssssss", $full_name, $phone_number, $national_id, $status, $consultation_status, $job, $additional_info, $image_names, $registration_date, $registration_time, $datetime);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>اطلاعات با موفقیت ثبت شد!</div>";
    } else {
        echo "<div class='alert alert-danger'>خطا در ثبت اطلاعات: " . $stmt->error . "</div>";
    }
    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>خطا در آماده‌سازی پرس‌وجو: " . $conn->error . "</div>";
}

// بستن اتصال
$conn->close();
?>
