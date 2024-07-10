<?php
require('con12.php');
session_start();
//require('/koolreport-5.5.0/koolreport/core/autoload.php');


//use \koolreport-5.5.0\koolreport\core\src\datasourcesPdoDataSource;
//use \koolreport-5.5.0\koolreport\core\src\widgets\google\ColumnChart;

//if(isset($_POST['submit']))
//{
	//$username=get_safe_value($con,$_POST['username']);
	//$password=get_safe_value($con,$_POST['password']);
	//$sql=mysqli_query('select * from product_category');
    //$result=mysqli_query($conn,$sql);
    $sql=mysqli_query($conn,"SELECT u.user_id,u.commission(for_Delivery_person),u.user_id_proof,u.display_picture,u.user_name,u.email_address,u.mobile,u.addr,a.area_name FROM user u INNER JOIN area a ON u.area_pincode=a.pincode WHERE u.user_type_id=3;");
//	$res=mysqli_query($con,$sql);
//	$count=mysqli_num_rows($res);
/*	if($count>0){
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']='$username';
		header('location:product.php');
		die();
		
	}else{
		"Please enter correct login details";
	}
		
}*/
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
    <title>Reports</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:gray;">
         <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
              
                 
                 
 <h3><a style="color:white;" href="/Report The_bliss/customerrpt.php">Customer Report</a> <br><br>
 <a style="color:white;" href="/Report The_bliss/vendorrpt.php">Vendor Report</a>  <br><br>
 <a style="color:white;" href="/Report The_bliss/delivery_personrpt.php">Delivery Report</a>  <br><br>
 <a style="color:white;" href="/Report The_bliss/monthly_salesrpt.php">Monthly Sales (of Basic Orders) Report</a>  <br><br>
 <a style="color:white;" href="/Report The_bliss/monthly_customized_order_salesrpt.php">Monthly Sales (of Customized Orders) Report</a> <br> <br>
 <a style="color:white;" href="/Report The_bliss/stockrpt.php">Stock Report</a> </h3> <br>

                






             
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