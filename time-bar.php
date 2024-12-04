<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ata/lib/jdf.php');
// به‌دست آوردن مقادیر تاریخ شمسی
$years = jdate('Y');  // سال شمسی
$month = jdate('m');  // ماه شمسی
$day = jdate('d');    // روز شمسی

// ذخیره مقادیر در یک آرایه
$dateArray = array(
    'year' => $years,   // ذخیره سال
    'month' => $month,   // ذخیره ماه
    'day' => $day,       // ذخیره روز
);

// تاریخ شمسی به صورت روز/ماه/سال
$shamsiDate = jdate('Y/m/d');  // تاریخ شمسی در فرمت روز/ماه/سال
?>


<script>
// تنظیم تقویم شمسی برای تاریخ مراجعه
$(document).ready(function() {
    $('#visit_date').persianDatepicker({
        format: 'YYYY/MM/DD', // فرمت تاریخ شمسی
        autoClose: true, // بستن خودکار پس از انتخاب تاریخ
        initialValue: false // تنظیم مقدار اولیه به false
    });

    // تنظیم ساعت به فرمت 12 ساعته (AM/PM)
    $('#visit_time').timepicker({
        timeFormat: 'hh:mm tt', // فرمت ساعت 12 ساعته
        interval: 30, // افزایش ساعت‌ها با فواصل 30 دقیقه‌ای
        minTime: '12:00am', // زمان شروع از 12:00 AM
        maxTime: '11:59pm', // زمان پایان در 11:59 PM
        defaultTime: '', // تنظیم زمان پیش‌فرض
        startTime: '12:00am', // زمان شروع
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});
</script>