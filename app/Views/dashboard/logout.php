<?php
session_start();
session_unset(); // حذف تمام متغیرهای session
session_destroy(); // بستن session
header('Location: login.php'); // هدایت به صفحه ورود
exit();
?>
