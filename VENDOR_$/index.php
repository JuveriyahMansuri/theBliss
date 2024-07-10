<?php 
include 'con12.php';
session_start();
$username=$_SESSION['username'];
$q0="SELECT user_id FROM user WHERE user_name='$username'";
$s0=mysqli_query($conn,$q0);
while($r0=mysqli_fetch_array($s0))
{
    $user_id=$r0['user_id'];
}

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
    
    <title>Vendor Dashboard</title>

    <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">  <!-- add your logo it will be visible on title bar -->
    <link rel="apple-touch-icon" href="The Bliss.png">

</head>

<body style="color:#d33b33;">


    <div class="d-flex" id="wrapper" >
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-image: linear-gradient(to right top, #f4f3f3, #f6cdcc, #f4a7a4, #ec8179, #df594e, #df594e, #df594e, #df594e, #ec8179, #f4a7a4, #f6cdcc, #f4f3f3);">
      <!--  <div id="page-content-wrapper" style="background-color:#d33b33; ">-->
         <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
                <div class="row g-3 my-2">
                    <h2 align="center" style="text-transform:uppercase; color:white">WELCOME <?php echo $_SESSION['username']; ?></h2>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                        <?php
                         $q1="SELECT product_id FROM product WHERE vendor_id=$user_id";
                         $s1=mysqli_query($conn,$q1);
                         $count=0;
                         while($r1=mysqli_fetch_array($s1))
                         {
                             $count++;
                         }
                        ?>    
                        <div>
                                <h3 class="fs-2"><?php echo $count; ?></h3>
                                <p class="fs-5"><b>Products</b></p>
                            </div>
                            <i class="fas fa-gift fs-1 primary-texts border rounded-full secondary-bgs p-3"></i>
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
                        <?php
                         $q2="SELECT DISTINCT o.order_id FROM `order` AS o INNER JOIN order_detail AS od ON od.order_id=o.order_id INNER JOIN product AS p ON p.product_id=od.product_id WHERE p.vendor_id=$user_id"; 
                         $s2=mysqli_query($conn,$q2);
                         $count=0;
                         $total=0;
                         while($r2=mysqli_fetch_array($s2))
                         {

                            $q3="SELECT od.discount_price,od.quantity,od.price FROM order_detail AS od INNER JOIN product AS p ON p.product_id=od.product_id WHERE order_id=".$r2['order_id']." && p.vendor_id=$user_id";  
                            $s3=mysqli_query($conn,$q3);
                            
                            while($r3=mysqli_fetch_array($s3))
                            { 
                                $total=$total+($r3['price']-$r3['discount_price']);
                              }
                             $count++;
                            }
                        ?>      
                        <div>
                                <h3 class="fs-2"><?php echo $count; ?></h3>
                                <p class="fs-5"><b>Orders</b></p>
                            </div>
                            <i
                                class="fas fa-hand-holding-usd fs-1 primary-texts border rounded-full secondary-bgs p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php 
                                 $q6="SELECT c.customized_id,c.customized_details FROM customized_order c INNER JOIN user u ON c.customer_id=u.user_id INNER JOIN product p ON p.product_id=c.product_id WHERE p.vendor_id=$user_id";
                                 $s6=mysqli_query($conn,$q6);
                                 $count=0;
                                  while($r6=mysqli_fetch_array($s6))
                                  {
                                         $count++;
                                  }
                                ?>
                                <h3 class="fs-2"><?php echo $count; ?></h3>
                                <p class="fs-5"><b>Customized Order</b></p>
                            </div>
                            <i class="fas fa-truck fs-1 primary-texts border rounded-full secondary-bgs p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <?php 
                            
                            ?>
                        <div>
                                <h3 class="fs-2"><?php echo $total;?></h3>
                                <p class="fs-5"><b>Earnings</b></p>
                            </div>
                            <i class="fas fa-chart-line fs-1 primary-texts border rounded-full secondary-bgs p-3"></i>
                        </div>
                       
                    </div>
                   
                </div>

              <!--  <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recent Orders</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Television</td>
                                    <td>Jonny</td>
                                    <td>$1200</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Laptop</td>
                                    <td>Kenny</td>
                                    <td>$750</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Cell Phone</td>
                                    <td>Jenny</td>
                                    <td>$600</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Fridge</td>
                                    <td>Killy</td>
                                    <td>$300</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Books</td>
                                    <td>Filly</td>
                                    <td>$120</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Gold</td>
                                    <td>Bumbo</td>
                                    <td>$1800</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Pen</td>
                                    <td>Bilbo</td>
                                    <td>$75</td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>Notebook</td>
                                    <td>Frodo</td>
                                    <td>$36</td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>Dress</td>
                                    <td>Kimo</td>
                                    <td>$255</td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>Paint</td>
                                    <td>Zico</td>
                                    <td>$434</td>
                                </tr>
                                <tr>
                                    <th scope="row">11</th>
                                    <td>Carpet</td>
                                    <td>Jeco</td>
                                    <td>$1236</td>
                                </tr>
                                <tr>
                                    <th scope="row">12</th>
                                    <td>Food</td>
                                    <td>Haso</td>
                                    <td>$422</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> -->
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