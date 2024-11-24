<?php
// اتصال به دیتابیس
require_once 'connections.php';
require_once 'header.php';

// نام فایل بکاپ
$backupDir = "backups/";
$backupFile = $backupDir . "backup_" . date("Y-m-d_H-i-s") . ".sql";

// اگر پوشه بکاپ وجود ندارد، آن را بسازید
if (!file_exists($backupDir)) {
    mkdir($backupDir, 0777, true);
}

// گرفتن لیست جداول دیتابیس
$query = "SHOW TABLES";
$tables = $conn->query($query);

// شروع بکاپ
$backupContent = "-- بکاپ از دیتابیس $dbname --\n\n";

while ($row = $tables->fetch_row()) {
    $table = $row[0];
    
    // گرفتن ساختار جدول
    $query = "SHOW CREATE TABLE $table";
    $result = $conn->query($query);
    $row = $result->fetch_row();
    $backupContent .= "-- ساختار جدول $table\n";
    $backupContent .= $row[1] . ";\n\n";

    // گرفتن داده‌های جدول
    $query = "SELECT * FROM $table";
    $result = $conn->query($query);

    // افزودن داده‌ها به فایل بکاپ
    while ($data = $result->fetch_assoc()) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $backupContent .= "INSERT INTO $table ($columns) VALUES ($values);\n";
    }

    $backupContent .= "\n";
}
?>
<div class="container">
    <div class="row">
        <?php
// ذخیره بکاپ در فایل
file_put_contents($backupFile, $backupContent);

echo "<div class='alert alert-success' role='alert'>
        بکاپ با موفقیت انجام شد و در فایل $backupFile ذخیره شد.
      </div>";  
?>
    </div>
</div>
<?php
  require_once 'footer.php';
?>