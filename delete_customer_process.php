<?php
require 'connections.php'; // اتصال به پایگاه داده

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // حذف مشتری از پایگاه داده
    $sql = "DELETE FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // بازگشت به لیست مشتریان با پیام موفقیت
        header("Location: view_customer.php?message=success");
        exit();
    } else {
        // بازگشت به لیست مشتریان با پیام خطا
        header("Location: view_customer.php?message=error");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
