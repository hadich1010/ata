<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    if (preg_match('#^(.*?)/app/(Views|Controllers)/#i', $requestUri, $matches)) {
        $baseUrl = $matches[1];
    } else {
        $baseUrl = rtrim(dirname($scriptName), '/\\');
        $baseUrl = ($baseUrl === '.' || $baseUrl === '/') ? '' : $baseUrl;
    }
    ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl . '/css/bootstrap.min.css') ?>" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl . '/dist/jalalidatepicker.css') ?>" />
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl . '/style.css') ?>">
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
