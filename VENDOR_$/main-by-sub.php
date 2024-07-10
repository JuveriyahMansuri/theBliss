<?php
require_once "con12.php";
$product_category_id = $_POST["product_category_id"];
echo($product_category_id);
//$q1="SELECT s.product_category_id AS sub_id,s.category_name AS sub,p.product_category_id ,p.category_name  FROM product_category AS s RIGHT JOIN product_category AS p ON s.sub_category_id=p.product_category_id WHERE p.product_category_id=$product_category_id";
//$r="SELECT sub_category_id FROM product_category WHERE product_category_id=$product_category_id";
//$q1="SELECT category_name FROM product_category WHERE product_category_id=$r";  
$q1="SELECT * FROM product_category WHERE sub_category_id=$product_category_id";

$result = mysqli_query($conn,$q1);
?>
<option value="" required>Select sub_category</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option required value="<?php echo $row["product_category_id"];?>"><?php echo $row["category_name"];?></option>
<?php
}
?>
