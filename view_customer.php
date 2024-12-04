<?php
$pageTitle = "لیست مشتریان";
include('header.php'); 
// اتصال به پایگاه داده
require 'connections.php'; // فرض بر این است که اتصال به پایگاه داده در این فایل قرار دارد

// نمایش پیام موفقیت حذف (اگر موجود باشد)
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    if ($message == 'success') {
        echo "<div class='alert alert-success fixed-top' role='alert'>مشتری با موفقیت حذف شد.</div>";
    } elseif ($message == 'error') {
        echo "<div class='alert alert-success fixed-top' role='alert'>خطا در حذف مشتری.</div>";
    }
}

// گرفتن اطلاعات مشتریان
$sql = "SELECT id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at FROM customers";
$result = $conn->query($sql);
?>
<?php
// نمایش مقادیر ورودی برای بررسی
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function editCustomer(id) {
        // برای آزمایش، شناسه مشتری را در کنسول نمایش می‌دهیم
        console.log("ویرایش مشتری با شناسه: " + id);
        // عملیات مورد نظر را اینجا قرار دهید
    }
});
</script>
<div class="container">
    <h1>لیست مشتریان</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center">شماره</th>
                    <th scope="col" class="text-center">نام و نام خانوادگی</th>
                    <th scope="col" class="text-center">شماره تماس</th>
                    <th scope="col" class="text-center">کد ملی</th>
                    <th scope="col" class="text-center">تاریخ ثبت نام</th>
                    <th scope="col" class="text-center">تاریخ مراجعه</th>
                    <th scope="col" class="text-center">ساعت مراجعه</th>
                    <th scope="col" class="text-center">وضعیت</th>
                    <th scope="col" class="text-center">اطلاعات بیشتر</th>
                    <th scope="col" class="text-center">عملیات</th> <!-- ستون عملیات -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // محدود کردن نمایش توضیحات به 10 کاراکتر
                        $additionalInfo = (strlen($row["additional_info"]) > 10) ? substr($row["additional_info"], 0, 10) . '...' : $row["additional_info"];
                        
                        echo "<tr>";
                        echo "<td scope='row' class='text-center align-middle'>" . $row["id"] . "</td>";
                        echo "<td class='text-center align-middle'>" . $row["full_name"] . "</td>";
                        echo "<td class='text-center align-middle'>" . $row["phone_number"] . "</td>";
                        echo "<td class='text-center align-middle'>" . $row["national_id"] . "</td>";
                        echo "<td class='text-center align-middle'>" . $row["created_at"] . "</td>";
                        echo "<td class='text-center align-middle'>" . $row["registration_date"] . "</td>";
                        echo "<td class='text-center align-middle'>" . $row["registration_time"] . "</td>";
                        echo "<td class='text-center align-middle'>" . $row["status"] . "</td>";
                        echo "<td class='text-center align-middle'>
                                <a href='#' data-toggle='modal' data-target='#modal" . $row["id"] . "'>" . nl2br($additionalInfo) . "</a>
                              </td>";
                              echo "<td class='text-center align-middle d-flex'>
                              <form method='POST' action='delete_customer_process.php'>
                                  <input type='hidden' name='id' value='" . $row["id"] . "'>
                                  <button type='submit' class='btn btn-danger' onclick='return confirm(\"آیا از حذف این مشتری اطمینان دارید؟\")'>
                                      <i class='fas fa-trash'></i>
                                  </button>
                              </form>
                              
                              <!-- فرم ویرایش -->
                              <form method='POST' id='editForm' action='app/controllers/customercontroller.php'>
                                  <input type='hidden' name='id' value='" . $row['id'] . "'> <!-- ارسال شناسه مشتری -->
                                  <button type='submit' class='btn btn-warning' onclick='return confirm(\"آیا از ویرایش مشتری با شناسه " . $row['id'] . " اطمینان دارید؟\")'>
                                      <i class='fas fa-edit'></i>
                                  </button>

                              </form>
                            </td>";
                      echo "</tr>";
                      
                        
                        // مدال برای نمایش توضیحات کامل
                        echo "<div class='modal fade' id='modal" . $row["id"] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'>توضیحات مشتری</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>
                                        <div class='modal-body'>
                                            " . nl2br($row["additional_info"]) . "
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>بستن</button>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>هیچ مشتری موجود نیست</td></tr>"; // تغییر تعداد ستون‌ها
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- اضافه کردن اسکریپت‌های مورد نیاز برای بوت استرپ -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>