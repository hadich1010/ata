<?php
// بررسی اینکه آیا فرم ارسال شده است
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // دریافت داده‌ها از فرم و جلوگیری از حملات XSS
    $name = htmlspecialchars($_POST['name']);
    $custom_datetime = htmlspecialchars($_POST['custom_datetime']);

    // نمایش داده‌ها در یک alert جاوااسکریپت
    echo "<script>alert('نام وارد شده: " . $name . "\\nتاریخ و زمان: " . $custom_datetime . "');</script>";
}

$pageTitle = "افزودن مشتری"; // عنوان صفحه
include('header.php');  // درج فایل هدر
include('time-bar.php');  // درج فایل هدر
?>

<h2>فرم ورود نام و تاریخ</h2>

<!-- فرم ورود نام و تاریخ -->
<form action="" method="POST">
    <div class="col-12 col-md-6 mb-3">
        <label for="name">نام:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>

    <div class="col-12 col-md-6 mb-3">
        <label for="custom_datetime">تاریخ و زمان :</label>
        <input type="text" id="custom_datetime" name="custom_datetime" class="form-control" placeholder="تاریخ و زمان را انتخاب کنید" data-jdp required />
    </div>
    <button type="submit">ارسال</button>
</form>

<?php 
include('footer.php');  // درج فایل فوتر
?>
