<?php
// اطلاعات اتصال به پایگاه داده
include_once('connections.php');

// دریافت داده‌های فرم
$full_name = $_POST['full_name'];
$phone_number = $_POST['phone_number'];
$national_id = $_POST['national_id'];
$status = $_POST['status'];
$consultation_status = $_POST['consultation_status'];
$job = $_POST['job'];
$additional_info = $_POST['additional_info'];

// تاریخ و زمان
$visit_date = $_POST['custom_datetime']; // تاریخ و زمان

// ایجاد شناسه مشتری
$customer_id = uniqid('customer_'); // شناسه یکتا برای مشتری

// ایجاد پوشه برای ذخیره تصاویر
$folder_path = 'images/customer/' . $customer_id;
if (!is_dir($folder_path)) {
    mkdir($folder_path, 0777, true); // ایجاد پوشه در صورتی که وجود نداشته باشد
}

// آپلود تصاویر مشتری
$upload_status = [];
if (isset($_FILES['customer_image'])) {
    foreach ($_FILES['customer_image']['tmp_name'] as $index => $file_tmp) {
        $file_name = $_FILES['customer_image']['name'][$index];
        $file_size = $_FILES['customer_image']['size'][$index];
        $file_error = $_FILES['customer_image']['error'][$index];

        if ($file_error === 0) {
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = uniqid() . '.' . $file_extension;
            $file_dest = $folder_path . '/' . $new_file_name;

            // انتقال فایل به پوشه
            if (move_uploaded_file($file_tmp, $file_dest)) {
                $upload_status[] = "تصویر $file_name با موفقیت آپلود شد.";
            } else {
                $upload_status[] = "خطا در آپلود تصویر $file_name.";
            }
        } else {
            $upload_status[] = "خطا در آپلود تصویر $file_name.";
        }
    }
}

// آماده‌سازی داده‌ها برای ذخیره در پایگاه داده
$shamsiDate = jdate('Y/m/d'); // تاریخ شمسی

// دستور SQL برای درج داده‌ها در پایگاه داده
$sql = "INSERT INTO customers (full_name, phone_number, national_id, status, consultation_status, job, additional_info, registration_date)
        VALUES ('$full_name', '$phone_number', '$national_id', '$status', '$consultation_status', '$job', '$additional_info', '$shamsi
