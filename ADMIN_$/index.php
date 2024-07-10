
<?php 
include 'con12.php';
session_start();
$username = $_SESSION['username'];
//echo $username;
$_SESSION['username'] = $username;
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
    <title>Admin Dashboard</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
</head>

<!-- <body style="background-color:#d33b33;"> -->
<body style="background-color:grey;">
    <div class="d-flex" id="wrapper" >
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <!-- <div id="page-content-wrapper" style="background-color:#d33b33;"> -->
        <div id="page-content-wrapper" style="background-color:gray;">
         <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
                <h3 align="center" style="text-transform:uppercase; color:white;">WELCOME <?php echo $username; ?></h3>
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                            include 'con12.php';
                            $q1="SELECT product_id FROM product;";
                            $s1=mysqli_query($conn,$q1);
                            $count=0;
                            while($r1=mysqli_fetch_array($s1))
                            {
                                $count++;
                            }
                            ?>    
                                <h3 class="fs-2"><?php echo $count; ?></h3>
                                <b><p class="fs-5">Products</p></b>
                            </div>
                            <i style="color:black;" class="fas fa-gift  fs-1 primary-texts border rounded-full secondary-bgs p-3"></i>
                        </div>
                    </div>
                    <style>
                        .primary-texts {
  color: #d33b33;
}
.secondary-bgs {
  background-color:  #fff7f7;
}
                        </style>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                        // $q2="SELECT DISTINCT o.order_id FROM `order` AS o INNER JOIN order_detail AS od ON od.order_id=o.order_id INNER JOIN product AS p ON p.product_id=od.product_id;"; 
                        $q2="SELECT * FROM `order`";
                        $s2=mysqli_query($conn,$q2);
                         $count=0;
                         $total=0;
                         while($r2=mysqli_fetch_array($s2))
                         {

                            $q3="SELECT od.discount_price,od.quantity,od.price FROM order_detail AS od INNER JOIN product AS p ON p.product_id=od.product_id;";  
                            $s3=mysqli_query($conn,$q3);
                            
                            while($r3=mysqli_fetch_array($s3))
                            { 
                                $total=$total+($r3['price']-$r3['discount_price']);
                              }
                             $count++;
                            }
                        ?>      
                                <h3 class="fs-2"><?php echo $count; ?></h3>
                                <b><p class="fs-5">Orders</p></b>
                            </div>
                            <i style="color:black;" class="fas fa-chart-line fs-1 primary-texts border rounded-full secondary-bgs p-3"></i>
                            </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                        // $q2="SELECT DISTINCT o.order_id FROM `order` AS o INNER JOIN order_detail AS od ON od.order_id=o.order_id INNER JOIN product AS p ON p.product_id=od.product_id;"; 
                        $q2="SELECT * FROM `customized_order`";
                        $s2=mysqli_query($conn,$q2);
                         $count=0;
                         $total=0;
                         while($r2=mysqli_fetch_array($s2))
                         {

                            
                             $count++;
                            }
                        ?>      
                                <h3 class="fs-2"><?php echo $count; ?></h3>
                                <b><p class="fs-5">Customized Orders</p></b>
                            </div>
                            <i style="color:black;" class="fas fa-chart-line fs-1 primary-texts border rounded-full secondary-bgs p-3"></i>
                            </div>
                    </div>


                 <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php 
                                 $q4="SELECT user_id FROM user";
                                 $s4=mysqli_query($conn,$q4);
                                 $count=0;
                                 while($r4=mysqli_fetch_array($s4))
                                 {
                                           $count++;
                                 }
                                ?>
                                <h3 class="fs-2"><?php echo $count; ?></h3>
                                
                                <b><p class="fs-5">Users</p></b>
                            </div>
                            <i style="color:black;"  class="fa fa-user fs-1 primary-texts border rounded-full secondary-bgs p-3"></i>
                            <!-- <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i> -->
                        </div>
                    </div>
 
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                           <div>
                               <?php 
                               $q5="SELECT * FROM `order`";
                               $s5=mysqli_query($conn,$q5);
                               $total=0;
                               while($r5=mysqli_fetch_array($s5))
                               {
                                       $total=$total+$r5['total_amount'];
                               }
                               ?>
                                <h3 class="fs-2"><?php echo $total; ?></h3>
                                <b><p class="fs-5">Revenue</p></b>
                            </div>
                             <i style="color:black;"
                                class="fas fa-hand-holding-usd fs-1 primary-texts border rounded-full secondary-bgs p-3"></i>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    
</body>

</html>
<?php connection_aborted(); ?>