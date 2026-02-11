<?php
$pageTitle = "صفحه اصلی";
require_once __DIR__ . '/header.php';
session_start();

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$baseUrl = ($basePath === '' || $basePath === '.') ? '' : $basePath;

// بررسی وضعیت ورود کاربر
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . $baseUrl . '/app/Views/dashboard/login.php');
    exit;
}
?>

<?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'vip'): ?>
<div class="sidebar">
    <h2>منو</h2>

    <ul>
        <li><a href="dashboard.php" target="contentFrame">داشبورد</a></li>
        <li><a href="view_customer.php" target="contentFrame">لیست مشتریان</a></li>
        <li><a href="add_customer.php" target="contentFrame">افزودن مشتری</a></li>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <li><a href="atbar.php" target="contentFrame">برآورد تسهیلات</a></li>
            <li><a href="app/Views/customers/customer_edit.php" target="contentFrame">ویرایش مشتری</a></li>
        <?php endif; ?>
    </ul>

    <a href="<?= htmlspecialchars($baseUrl . '/app/Views/dashboard/logout.php') ?>">خروج از حساب</a>
    <br>
    <a href="<?= htmlspecialchars($baseUrl . '/app/Views/dashboard/login.php') ?>">لطفا وارد شوید.</a>
    <br>
    <a href="<?= htmlspecialchars($baseUrl . '/pdf.php') ?>">چاپ pdf</a>
</div>
<div class="flex-grow-1">
    <iframe name="contentFrame" src="dashboard.php" style="width: 100%; height: 100vh; border: none;"></iframe>
</div>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
