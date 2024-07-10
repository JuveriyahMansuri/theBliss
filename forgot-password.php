<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "con12.php";
    $username = $_POST["username"];
    $sql = "Select * from Login where username = '$username'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        //$login = true;
        session_start();
        //$_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: security_qa.php");
    } 
    else{
        //echo "User doesn't exist";
        $showError = "Invalid Username";
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
    <title>Forgot-Password</title>
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

    <!-- Bootstrap CSS -->
    <!-- <Link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.css"> -->

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
     <h1 class="text-center"> <b> Forgot-Password </b> </h1> <br>
     <form  method="POST">
     <?php if(isset($_GET['err'])){
 $err=$_GET['err'];
 echo '<p class="errmsg"><b> No user found. <b></p>';
} 
// If server error 
if(isset($_GET['servererr'])){ 
echo "<p class='errmsg'>The server failed to send the message. Please try again later.</p>";
   }
   //if other issues 
   if(isset($_GET['somethingwrong'])){ 
 echo '<p class="errmsg">Something went wrong.  </p>';
   }
   ?>
   <center>
   <table>
       <tr>
       <td> <label class="label_txt required">Username</label> </td>
   <td>     <input type="text" name="username" id="username" value="<?php if(!empty($err)){ echo  $err; } ?>" class="form-control" required=""> </td>
</tr>
</table> </center> <br>
</div>

      <center>  <button style="color:white; font-weight:bold;" class="btn hvr-hover" type="submit" name="forgot" class="btn btn-primary btn-group-lg form_btn">Submit </button> </center>
</form>

</body>
</html>


