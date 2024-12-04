<?php
$pathmain= $_SERVER['DOCUMENT_ROOT'].'/ata/';
require_once '../models/Customer.php';


class CustomerController {
    public function edit($id) {
        $customer = new Customer();
        $customer_data = $customer->getCustomer($id);
        $successMessage = ''; // متغیر برای پیغام موفقیت یا خطا

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // آماده سازی داده‌ها از فرم
            $data = [
                'full_name' => isset($_POST['full_name']) && !empty($_POST['full_name']) ? $_POST['full_name'] : '', // مقدار پیش‌فرض خالی
                'phone_number' => isset($_POST['phone_number']) && !empty($_POST['phone_number']) ? $_POST['phone_number'] : '',
                'national_id' => isset($_POST['national_id']) && !empty($_POST['national_id']) ? $_POST['national_id'] : '',
                'status' => isset($_POST['status']) && is_array($_POST['status']) ? implode(", ", $_POST['status']) : '',
                'consultation_status' => isset($_POST['consultation_status']) && !empty($_POST['consultation_status']) ? $_POST['consultation_status'] : '',
                'job' => isset($_POST['job']) && !empty($_POST['job']) ? $_POST['job'] : '',
                'customer_image' => isset($_FILES['customer_image']['name']) && $_FILES['customer_image']['error'] === UPLOAD_ERR_OK 
                                    ? $_FILES['customer_image']['name'] 
                                    : '', // مقدار پیش‌فرض برای تصویر
                'additional_info' => isset($_POST['additional_info']) && !empty($_POST['additional_info']) ? $_POST['additional_info'] : '',
                'registration_date' => isset($_POST['registration_date']) && !empty($_POST['registration_date']) ? $_POST['registration_date'] : '',
                'registration_time' => isset($_POST['registration_time']) && !empty($_POST['registration_time']) ? $_POST['registration_time'] : '',
            ];
            if (!empty($data['full_name']) && !empty($data['phone_number'])) {
                // فقط اگر نام و شماره تماس پر شده باشند، بروزرسانی انجام می‌شود
                $customer->updateCustomer($data, $id);
                $_SESSION['successMessage'] = "اطلاعات با موفقیت ویرایش شد!";
            } else {
                // اگر داده‌ها ناقص بودند، پیغام خطا را نمایش دهید
                $_SESSION['errorMessage'] = "شما در بخش ویرایش اطلاعات مشتری هستید!.";
                
            }
        }

        // نمایش فرم با داده‌های مشتری
        require_once $_SERVER['DOCUMENT_ROOT'] . '/ata/app/views/customers/customer_edit.php';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $controller = new CustomerController();
    $controller->edit($id);
}
?>