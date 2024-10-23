<?php
$pageTitle = "لیست مشتریان";
include('header.php'); 
// اتصال به پایگاه داده
require 'connections.php'; // فرض بر این است که اتصال به پایگاه داده در این فایل قرار دارد

// گرفتن اطلاعات مشتریان
$sql = "SELECT id, full_name, phone_number, national_id, registration_date, status, additional_info FROM customers";
$result = $conn->query($sql);
?>

<div class="container">
    <h1>لیست مشتریان</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>شماره</th>
                <th>نام و نام خانوادگی</th>
                <th>شماره تماس</th>
                <th>کد ملی</th>
                <th>تاریخ ثبت نام</th>
                <th>وضعیت</th>
                <th>اطلاعات بیشتر</th>
                <th>پاک کردن</th> <!-- ستون حذف -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["full_name"] . "</td>";
                    echo "<td>" . $row["phone_number"] . "</td>";
                    echo "<td>" . $row["national_id"] . "</td>";
                    echo "<td>" . $row["registration_date"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["additional_info"] . "</td>";
                    echo "<td>
                            <form method='POST' action='delete_customer.php'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <input type='hidden' name='name' value='" . $row["full_name"] . "'>
                                <button type='submit' class='btn btn-loan'>
                                   
                                </button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                
            } else {
                echo "<tr><td colspan='8'>هیچ مشتری موجود نیست</td></tr>"; // تغییر تعداد ستون‌ها
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    
</div>

