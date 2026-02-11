<?php
require_once __DIR__ . '/lib/jdf.php';

$timestamp = time();
$dateArray = jdate('Y/m/d', $timestamp, '', '', 'en');
$dateParts = explode('/', $dateArray);
$dateArray = [
    'year' => $dateParts[0] ?? '',
    'month' => $dateParts[1] ?? '',
    'day' => $dateParts[2] ?? '',
];
?>
