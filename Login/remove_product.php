<?php
include 'con12.php';
$pid = $_POST['pid'];
$username = $_POST['user'];

$query = mysqli_query($con, "SELECT user_id FROM User WHERE user_name = '$username'");
$row = mysqli_fetch_assoc($query);
$user = $row['user_id'];

    $sql = "DELETE FROM Cart WHERE user_id = '$user' AND product_id = '$pid';";
    $res = mysqli_query($con, $sql);
    //echo implode($res);

   
?> 