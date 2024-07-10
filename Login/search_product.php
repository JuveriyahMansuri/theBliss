<?php
include "con12.php";
$name = $_POST['name'];
$city_id = $_POST['city_id'];
$query = "SELECT * FROM product WHERE name LIKE '%$name%' AND `p_status` = '1' AND `vendor_id` IN (SELECT user_id FROM user WHERE area_pincode IN (SELECT pincode FROM area WHERE city_id = '$city_id'));";
$output = "";
$result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $output .='
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <div class="type-lb">
                         <!--   <p class="sale">Sale</p>-->
                        </div>  
                       <img src="image/Project_images/' .$row['display_picture'] .'" class="img-fluid" alt="Image" height = "200px" width = "200px">
                        <div class="mask-icon">
                            <ul>
                                <li> <a href="shop-detail.php?$pname=' . $row['name'].'" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                            </ul>
                            <a class="cart" id=' .$row['product_id'] .'" href="#" onclick="addProduct(this.id)"> <img src="image/cart_logo.png" height="30px" width="30px"> Add to Cart</a>
                            
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>' . $row['name'].'</h4>
                        <h5> ₹'. $row['price'].'</h5>
                    </div>
            </div>
        </div>
        ';
        }
    }
    echo $output;
?>