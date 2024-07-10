<?php
//echo "WELCOME...";

$servername="localhost";
$username="root";
$password="";
$dbname="the_bliss";

$conn= mysqli_connect($servername,$username,$password,$dbname);

if(!$conn)
{
    die("sorry ".mysqli_connect_error());

}
else
{
   // echo "connection success";
}
?>
