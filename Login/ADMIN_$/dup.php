<?php
require_once "con12.php";
$category_name = $_POST["category_name"];
echo(category_name);
//$q1="SELECT s.product_category_id AS sub_id,s.category_name AS sub,p.product_category_id ,p.category_name  FROM product_category AS s RIGHT JOIN product_category AS p ON s.sub_category_id=p.product_category_id WHERE p.product_category_id=$product_category_id";
//$r="SELECT sub_category_id FROM product_category WHERE product_category_id=$product_category_id";
//$q1="SELECT category_name FROM product_category WHERE product_category_id=$r";  
$q1="SELECT * FROM product_category WHERE category_name=$category_name";

$result = mysqli_query($conn,$q1);
while($r1=mysqli_fetch_array($result))
{
    if($r1['category_name']==$category_name)
    {
        echo "failed";
        return "failed";
        exit();
    }
    else
    {
        echo "success";
        return "success";
        exit();
    }
}
?>

