<?php 
session_start();
include 'con12.php';




$q1="SELECT * FROM customized_order WHERE customized_id=".$_GET['cid'];
$s1=mysqli_query($conn,$q1);

?>


<!DOCTYPE html>
<html lang="en">

<head>
<title>Accept/Reject</title>
<!--<link rel="stylesheet" href="profile.css"> -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
   
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-image: linear-gradient(to right top, #f4f3f3, #f6cdcc, #f4a7a4, #ec8179, #df594e, #df594e, #df594e, #df594e, #ec8179, #f4a7a4, #f6cdcc, #f4f3f3);">
        
         <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
              
                <div class="mm">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                                      <?php

if(isset($_POST['submit']))
{
    
    $amount=$_POST['amount'];
    $approval=$_POST['approval'];

    if($approval=="rejected")
    {
        
        $q2="UPDATE customized_order SET approval='$approval' WHERE customized_id=".$_GET['cid'];
        $s2=mysqli_query($conn,$q2);
    }
    else
    {
        
        $q2="UPDATE customized_order SET approval='$approval',amount=$amount WHERE customized_id=".$_GET['cid'];
        $s2=mysqli_query($conn,$q2);
    }
    if(!$s2)
{
    echo "ERROR ";
     echo mysqli_error($conn);
}
else
{
    ?>
    <div class="alert alert-primary" role="alert" align="center"> ORDER ACCEPTED &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='customized_order.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php
    //header("location: \Login\VENDOR_$\customized_order.php");
          
}
}
?>
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row justify-content-center">
  
                            <div class="col-lg-7">
                                <div class="p-5">
                                    
                               
          
                                   
									  <form method="post">
                                      <table align="center">
                        <?php while($r1=mysqli_fetch_array($s1))
                        { ?>
                           <div align="center"> <img class="rounded-circle mr-2" style="height:160px;width:160px" src="/Login/image/custom_order/<?php echo $r1['image']; ?>"> </div>
                          <?php } ?>
                          <break>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <tr >
                        
                          <th>Enter Amount</th>  
                          <th>         
<input min="100" type="number" required class="form-control select2bs4" placeholder="enter amount" id="amount" name="amount">
                        </th>
</tr>

<tr>
    <th>Accept/Reject! </th>
    <th>
<select class="form-select" name="approval" id="approval" required>
                       
                        <option value="accepted">accept </option>
                        <option value="rejected">reject </option>
					    </select>
                        </th>
                       
                        </tr>
                        
                                 </table>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <button class="btn btn-primary" style="background-color: #d33b33;" name="submit"><b>SUBMIT</b></button>

                                    </form>
									
									
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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