<?php
$pageTitle = "ویرایش مشتری"; // عنوان صفحه
$rootPath = dirname(__DIR__, 3);
require_once $rootPath . '/header.php';
include_once $rootPath . '/time-bar.php';

?>


<div class="container-fluid">
    <div class="row bg-primary pt-3">
        <div class="col-md-6">
            <p>به بخش مدیریت مشتریان خوش آمدید</p>
        </div>
        <div class="col-md-6 text-start">
            <p>
                <?php 
                // نمایش مقادیر آرایه تاریخ شمسی
                echo "تاریخ امروز: " . $dateArray['year'] . "/" . $dateArray['month'] . "/" . $dateArray['day']; 
                ?>
            </p>
        </div>
    </div>


    <!-- فرم افزودن مشتری -->

    <form action="" method="POST" enctype="multipart/form-data" class="mt-2">
    <div class="row">
    <input type="hidden" name="id" value="<?= $customer_data['id']; ?>">

        <div class="col-12 col-md-6 mb-3">
            <label for="full_name" class="form-label">نام و نام خانوادگی:</label>
            <input type="text" class="form-control" id="full_name" name="full_name" 
                   value="<?= htmlspecialchars($customer_data['full_name']); ?>" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="phone_number" class="form-label">شماره تماس:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" 
                   value="<?= htmlspecialchars($customer_data['phone_number']); ?>" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="national_id" class="form-label">کد ملی:</label>
            <input type="text" class="form-control" id="national_id" name="national_id" 
                   value="<?= htmlspecialchars($customer_data['national_id']); ?>" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label">نوع خدمات:</label>
            <div class="d-flex align-items-center">
                <label class="form-label">وام رسالت:</label>
                <input class="form-check-input p-3 m-3" type="checkbox" name="status[]" value="وام رسالت" 
                       <?= strpos($customer_data['status'], 'وام رسالت') !== false ? 'checked' : ''; ?>>
                <label class="form-label">وام مهر:</label>
                <input class="form-check-input p-3 m-3" type="checkbox" name="status[]" value="وام مهر" 
                       <?= strpos($customer_data['status'], 'وام مهر') !== false ? 'checked' : ''; ?>>
                <label class="form-label">دسته چک:</label>
                <input class="form-check-input p-3 m-3" type="checkbox" name="status[]" value="دسته چک" 
                       <?= strpos($customer_data['status'], 'دسته چک') !== false ? 'checked' : ''; ?>>
            </div>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label for="consultation_status" class="form-label">وضعیت مشاوره:</label>
            <select class="form-select" id="consultation_status" name="consultation_status">
                <?php
                $options = [
                    "مشاوره تلفنی", "مشاوره تلفنی نامشخص", "مراجعه به دفتر", "عقد قرارداد",
                    "سفته تحویل شد", "افتتاح حساب و تکمیل مدارک", "اعتبار سنجی شد",
                    "ثبت ضمانت بانکی", "پرونده تکمیل شد", "عودت اسناد ضمانتی"
                ];
                foreach ($options as $option) {
                    $selected = $customer_data['consultation_status'] === $option ? 'selected' : '';
                    echo "<option value='$option' $selected>$option</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label for="registration_date" class="form-label">تاریخ:</label>
            <input type="text" id="registration_date" name="registration_date" class="form-control" 
                   value="<?= htmlspecialchars($customer_data['registration_date']); ?>" 
                   placeholder="تاریخ را انتخاب کنید" data-jdp />
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="registration_time" class="form-label">ساعت:</label>
            <input type="text" id="registration_time" name="registration_time" class="form-control" 
                   value="<?= htmlspecialchars($customer_data['registration_time']); ?>" 
                   placeholder="ساعت را وارد کنید" />
        </div>

        <div class="col-12 col-md-6 mb-3">
            <label for="job" class="form-label">شغل:</label>
            <input type="text" class="form-control" id="job" name="job" 
                   value="<?= htmlspecialchars($customer_data['job']); ?>" required>
        </div>

        <div class="col-12 mb-3">
            <label for="additional_info" class="form-label">اطلاعات بیشتر:</label>
            <textarea class="form-control" id="additional_info" name="additional_info" rows="3"><?= htmlspecialchars($customer_data['additional_info']); ?></textarea>
        </div>

        <div class="col-12 mb-3">
            <label for="customer_image" class="form-label">تصویر مشتری:</label>
            <input type="file" class="form-control" id="customer_image" name="customer_image[]" multiple>
        </div>

        <div class="col-12 text-start">
            <button type="submit" class="btn btn-primary">ثبت ویرایش</button>
        </div>
    </div>
</form>


</div>


<?php 

// نمایش پیام موفقیت
if (isset($_SESSION['successMessage'])) {
    echo '<div class="alert alert-success fixed-top text-center">' . htmlspecialchars($_SESSION['successMessage']) . '</div>';
    unset($_SESSION['successMessage']); // پاک کردن پیام پس از نمایش
}

// نمایش پیام خطا
if (isset($_SESSION['errorMessage'])) {
    echo '<div class="alert alert-warning fixed-top text-center">' . htmlspecialchars($_SESSION['errorMessage']) . '</div>';
    unset($_SESSION['errorMessage']); // پاک کردن پیام پس از نمایش
}


include $rootPath . '/footer.php';  // درج فایل فوتر
?>