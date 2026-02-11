<?php
session_start();
session_unset();
session_destroy();

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$basePath = preg_replace('#/app/Views/dashboard$#', '', $basePath);
$basePath = ($basePath === '' || $basePath === '.') ? '' : $basePath;

header('Location: ' . ($basePath ?: '') . '/app/Views/dashboard/login.php');
exit();
