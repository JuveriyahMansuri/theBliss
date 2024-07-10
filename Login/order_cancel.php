<?php
include 'con12.php';
$order_id = $_POST['oid'];
$reason = $_POST['reason'];
$corder = mysqli_query($con,"UPDATE `order` SET `order_status` = 'cancelled',`cancellation_date` = (SELECT NOW()),`cancellation_reason` = '$reason' WHERE `order_id` = '$order_id';");
//echo "hello";
?>