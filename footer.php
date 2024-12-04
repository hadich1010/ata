    <!-- jQuery -->
    
    <!-- Bootstrap JS (باید بعد از jQuery باشد) -->

    <!-- اضافه کردن JS مربوط به Timepicker -->
     <!-- لینک به فایل‌های JS -->
    <script src="/ata/js/jquery-3.5.1.min.js"></script>
    <script src="/ata/js/bootstrap.min.js"></script>
    <script src="/ata/dist/jalalidatepicker.js"></script>
    <!-- اسکریپت‌های سفارشی -->
    <script src="javascript.js"></script>
    <script>
        $(document).ready(function() {
        jalaliDatepicker.startWatch({
        minDate: "today",
        maxDate: "1403/01/01",
        autoHide: true,
        showTodayBtn: true,
        time: true,
        hasSecond: false
            });
        });
    </script>

</body>
</html>