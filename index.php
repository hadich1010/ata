<?php 
$pageTitle = "صفحه اصلی";
$pathmain= $_SERVER['DOCUMENT_ROOT'].'/ata/';
require_once('header.php');  // درج فایل هدر
?>
<?php
session_start();

// بررسی وضعیت ورود کاربر
if (!isset($_SESSION['user_id'])) {
    header('Location: app/views/dashboard/login.php'); // اگر کاربر وارد نشده باشد، به صفحه لاگین هدایت می‌شود
    exit;
}

// نمایش داشبورد مناسب برای هر نقش
if ($_SESSION['role'] == 'admin') {
    // نمایش داشبورد ادمین

?>


<div class="sidebar">
    <h2>منو</h2>
    
    <?php 
    
  
    if ($_SESSION['role'] == 'admin') { ?>
        <!-- این بخش فقط برای ادمین نمایش داده می‌شود -->
    <ul>
        <li><a href="dashboard.php" target="contentFrame">داشبورد</a></li>
        <li><a href="view_customer.php" target="contentFrame">لیست مشتریان</a></li>
        <li><a href="add_customer.php" target="contentFrame">افزودن مشتری</a></li>
        <li><a href="atbar.php" target="contentFrame">برآورد تسهیلات</a></li>
        <li><a href="app/Views/customers/customer_edit.php" target="contentFrame">ویرایش مشتری</a></li>
    </ul>
    <?php } ?>
    <a href="http://localhost/ata/APP/views/dashboard/logout.php">خروج از حساب</a>
    </br>
    <a href="http://localhost/ata/APP/views/dashboard/login.php">لطفا وارد شوید.</a>
</div>
<div class="flex-grow-1">
    <iframe name="contentFrame" src="dashboard.php" style="width: 100%; height: 100vh; border: none;">

    </iframe>
</div>

<?php 
} elseif ($_SESSION['role'] == 'vip') { ?>


<div class="sidebar">
    <h2>منو</h2>
    
    <?php 
    
  
    if ($_SESSION['role'] == 'vip') { ?>
        <!-- این بخش فقط برای ادمین نمایش داده می‌شود -->
    <ul>
        <li><a href="dashboard.php" target="contentFrame">داشبورد</a></li>
        <li><a href="view_customer.php" target="contentFrame">لیست مشتریان</a></li>
        <li><a href="add_customer.php" target="contentFrame">افزودن مشتری</a></li>
    </ul>
    <?php } ?>
    <a href="http://localhost/ata/APP/views/dashboard/logout.php">خروج از حساب</a>
    </br>
    <a href="http://localhost/ata/APP/views/dashboard/login.php">لطفا وارد شوید.</a>
</div>
<div class="flex-grow-1">
    <iframe name="contentFrame" src="dashboard.php" style="width: 100%; height: 100vh; border: none;">

    </iframe>
</div>
<?php
} 
include('footer.php'); 

?>