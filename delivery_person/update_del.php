<?php


include 'con12.php';
session_start();
$username=$_SESSION['username'];

$o_id=$_GET['req_id'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Delivery Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
         <?php include 'nav.php'; ?>
         <?php 
   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
       $a_r=$_POST['a_r'];
       $q5="UPDATE `order` SET delivery_status='$a_r' WHERE order_id=$o_id";
       $s5=mysqli_query($conn,$q5);
       if(!$s5)
       {
             echo mysqli_error($conn);
       }
       else
       { ?>
        <div class="alert alert-primary" role="alert" align="center"> RECORD ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='status_of_delivery.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php  
       }
   }
   ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
            <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Delivery</h3></p> </center>
                        </div>
                        <div class="card-body" align="center">
                <form method="post">
<select name="a_r" id="a_r">
    
    <option value="picked_up">picked_up</option>
    <option value="delivered">delivered</option>
    <option value="processing">processing</option>
    <option value="on_the_way">on_the_way</option>

    </select>
    
    <button class="btn btn-primary" type="submit" name="submit">Submit item</button>
</form>
    </div>
    </div>
    </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>