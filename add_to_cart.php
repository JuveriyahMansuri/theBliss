<?php
include 'con12.php';
$product_id = $_POST['pid'];
$username = $_POST['username'];


$query = mysqli_query($con, "SELECT user_id FROM User WHERE user_name = '$username'");
$row = mysqli_fetch_assoc($query);
$user = $row['user_id'];


$cart = mysqli_query($con,"SELECT * FROM Cart WHERE user_id = '$user' AND `product_id` = '$product_id';");
$cart = mysqli_fetch_assoc($cart);
    if($cart != null){
        $pcart = $cart['product_id'];
        $qty = $cart['quantity'];
        $increment = $qty + 1;
    }
else{
        $pcart="";
        $qty="";    
    }
    
if($product_id == $pcart){
    $updatecart = mysqli_query($con,"UPDATE cart SET quantity = '$increment' WHERE user_id = '$user' AND product_id = '$pcart';");
    $result = mysqli_query($con,"SELECT COUNT(*) FROM Cart WHERE user_id = '$user';");
    $result = mysqli_fetch_assoc($result);
    echo implode($result);
}
else{
    $cart = mysqli_query($con,"INSERT INTO `Cart` VALUES('$user' , '$product_id', 1);");
    $result = mysqli_query($con,"SELECT COUNT(*) FROM Cart WHERE user_id = '$user';");
    $result = mysqli_fetch_assoc($result);
    echo implode($result);
}


?>