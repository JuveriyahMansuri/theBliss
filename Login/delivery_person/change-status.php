<?php
require_once "con12.php";
$a_r = $_POST["a_r"];
$oid=$_POST["oid"];
echo $oid;
echo $a_r;
//$q1="SELECT s.product_category_id AS sub_id,s.category_name AS sub,p.product_category_id ,p.category_name  FROM product_category AS s RIGHT JOIN product_category AS p ON s.sub_category_id=p.product_category_id WHERE p.product_category_id=$product_category_id";
//$r="SELECT sub_category_id FROM product_category WHERE product_category_id=$product_category_id";
//$q1="SELECT category_name FROM product_category WHERE product_category_id=$r";  
$q5="UPDATE `order` SET delivery_status='$a_r' WHERE order_id=$oid";
       $s5=mysqli_query($conn,$q5);
       if(!$s5)
               {
                     echo mysqli_error($conn);
               }
              else
               { ?>
               <!-- <span>Success</span> -->
        <?php  
               }
?>
