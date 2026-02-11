<?php
require_once __DIR__ . '/../Models/Customer.php';

class CustomerController {
    public function edit($id) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $customer = new Customer();
        $customer_data = $customer->getCustomer($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'full_name' => $_POST['full_name'] ?? '',
                'phone_number' => $_POST['phone_number'] ?? '',
                'national_id' => $_POST['national_id'] ?? '',
                'status' => isset($_POST['status']) && is_array($_POST['status']) ? implode(', ', $_POST['status']) : '',
                'consultation_status' => $_POST['consultation_status'] ?? '',
                'job' => $_POST['job'] ?? '',
                'customer_image' => isset($_FILES['customer_image']['name']) ? (is_array($_FILES['customer_image']['name']) ? implode(',', $_FILES['customer_image']['name']) : $_FILES['customer_image']['name']) : '',
                'additional_info' => $_POST['additional_info'] ?? '',
                'registration_date' => $_POST['registration_date'] ?? '',
                'registration_time' => $_POST['registration_time'] ?? '',
            ];

            if (!empty($data['full_name']) && !empty($data['phone_number'])) {
                $customer->updateCustomer($data, $id);
                $_SESSION['successMessage'] = 'اطلاعات با موفقیت ویرایش شد!';
            } else {
                $_SESSION['errorMessage'] = 'لطفا فیلدهای ضروری را کامل کنید.';
            }
        }

        require __DIR__ . '/../Views/customers/customer_edit.php';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $controller = new CustomerController();
    $controller->edit((int) $_POST['id']);
}
