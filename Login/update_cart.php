<?php
include 'con12.php';
$pid = $_POST['pid'];
$qty = $_POST['qty'];
$username = $_POST['user'];

$query = mysqli_query($con, "SELECT user_id FROM User WHERE user_name = '$username'");
$row = mysqli_fetch_assoc($query);
$user = $row['user_id'];

    $sql3 = "UPDATE `Cart` SET `quantity` =  '$qty' WHERE `user_id` = '$user' AND `product_id` = '$pid';";
    $res3 = mysqli_query($con, $sql3);

   
?> 