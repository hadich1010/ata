<?php 
$pageTitle = "پنل مدیریت";
include('header.php'); 
include('functions.php');
?>

<h1>به بخش مدیریت مشتریان خوش آمدید</h1>

<div class="dashboard">
        <h1>به بخش مدیریت مشتریان خوش آمدید</h1>
        
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
