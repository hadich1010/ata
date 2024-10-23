<?php
$pageTitle = "پردازش اطلاعات";
include('header.php');

function numberToWords($number) {
    $words = [
        0 => 'صفر', 1 => 'یک', 2 => 'دو', 3 => 'سه', 4 => 'چهار',
        5 => 'پنج', 6 => 'شش', 7 => 'هفت', 8 => 'هشت', 9 => 'نه',
        10 => 'ده', 11 => 'یازده', 12 => 'دوازده', 13 => 'سیزده', 14 => 'چهارده',
        15 => 'پانزده', 16 => 'شانزده', 17 => 'هفده', 18 => 'هجده', 19 => 'نوزده',
        20 => 'بیست', 30 => 'سی', 40 => 'چهل', 50 => 'پنجاه', 60 => 'شصت',
        70 => 'هفتاد', 80 => 'هشتاد', 90 => '90', 100 => 'صد', 1000 => 'هزار',
        1000000 => 'میلیون', 1000000000 => 'میلیارد'
    ];

    if ($number < 0) {
        return 'منفی ' . numberToWords(-$number);
    }

    if ($number < 21) {
        return $words[$number];
    }

    if ($number < 100) {
        $unit = $number % 10;
        $ten = $number - $unit;
        return $words[$ten] . ($unit ? ' و ' . $words[$unit] : '');
    }

    if ($number < 1000) {
        $hundred = intval($number / 100);
        $rest = $number % 100;
        return $words[$hundred] . ' صد' . ($rest ? ' و ' . numberToWords($rest) : '');
    }

    if ($number < 1000000) {
        $thousand = intval($number / 1000);
        $rest = $number % 1000;
        return numberToWords($thousand) . ' هزار' . ($rest ? ' و ' . numberToWords($rest) : '');
    }

    if ($number < 1000000000) {
        $million = intval($number / 1000000);
        $rest = $number % 1000000;
        return numberToWords($million) . ' میلیون' . ($rest ? ' و ' . numberToWords($rest) : '');
    }

    $billion = intval($number / 1000000000);
    $rest = $number % 1000000000;
    return numberToWords($billion) . ' میلیارد' . ($rest ? ' و ' . numberToWords($rest) : '');
}
// نمونه استفاده

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت داده از فرم
    $input = $_POST['inputField'];
    
    // حذف کاماها از ورودی
    $input = str_replace(',', '', $input);
    
    // پردازش داده
    echo "مقدار متناسب وارد شده : " . numberToWords($input) . ' تومان';
} else {
    echo "فرم ارسال نشده است.";
}

$twelve_months = $input * 12;
$discount_twelve = $twelve_months * 0.23;
$twelve_month = $twelve_months - $discount_twelve;

$eighteen_months = $input * 18;
$discount_eighteen = $eighteen_months * 0.345;
$eighteen_month = $eighteen_months - $discount_eighteen;

$twenty_four_months = $input * 24;
$discount_twenty_four = $twenty_four_months * 0.46;
$twenty_four_month = $twenty_four_months - $discount_twenty_four;

?>
 <h3>نتایج</h3>
 <?php
echo "
     <table>
            <thead>
                <tr>
                    <th>دوره بازپرداخت</th>
                    <th>بازپرداخت</th>
                    <th>مبلغ نهایی</th>
                    <th>میزان سود</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>12 ماهه</td>
                    <td>" . number_format($twelve_months) . " تومان</td>
                    <td>" . number_format($twelve_month) . " تومان</td>
                    <td>" . number_format($discount_twelve) . " تومان</td>
                </tr>
                <tr>
                    <td>18 ماهه</td>
                    <td>" . number_format($eighteen_months) . " تومان</td>
                    <td>" . number_format($eighteen_month) . " تومان</td>
                    <td>" . number_format($discount_eighteen) . " تومان</td>
                </tr>
                <tr>
                    <td>24 ماهه</td>
                    <td>" . number_format($twenty_four_months) . " تومان</td>
                    <td>" . number_format($twenty_four_month) . " تومان</td>
                    <td>" . number_format($discount_twenty_four) . " تومان</td>
                </tr>
            </tbody>
        </table>";
?>

<button onclick='printPage()'>پرینت</button>
<button onclick='goBack()'>بازگشت به صفحه قبلی</button>
</div>
<?php include('footer.php') ?>