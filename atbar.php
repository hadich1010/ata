<?php 
$pageTitle = "برآورد تسهیلات";
include('header.php'); 
?>
<h2>براورد تسهیلات</h2>
<br>
<section class="row">

    <div id="price-container">
<form action="process.php" method="post">
    <label for="price">مبلغ متناسب تایید شده را وارد نمایید :</label>
    <input type="text" id="price" onkeyup="handlerSeparateNumbers(event)" name="inputField">
    <span>تومان</span>
</form>
    </div>
    
</section>


<?php 
include('footer.php'); 
?>