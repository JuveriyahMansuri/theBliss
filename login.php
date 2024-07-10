<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'con12.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
     
    $sql = "Select * from Login where username='$username' AND password='$password'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    $sql2 = mysqli_query($con,"SELECT `u_status` FROM `user` WHERE `user_name` = '$username';");
    $res2 = mysqli_fetch_assoc($sql2);
    $status = $res2['u_status'];
    if ($num == 1 && $status != 0){
        $login = true;
        $userid = $num['user_id'];
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $sql1 = "Select user_type_id from User where user_name = '$username';";
        $res1 = mysqli_query($con, $sql1);
        while($rows = mysqli_fetch_array($res1))
        {
            if($rows['user_type_id']==4)
            {
                header("location: \Login\ADMIN_$\index.php");
            }
            else if($rows['user_type_id']==3)
            {
                header("location: \Login\delivery_person\index.php");
            }
            else if($rows['user_type_id']==2)
            {
                header("location: \Login\VENDOR_$\index.php");
            }
            else
            {
                header("location: index.php");
            }
            
        } 

    }
    else if($status == 0){?>

            <h1> Your account has been suspended. </h1><?php
        } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>The Bliss - Login</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Site Icons -->
    <link rel="shortcut icon" href="Logo.jpg" type="image/x-icon">  <!-- add your logo it will be visible on title bar -->
    <link rel="apple-touch-icon" href="Logo.jpg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<style>
  .required:after {
    content:" *";
    color: red;
  }


  td, th {
  text-align: left;
  padding: 4px;
  spacing: 1px;

}
</style>




<div style="text-align:center"> <img width=200 height=200 src="Logo.jpg" class="logo" alt=""></a> <!-- add ur logo --> </div>
<br>
<?php
    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>
<div class="container my-4">
     <h1 class="text-center" style="font-weight : bold;">Login</h1> <br>
     <form  method="post">
         <center>
        <table>
            <tr>
        <div class="form-group">
<td>            <label for="username" class="required" style="font-weight : bold; color:black;">Username</label> </td>
<td>            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required> </td>
</tr>           
        </div>
<tr>
        <div class="form-group">
<td>            <label for="password" class="required" style="font-weight : bold; color:black;">Password</label> </td>
<td>            <input type="password" class="form-control" id="password" name="password" required> </td> </tr>
<tr> 
    <td> </td>
<td>            <input type="checkbox" onclick="myFunction()">Show Password </td>
</tr>



<script>
function myFunction() {
var x = document.getElementById("password");
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}
}
</script>

        </div>
    <tr>   
          <td>       <button style="font-weight : bold; color : white;" class="btn hvr-hover"  type="submit" class="btn btn-primary">Login</button> <br/>
</td> </tr> <br/>
<tr>
<td>  <br/>   <p style="font-weight : bold;  font-size: medium;">Don't have an account? <a href="Registration.php">Register</a> </p> </td>

</tr>

<tr>
 <td>       <p style="font-weight : bold;  font-size: medium;">Forgot-Password? <a href="forgot-password.php">Forgot-Password</a> </p>  <br> </td>
        
</tr>   
    
</center>     
</table> 
    </form>
    </div>

<!-- Start Footer  -->
<footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About The Bliss</h4>
                            <p> </p>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="service.php">Customer Service</a></li>
                                <li><a href="#">Our Sitemap</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href=""></a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="">contactinfo@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

 <!-- Start copyright  -->
 <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2021-22 <a href="#">The Bliss</a>
            </p>
    </div>
    <!-- End copyright  -->
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->
</body>
</html>
