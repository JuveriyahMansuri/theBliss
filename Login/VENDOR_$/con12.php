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

<!-- $_SESSION['user'] = $user_data['user_id'];
    $_SESSION['fn'] = $user_data['fname'];
    $_SESSION['ln'] = $user_data['lname'];
    $_SESSION['a1'] = $user_data['add1'];
    $_SESSION['a2'] = $user_data['add2'];
    $_SESSION['m'] = $user_data['mobile'];
    $_SESSION['i'] = $user_data['image']; -->