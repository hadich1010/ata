<?php
$servername = "localhost";
$username = "root"; // نام کاربری MySQL
$password = ""; // رمز عبور MySQL
$dbname = "ataholding"; // نام پایگاه داده

// ایجاد اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
