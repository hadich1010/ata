<?php
$pageTitle = "افزودن مشتری"; // عنوان صفحه
require_once('header.php');  // درج فایل هدر
require_once('time-bar.php');  // درج فایل زمان
require_once 'connections.php'; // اتصال به پایگاه داده
$created_at = jdate('Y-m-d'); // تاریخ و زمان جاری
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت داده‌ها از فرم
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $phone_number = htmlspecialchars(trim($_POST['phone_number']));
    $national_id = htmlspecialchars(trim($_POST['national_id']));
    $status = htmlspecialchars(trim($_POST['status']));
    $consultation_status = htmlspecialchars(trim($_POST['consultation_status']));
    $job = htmlspecialchars(trim($_POST['job'])); 
    $additional_info = htmlspecialchars(trim($_POST['additional_info']));
    $custom_datetime = htmlspecialchars(trim($_POST['custom_datetime'])); // تاریخ و ساعت انتخاب‌شده

    // جدا کردن تاریخ و ساعت
    $datetime_parts = explode(" ", $custom_datetime);
    $registration_date = $datetime_parts[0]; // تاریخ
    $registration_time = $datetime_parts[1]; // ساعت

    // دریافت تاریخ شمسی برای created_at
    $created_at = jdate('Y/m/d'); // دریافت تاریخ شمسی از jdate

    // ساخت فولدر با نام کد ملی
    $target_dir = "uploads/" . $national_id . "/"; // فولدری با نام کد ملی
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // ایجاد فولدر اگر وجود نداشت
    }

    // آپلود تصاویر مشتری در فولدر مشخص‌شده
    $image_names = null;
    if (isset($_FILES['customer_image']) && $_FILES['customer_image']['error'][0] == 0) {
        $image_names = [];
        foreach ($_FILES['customer_image']['name'] as $key => $image) {
            $tmp_name = $_FILES['customer_image']['tmp_name'][$key];
            $target_file = $target_dir . basename($image); // مسیر کامل تصویر

            // انتقال تصویر به فولدر مربوطه
            if (move_uploaded_file($tmp_name, $target_file)) {
                $image_names[] = $target_file; // اضافه کردن نام تصویر به آرایه
            }
        }
        $image_names = implode(",", $image_names); // ترکیب نام تصاویر
    }

    // پرس‌وجو برای وارد کردن داده‌ها
    $sql = "INSERT INTO customers (full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // آماده‌سازی و اجرای پرس‌وجو
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssssss", $full_name, $phone_number, $national_id, $status, $consultation_status, $job, $additional_info, $image_names, $registration_date, $registration_time, $created_at);
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
}
?>

<div class="container-fluid">
    <div class="row bg-primary">
        <div class="col-md-5">
            <p>به بخش مدیریت مشتریان خوش آمدید</p>
        </div>
        <div class="col-md-5">
            <p>
                <?php 
                // نمایش مقادیر آرایه تاریخ شمسی
                echo "تاریخ امروز: " . $dateArray['year'] . "/" . $dateArray['month'] . "/" . $dateArray['day']; 
                ?>
            </p>
        </div>
    </div>
    <div class="col-12 text-end bg-danger">


    </div>

    <!-- فرم افزودن مشتری -->
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
                    <option value="" selected disabled>انتخاب نوع خدمات</option>
                    <option value="وام رسالت">وام رسالت</option>
                    <option value="وام مهر">وام مهر</option>
                    <option value="دسته چک">دسته چک</option>
                </select>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="consultation_status" class="form-label">وضعیت مشاوره:</label>
                <select class="form-select" id="consultation_status" name="consultation_status">
                    <option value="مشاوره تلفنی">مشاوره تلفنی</option>
                    <option value="مراجعه به دفتر">مراجعه به دفتر</option>
                    <option value="عقد قرارداد">عقد قرارداد</option>
                    <option value="سفته تحویل شد">سفته تحویل شد</option>
                    <option value="افتتاح حساب و تکمیل مدارک">افتتاح حساب و تکمیل مدارک</option>
                    <option value="اعتبار سنجی شد">اعتبار سنجی شد</option>
                    <option value="ثبت ضمانت بانکی">ثبت ضمانت بانکی</option>
                    <option value="پرونده تکمیل شد">پرونده تکمیل شد</option>
                    <option value="عودت اسناد ضمانتی">عودت اسناد ضمانتی</option>
                </select>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="custom_datetime" class="form-label">تاریخ و ساعت:</label>
                <input type="text" id="custom_datetime" name="custom_datetime" class="form-control"
                    placeholder="تاریخ و زمان را انتخاب کنید" data-jdp />
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="job" class="form-label">شغل:</label>
                <input type="text" class="form-control" id="job" name="job" required>
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
</div>


<?php 
include('footer.php');  // درج فایل فوتر
?>