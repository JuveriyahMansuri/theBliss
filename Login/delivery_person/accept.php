<?php
include 'con12.php';
session_start();
$r_id=$_GET['r_id'];

$q1="SELECT order_id FROM request_delivery WHERE request_delivery_id=$r_id";
$s1=mysqli_query($conn,$q1);

while($r1=mysqli_fetch_array($s1))
{
    $o_id=$r1['order_id'];
}

$q2="SELECT p.name,p.display_picture,u.user_name,u.addr,ord.quantity FROM order_detail ord INNER JOIN product p ON p.product_id=ord.product_id INNER JOIN user u ON u.user_id=p.vendor_id WHERE  ord.order_id=$o_id";
$s2=mysqli_query($conn,$q2);


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

    
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

    <title>Vendor Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:teal;">
          <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
                <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Accept / Reject Delivery of Request Id <?php echo $r_id; ?></h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="5" selected="">5</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                    
                                  </div>
                               
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                                 -->
  
                            </div>
                            <div>
                            <div class="card-body" >
                            <?php
include_once 'con12.php';
$username=$_SESSION['username'];

$amt=$_GET['amt'];



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $a_r=$_POST['a_r'];
      $sql=mysqli_query($conn,"UPDATE request_delivery SET is_accept='$a_r' WHERE request_delivery_id=$r_id");

    if(!$sql)
    {
        echo "ERROR ";
         echo mysqli_error($conn);
    }
    else
    {
        ?>
        <div class="alert alert-primary" role="alert" align="center" > RECORD ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='order.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        <?php
       // header("location: \Login\VENDOR_$\apply_offer.php");
                                 
    
    }
}
?>
			<form method="post">
			<div>
                <table align="center" class="table dataTable my-0" id="dataTable">
                    <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Vendor Name</th>
                        <th>Pick Up Address</th>
                    </tr>
</thead>
                    <?php while($r2=mysqli_fetch_array($s2))
                    {?>
                    <tr>
                        <td><img height="60px" width="60px" src="/Login/image/Project_Images/<?php echo $r2['display_picture']; ?>"></td>
                        <td><?php echo $r2['name'];?></td>
                        <td style="text-transform:capitalize;"> <?php echo $r2['user_name'];?></td>
                        <td><?php echo $r2['addr'];?></td>
                    </tr>
                    <?php } ?>
</table>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div class="mb-4" align="center">
					<label class="form-label"><h3>Amount ₹<?php echo $amt; ?></h3</label>
					
                        </div>

                <div class="mb-4">
                    <?php 
                    $accept=$_GET['ac'];
                    if($accept=="accepted" || $accept=="rejected")
                    {
                    ?>

                    <?php 
                    } 
                    else
                    {?>
					<label class="form-label">Do you want to </label>
					<div class="row gx-2">
                    <select name="a_r" id="a_r">
    
    <option value="accepted">accept</option>

    <option value="rejected">reject</option>

    </select>
</div>
<button class="btn btn-primary" id="submit" name="submit">Submit</button>

<?php } ?>

</div>

                         

                      
                        </div>
                       
                        <!--label class="form-check mb-4">
				  <input class="form-check-input" type="checkbox" value="">
				  <span class="form-check-label">  Publish on website </span>
				</label-->

				
			</form>
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


