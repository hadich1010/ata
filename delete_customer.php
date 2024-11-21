<?php 
$pageTitle = "حذف مشتری";
include('header.php'); 
require 'connections.php'; // اتصال به پایگاه داده

// نمایش پیام‌های موفقیت یا خطا
if (isset($_GET['message'])) {
    if ($_GET['message'] == 'success') {
        echo '<p style="color: green;">مشتری با موفقیت حذف شد.</p>';
    } elseif ($_GET['message'] == 'error') {
        echo '<p style="color: red;">خطا در حذف مشتری.</p>';
    }
}

// اتصال به دیتابیس و دریافت لیست مشتریان
$sql = "SELECT id, full_name, phone_number, national_id, custom_datetime FROM customers";
$result = $conn->query($sql);
?>

<div class="container">
    <h2>حذف مشتری</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <form action="delete_customer_process.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>نام و نام خانوادگی</th>
                        <th>شماره تماس</th>
                        <th>کد ملی</th>
                        <th>تاریخ ثبت نام</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['national_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['custom_datetime']); ?></td>
                            <td>
                                <button type="submit" name="delete_id" value="<?php echo htmlspecialchars($row['id']); ?>">حذف</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>
    <?php else: ?>
        <p>هیچ مشتری‌ای برای نمایش وجود ندارد.</p>
    <?php endif; ?>
</div>

<?php 
include('footer.php'); 
?>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // حذف مشتری از پایگاه داده
    $sql = "DELETE FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "مشتری با موفقیت حذف شد";
    } else {
        echo "خطا در حذف مشتری: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // بازگشت به لیست مشتریان
    header("Location: view_customer.php");
    exit();
}
?>
