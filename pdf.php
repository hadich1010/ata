<?php
require_once __DIR__ . '/vendor/autoload.php'; // بارگذاری Mpdf
require 'connections.php'; // اتصال به پایگاه داده

// دریافت شناسه مشتری از URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // گرفتن اطلاعات مشتری از پایگاه داده
    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
     // تنظیم فونت فارسی در Mpdf
     $mpdf = new \Mpdf\Mpdf([
        'default_font' => 'vazir', // نام فونت پیش‌فرض
        'format' => 'A4', // اندازه صفحه
    ]);

    // اضافه کردن فونت (اگر بخواهید فونت‌های بیشتری اضافه کنید)
    // تنظیم عنوان فایل PDF
    $mpdf->SetTitle('گزارش مشتری');

    // تنظیم فونت برای استفاده در سند (در اینجا از فونت IRYekan استفاده می‌کنیم)
        
        // محتوای HTML
        $html = '
        <!DOCTYPE html>
        <html lang="fa">
        <head>
            <meta charset="UTF-8">
             <style>
                @font-face {
                font-family: "iryekan";
                src: url("' . __DIR__ . '/fonts/vazir.ttf") format("truetype");
            }
                body {
                    font-family: vazir;
                    direction: rtl;
                    text-align: right;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 10px;
                }
                th {
                    background-color: #f2f2f2;
                }
                h1 {
                    color: #212121;
                }
            </style>
        </head>
        <body>
            <h1>گزارش مشتری</h1>
            <table>
                <tr>
                    <th>عنوان</th>
                    <th>مقدار</th>
                </tr>
                <tr>
                    <td>نام و نام خانوادگی</td>
                    <td>' . htmlspecialchars($row['full_name']) . '</td>
                </tr>
                <tr>
                    <td>شماره تماس</td>
                    <td>' . htmlspecialchars($row['phone_number']) . '</td>
                </tr>
                <tr>
                    <td>کد ملی</td>
                    <td>' . htmlspecialchars($row['national_id']) . '</td>
                </tr>
                <tr>
                    <td>وضعیت</td>
                    <td>' . htmlspecialchars($row['status']) . '</td>
                </tr>
                <tr>
                    <td>تاریخ ثبت نام</td>
                    <td>' . htmlspecialchars($row['created_at']) . '</td>
                </tr>
                <tr>
                    <td>تاریخ مراجعه</td>
                    <td>' . htmlspecialchars($row['registration_date']) . '</td>
                </tr>
                <tr>
                    <td>ساعت مراجعه</td>
                    <td>' . htmlspecialchars($row['registration_time']) . '</td>
                </tr>
                <tr>
                    <td>توضیحات بیشتر</td>
                    <td>' . nl2br(htmlspecialchars($row['additional_info'])) . '</td>
                </tr>
            </table>
        </body>
        </html>';

        // تولید PDF
        $mpdf->WriteHTML($html);
        $mpdf->Output('customer-report.pdf', 'I'); // 'I' برای نمایش در مرورگر
    } else {
        echo "مشتری یافت نشد.";
    }
} else {
    echo "شناسه مشتری ارسال نشده است.";
}

// بستن اتصال به پایگاه داده
$conn->close();
?>