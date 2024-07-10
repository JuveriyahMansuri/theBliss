<?php
    $showError = false;
    include "con12.php";
    session_start();
    $username = $_SESSION['username'];
    $sql = "Select security_question , security_answer from Login where username='$username'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    if ($row > 0){
         $security_question = $row["security_question"];
         $security_answer = $row["security_answer"];
         if($_SERVER["REQUEST_METHOD"] == "POST")
         {
           $security_ans = $_POST['s_answer'];
                if( $security_ans == $security_answer)
             {
                 header("location: change-password.php");
             }
        
     
                else{

                             $showError = "Invalid Answer";
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
     <h1 class="text-center"><b> Forgot-Password </b> </h1> <br>
     <form  method="POST">
         <center>
         <table>
       <tr>
       <td>  <label class="label_txt">Security Question</label> </td>
       <td>  <input type="text" name="security_question" id="security_question" value="<?php echo $security_question; ?>" class="form-control" readonly> </td>
    </tr>

    <tr>
    <td>    <label class="label_txt">Enter Your Answer</label> </td>
     <td>   <input type="text" name="s_answer" id="s_answer" class="form-control" required=""> </td>
    </tr>
</div>
    </table> </center>
    <br> <br>
      <center>  <button  style="color:white; font-weight:bold;" class="btn hvr-hover" type="submit" name="forgot" class="btn btn-primary btn-group-lg form_btn">Submit </button> </center>
    </form>

</body>
</html>
