<?php
//echo "WELCOME...";

$servername="localhost";
$username="root";
$password="";
$db="The_bliss";

$con = mysqli_connect($servername,$username,$password,$db);
if(!$con)
{
    die("sorry ".mysqli_connect_error());

}
else
{
    //echo "connection success";
}
?>