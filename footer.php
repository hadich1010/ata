    <script src="<?= htmlspecialchars($baseUrl . '/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?= htmlspecialchars($baseUrl . '/js/bootstrap.min.js') ?>"></script>
    <script src="<?= htmlspecialchars($baseUrl . '/dist/jalalidatepicker.js') ?>"></script>
    <script src="<?= htmlspecialchars($baseUrl . '/javascript.js') ?>"></script>
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
