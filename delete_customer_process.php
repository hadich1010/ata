<?php
require 'connections.php'; // اتصال به پایگاه داده

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    // حذف مشتری از پایگاه داده
    $sql = "DELETE FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "مشتری با نام $name با موفقیت حذف شد";
    } else {
        $message = "خطا در حذف مشتری: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // بازگشت به لیست مشتریان با پیام موفقیت
    header("Location: view_customer.php?message=" . urlencode($message));
    exit();
}
?>
