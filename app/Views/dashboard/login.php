<?php
$pageTitle = "ورود کاربر";
$rootPath = dirname(__DIR__, 3);
require_once $rootPath . '/header.php';

session_start();

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$basePath = preg_replace('#/app/Views/dashboard$#', '', $basePath);
$basePath = ($basePath === '' || $basePath === '.') ? '' : $basePath;

// بررسی وضعیت ورود کاربر
if (isset($_SESSION['user_id'])) {
    header('Location: ' . ($basePath ?: '/') . '/index.php');
    exit;
}
?>
<main class="d-flex justify-content-center align-items-center vh-100 w-100 bg-light">
  <form class="text-center p-4 bg-white shadow rounded w-25" method="POST" action="<?= htmlspecialchars(($basePath ?: '') . '/app/Controllers/AuthController.php?action=login') ?>">
    <img class="mb-4" src="<?= htmlspecialchars(($basePath ?: '') . '/uploads/custome-image/logo.png') ?>" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">ورود</h1>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" name="username" placeholder="نام کاربری">
      <label for="floatingInput">نام کاربری</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="رمزعبور">
      <label for="floatingPassword">رمزعبور</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> فراموشی
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">ورود</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2023–2024</p>
    <?php if (isset($message)) { echo $message; } ?>
  </form>
</main>
<?php require_once $rootPath . '/footer.php'; ?>
