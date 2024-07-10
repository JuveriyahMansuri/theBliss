<?php
include 'con12.php';
$pid = $_POST['pid'];
$qty = $_POST['qty'];
$booking_id = $_POST['booking_id'];

$sql = mysqli_query($con,"UPDATE event_booking_detail SET `quantity` = '$qty' WHERE `product_id` = '$pid' AND `event_booking_id` = '$booking_id';");
?>