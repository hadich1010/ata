<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['customer_image'])) {
    $totalFiles = count($_FILES['customer_image']['name']);
    
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = uniqid('customer_', true) . '.' . pathinfo($_FILES['customer_image']['name'][$i], PATHINFO_EXTENSION);
        $uploadPath = 'uploads/' . $fileName;

        // انتقال فایل به پوشه هدف
        if (move_uploaded_file($_FILES['customer_image']['tmp_name'][$i], $uploadPath)) {
            echo "تصویر $fileName با موفقیت آپلود شد.<br>";
        } else {
            echo "مشکلی در آپلود تصویر $fileName پیش آمده.<br>";
        }
    }
}
?>
