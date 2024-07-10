<?php
include 'con12.php';
$booking_id = $_POST['booking_id'];
$pid =  $_POST['pid'];
$eprice = $_POST['eprice'];


$q5="UPDATE `event_booking_detail` SET `eprice` = '$eprice', `approval` = 'accepted' WHERE event_booking_id = '$booking_id'  AND product_id = '$pid' ;";
$s5=mysqli_query($conn,$q5);
var_dump($s5);


?>
