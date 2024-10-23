<?php 
$pageTitle = "افزودن مشتری";
include('header.php'); 
?>

<div class="container">
    <h2>فرم افزودن مشتری</h2>
    <form action="add_customers.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="full_name">نام و نام خانوادگی:</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="phone_number">شماره تماس:</label>
            <input type="text" id="phone_number" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="national_id">کد ملی:</label>
            <input type="text" id="national_id" name="national_id" required>
        </div>
        <div class="form-group">
            <label for="registration_date">تاریخ ثبت نام:</label>
            <input type="text" id="registration_date" name="registration_date" required>
        </div>
        <div class="form-group">
        <label for="status">وضعیت:</label>
        <select id="status" name="status" required>
            <option value="active">فعال</option>
            <option value="lost">از دست رفته</option>
            <option value="completed">به سرانجام رسیده</option>
        </select>
    </div>
        <div class="form-group">
            <label for="additional_info">اطلاعات بیشتر:</label>
            <textarea id="additional_info" name="additional_info"></textarea>
        </div>
        <div class="form-group">
            <label for="customer_images">تصاویر مشتری:</label>
            <input type="file" id="customer_images" name="customer_images[]" multiple>
        </div>
        <button type="submit" class="btn">افزودن مشتری</button>
    </form>
</div>

<?php 
include('footer.php'); 
?>

<script>
    $(document).ready(function() {
        $('#registration_date').persianDatepicker({
            format: 'YYYY/MM/DD',
            autoClose: true,
            initialValue: false
        });
    });
</script>
