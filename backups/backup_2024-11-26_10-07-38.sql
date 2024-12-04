-- بکاپ از دیتابیس ataholding --

-- ساختار جدول customers
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `national_id` varchar(15) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `consultation_status` varchar(50) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `additional_info` text DEFAULT NULL,
  `customer_image` text DEFAULT NULL,
  `registration_date` varchar(10) DEFAULT NULL,
  `registration_time` time DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('2', 'محمد آرمانی', '09377661629', '0000000000', 'وام رسالت', 'مشاوره تلفنی', 'پخش سوسیس کالباس', '- وام مهر مبلغ 300 میلیون دریافت کرد.', '', '1403/09/05', '16:15:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('3', 'میثم غفوری زاده', '09124609650', '1111111111', '', 'مشاوره تلفنی نا مشخص', 'کارمند', 'رسالت رو گرفته بودن تمایل برای گرفتن مهر ایران داشت .', '', '1403/09/07', '15:00:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('4', 'محسن محوی خمامی', '09375013100', '1111111111', 'وام مهر', 'مشاوره تلفنی نا مشخص', 'کارمند', 'برای گرفتن وام مهر ایران خودشون مراجعه میکنن .', '', '1403/09/08', '12:56:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('5', 'افسانه قادرنژاد', '09382590808', '0000000000', 'وام مهر', 'مشاوره تلفنی', 'خانه دار', 'به اسم خودشون وام مهر ایران رو با ضمانت همسرشون بگیرند و به اسم همسرشون که شاغل هستن وام رسالت رو گرفته بودند .', '', '1403/09/07', '10:00:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('6', 'محمدرضا سلطانی', '09058960707', '1111111111', 'وام مهر', 'مشاوره تلفنی', 'کارمند', 'تمایل داشتن وام مهر رو بگیر چون شرایط بهتری داره .', '', '1403/09/07', '13:08:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('7', 'عباس رستمی', '09125755793', '1111111111', 'وام مهر', 'مشاوره تلفنی', 'بازنشسته', 'برای گرفتن وام مهر تمایل داشت مشکل پرداخت اقساط هم نداشت خودشون هم چک داشتن .', '', '1403/09/06', '15:17:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('8', 'مهران حبیب نژاد', '09369902230', '1111111111', 'وام مهر', 'مشاوره تلفنی نا مشخص', 'کارمند', 'با توجه به نیازی که داشتن به مبلغ 100میلیون وام مهر رو میگیرند و خودشون چک هم دارند .', '', '1403/09/08', '11:04:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('9', 'یاسر اسماعیلی', '09371757098', '0000000000', 'وام مهر', 'مشاوره تلفنی', 'آزاد', 'برای همسرشون اعتبار سنجی مهر مثبت بود خودشون چک داشتن حضوری برای تکمیل مدارک .', '', '1403/09/07', '10:07:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('10', 'مینا عباسی', '09358691221', '1111111111', 'وام مهر', 'مشاوره تلفنی', 'بوفه دار استخر', 'تمایل به گرفتن وام شخصی را به عنوان ضامن به دفتر معرفی کردن .', '', '1403/09/07', '12:24:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('11', 'امیر بهادر جعفری', '09395203969', '1111111111', 'وام مهر', 'مشاوره تلفنی نا مشخص', 'کارمند', 'فردیس هستن مشتاق برای گرفتن وام مهر', '', '1403/09/10', '14:48:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('12', 'محمد جوادی فر', '09378418058', '1111111111', 'وام مهر', 'مراجعه به دفتر', 'کارمند', 'همسرشون حضوری تشریف آوردن برای مشاوره پیگیری برای آوردن مدارک .', '', '1403/09/05', '14:50:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('13', 'مهناز حسن نژاد', '09379214780', '1111111111', 'وام رسالت', 'مشاوره تلفنی نا مشخص', 'خانه دار', 'خانم خانه دار هستن همسرشون جواز کسب دارن به اسم ایشون می خواهند وام بگیرند . هفته جدید پیگیری شود .', '', '1403/09/12', '14:14:00', '۱۴۰۳/۰۹/۰۵');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('14', 'سیما دهقان', '09305965242', '0000000000', 'وام مهر', 'مشاوره تلفنی', 'کارمند', 'تمایل به گرفتن وام رسالت', '', '1403/09/06', '15:30:00', '۱۴۰۳/۰۹/۰۶');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('15', 'کیکانی', '09388842101', '0000000000', 'وام مهر', 'مشاوره تلفنی', 'تتو کار', 'حضوری اومدن برای مشاوره و خودشون مجدد پیگیری کردن برای وام مهر', '', '1403/09/12', '09:48:00', '۱۴۰۳/۰۹/۰۶');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('16', 'گرشاسبی', '09906615313', '000000000', 'وام رسالت', 'مشاوره تلفنی', 'شرکت بهشهر', 'برای وام رسالت حضوری مشاوره شدن در دست پیگیری هستن برای آوردن مدارک .', '', '1403/09/13', '17:49:00', '۱۴۰۳/۰۹/۰۶');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('17', 'مهدی کرمی', '09359620471', '6239716741', 'وام رسالت', 'عقد قرارداد', 'کارمند دومینو', '- ضامن دارد
- حساب دارد
- نیاز به اعتبار سنجی', '', '1403/09/06', '11:27:00', '۱۴۰۳/۰۹/۰۶');
INSERT INTO customers (id, full_name, phone_number, national_id, status, consultation_status, job, additional_info, customer_image, registration_date, registration_time, created_at) VALUES ('18', 'مجیدی فر', '0000000000', '0000000000', 'وام رسالت', 'مشاوره تلفنی', 'مدیر بخش استاندارد کربن', '- ضامن ضربدری آقا حق جو
بچه اصفهان شهر میمه', '', '1403/09/06', '11:30:00', '۱۴۰۳/۰۹/۰۶');

