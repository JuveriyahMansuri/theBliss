<?php
include 'con12.php';
$corder_id = $_POST['coid'];
$ordercancel = mysqli_query($con,"UPDATE `customized_order` SET `approval` = 'cancelled' WHERE `customized_id` = '$corder_id';");
echo "hello";
?>