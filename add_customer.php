<?php
$pageTitle = "افزودن مشتری"; // عنوان صفحه
include('header.php');  // درج فایل هدر
include('time-bar.php');  // درج فایل هدر
require 'connections.php'; // فرض بر این است که اتصال به پایگاه داده در این فایل قرار دارد
?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center">فرم افزودن مشتری</h2> <!-- عنوان فرم -->
        </div>
        <div class="col-12 text-end">
            <span class="text-muted">
                <?php echo "تاریخ امروز: " . $dateArray['year'] . "/" . $dateArray['month'] . "/" . $dateArray['day'];?>
                <!-- نمایش تاریخ امروز -->
            </span>
        </div>
    </div>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت داده‌ها از فرم
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $national_id = $_POST['national_id'];
    $status = $_POST['status'];
    $consultation_status = $_POST['consultation_status'];
    $custom_datetime = $_POST['custom_datetime'];
    $job = $_POST['job'];
    $additional_info = $_POST['additional_info'];

    // آپلود تصویر مشتری
    if (isset($_FILES['customer_image']) && $_FILES['customer_image']['error'] == 0) {
        $image_names = [];
        foreach ($_FILES['customer_image']['name'] as $key => $image) {
            $tmp_name = $_FILES['customer_image']['tmp_name'][$key];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image);
            move_uploaded_file($tmp_name, $target_file);
            $image_names[] = $target_file;
        }
        $image_names = implode(",", $image_names);  // ترکیب نام تصاویر برای ذخیره‌سازی
    } else {
        $image_names = null;
    }

    // پرس و جو برای وارد کردن داده‌ها به دیتابیس
    $sql = "INSERT INTO customers (full_name, phone_number, national_id, status, consultation_status, custom_datetime, job, additional_info, customer_image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // آماده‌سازی پرس و جو
    if ($stmt = $conn->prepare($sql)) {
        // بایند کردن مقادیر به پرس و جو
        $stmt->bind_param("sssssssss", $full_name, $phone_number, $national_id, $status, $consultation_status, $custom_datetime, $job, $additional_info, $image_names);
        
        // اجرا کردن پرس و جو
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>اطلاعات با موفقیت وارد شد!</div>";
        } else {
            echo "<div class='alert alert-danger'>خطا در وارد کردن اطلاعات.</div>";
        }
        
        // بستن پرس و جو
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>خطا در آماده‌سازی پرس و جو.</div>";
    }

    // بستن اتصال
    $conn->close();
}
?>



    <!-- HTML فرم -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label for="full_name" class="form-label">نام و نام خانوادگی:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="phone_number" class="form-label">شماره تماس:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="national_id" class="form-label">کد ملی:</label>
                <input type="text" class="form-control" id="national_id" name="national_id" required>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="status" class="form-label">نوع خدمات:</label>
                <select class="form-select" id="status" name="status">
                    <option selected>لیست خدمات</option>
                    <option value="وام رسالت">بانک رسالت</option>
                    <option value="وام مهر">بانک مهر</option>
                    <option value="دسته چک">دسته چک</option>
                </select>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="consultation_status" class="form-label">وضعیت مشاوره:</label>
                <select class="form-select" id="consultation_status" name="consultation_status">
                    <option selected>انتخاب وضعیت</option>
                    <option value="consulted">مشاوره شد</option>
                    <option value="documents_submitted">ارسال مدارک</option>
                    <option value="file_created">تشکیل پرونده</option>
                </select>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="custom_datetime">تاریخ و زمان :</label>
                <input type="text" id="custom_datetime" name="custom_datetime" class="form-control"
                    placeholder="تاریخ و زمان را انتخاب کنید" data-jdp />
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="job" class="form-label">شغل:</label>
                <input type="text" class="form-control" id="job" name="job" placeholder="مثال: مهندس، معلم" required>
            </div>
            <div class="col-12 mb-3">
                <label for="additional_info" class="form-label">اطلاعات بیشتر:</label>
                <textarea class="form-control" id="additional_info" name="additional_info" rows="3"></textarea>
            </div>
            <div class="col-12 mb-3">
                <label for="customer_image" class="form-label">تصویر مشتری:</label>
                <input type="file" class="form-control" id="customer_image" name="customer_image[]" multiple>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-outline-success">افزودن مشتری</button>
            </div>
        </div>
    </form>

    <?php 
include('footer.php');  // درج فایل فوتر
?>