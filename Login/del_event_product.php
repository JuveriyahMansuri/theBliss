<?php
include 'con12.php';
$pid = $_POST['pid'];
$booking_id = $_POST['booking_id'];

$sql = mysqli_query($con,"DELETE FROM event_booking_detail WHERE event_booking_id = '$booking_id' AND product_id = '$pid';");

?>