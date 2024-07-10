<?php
    $login = false;
    $showError = false;
    include "con12.php";
    session_start();
    $username = $_SESSION['username'];
    $uname = $username;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $password = $_POST["new_password"];
        $cpassword = $_POST["confirm_password"];
        if(($password == $cpassword))
        {
            $sql = "UPDATE `login` SET `password` = '$password' WHERE `username` = '$uname';";
            $res=mysqli_query($con, $sql);
            $login = true;
            if($res){?>
                <script>
                    show.alert("Your Password Updated Successfully");
                    </script> <?php
                //echo "Your Password has been updated Successfully";
                header("location: login.php");
            }
            else{
                $showError = "Invalid";
            }
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
    <title>Change-Password</title>
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
</style>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  color : black;
  font-weight : bold;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>


<?php
  if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your password has been updated successfully.
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
     <h1 class="text-center"><b> Change-Password </b></h1> <br>
     <form  method="POST">
         <center>
         <table>
             <tr>
     <td>   <label class="label_txt">Enter Your New Password</label> </td>
    <td>    <input type="password" name="new_password" id="new_password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required=""> </td>

    </tr>

<tr>
    <td>    <label class="label_txt">Confirm Password</label> </td>
    <td>    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required="">  
    <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small> </td>
<tr>
    <td> </td>
  <td>  <input type="checkbox" onclick="myFunction()">Show Password  </td> </tr>

<script>
function myFunction() {
var x = document.getElementById("confirm_password");
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}
}
</script>
</div>
</table> </center>  
<br> <br>
      <center>  <button style="color:white; font-weight:bold;" class="btn hvr-hover" type="submit" name="forgot" class="btn btn-primary btn-group-lg form_btn">Submit </button> </center>
    

    </form>

</body>
</html>