<?php
include 'con12.php';
//session_start();
$city_id = $_POST['city_id'];


$output = '<div id="productbycity">';
$query = "SELECT * FROM Product WHERE `p_status` = '1' AND `vendor_id` IN (SELECT user_id FROM user WHERE area_pincode IN (SELECT pincode FROM area WHERE city_id = '$city_id'));";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $output .='
            <label for="'.$row['product_id'].'">
            <input type="checkbox" id="'.$row['product_id'].'" name="product[]" value="'.$row['product_id'].'">  
            <img src="image/Project_images/'. $row['display_picture'].'" alt="Image" height="100px" width="100px" class="img-fluid"> <br/>
              '.$row['name'].' &nbsp; &nbsp; &nbsp; &nbsp;
        </label>
        
    ';
    }
}
'</div>';
echo $output;

?>