<?php 
$pageTitle = "صفحه اصلی";
require_once('header.php'); 
?>
<div class="sidebar">
        <h2>منو</h2>
        <ul>
            <li><a href="dashboard.php" target="contentFrame">داشبورد</a></li>
            <li><a href="view_customer.php" target="contentFrame">لیست مشتریان</a></li>
            <li><a href="add_customer.php" target="contentFrame">افزودن مشتری</a></li>
            <li><a href="atbar.php" target="contentFrame">برآورد تسهیلات</a></li>
            <li><a href="edit_customer.php" target="contentFrame">ویرایش مشتری</a></li>
        </ul>
    </div>
    <div class="flex-grow-1">
        <iframe name="contentFrame" src="dashboard.php" style="width: 100%; height: 100vh; border: none;">
        
        </iframe>
       
    </div>

</body>
</html>

<?php 
include('footer.php'); 
?>
