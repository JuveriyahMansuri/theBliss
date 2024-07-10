<?php
include_once 'con12.php';
include_once 'function.php';

if($_GET['action']=="delete")
    {
$query=mysqli_query($conn,"DELETE FROM product_category WHERE product_category_id='".$_GET['pc']."'");

if($query)
{
    echo "DELETED SUCCESSFULLY";
}
else
{
    echo "ERROR";
}
    }

?>

