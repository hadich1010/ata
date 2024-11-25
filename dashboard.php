<?php 
$pageTitle = "پنل مدیریت";
require_once('header.php');  // درج فایل هدر
require_once('time-bar.php');  // درج فایل زمان 
include('functions.php');
require_once('time-bar.php');  // درج فایل هدر


?>

<div class="dashboard">
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <h1>به بخش مدیریت مشتریان خوش آمدید</h1>
            <span class="date"><?php // نمایش مقادیر آرایه
    echo "تاریخ امروز: " . $dateArray['year'] . "/" . $dateArray['month'] . "/" . $dateArray['day'];?></span>
    </nav>
    <div class="stat-box">
        <h3>مجموع مشتریان</h3>
        <p><?php echo getTotalCustomers(); ?> مشتری</p>
    </div>
    <div class="stat-box">
        <h3>مشتریان فعال</h3>
        <p><?php echo getActiveCustomers(); ?> مشتری</p>
    </div>
    <div class="stat-box">
        <h3>مشتریان از دست رفته</h3>
        <p><?php echo getLostCustomers(); ?> مشتری</p>
    </div>
    <div class="stat-box">
        <h3>مشتریان به سرانجام رسیده</h3>
        <p><?php echo getCompletedCustomers(); ?> مشتری</p>
    </div>
</div>



<?php include('footer.php'); ?>