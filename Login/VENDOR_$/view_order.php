<?php 

session_start();
include 'con12.php';
$username=$_SESSION['username'];
$oi=$_GET['oi']; 
$appr=$_GET['appr'];
$q1="SELECT p.display_picture,p.name,od.quantity,od.discount_price,od.price FROM order_detail AS od INNER JOIN product AS p ON p.product_id=od.product_id WHERE order_id=$oi && p.vendor_id=(SELECT user_id FROM user WHERE user_name='$username')";    
  
$s1=mysqli_query($conn,$q1);


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
    <title>Order Details</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
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
             
                    
                    <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Order Details of <?php echo $oi;?></h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    <?php 
                                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                                    {
                                        $val=$_POST['approval'];
                                       
                                        $q2="UPDATE `order` SET order_status='$val' WHERE order_id=$oi";
                                        $s2=mysqli_query($conn,$q2);
                                        if(!$s2)
                                        {
                                            echo "ERROR ";
                                             echo mysqli_error($conn);
                                        }
                                        else
                                        {
                                            ?>
                                            <div class="alert alert-primary" role="alert" align="center"> RECORD ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" onClick="Javascript:window.location.href='orders.php';" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                            <?php
                                               //header("location: \Login\VENDOR_$\view_product.php");
                                        }
                                    }
                                    
                                    ?>
                                  </div>
                               
                                <!--div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div-->
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable" align="center">
                                <thead>
                                <form method="post">
                                    <?php if($appr=='pending')
                                    {?>
                                        <th>
                            Accept/Reject Order
                            </th>
                            <td>
                              
                            <select class="form-select" name="approval" id="approval">
                        
                        <option value="confirmed">confirm </option>
                        <option value="delivered">delivered </option>
					    </select>
                                   
                        </td>
                        <td> 	<button style="background-color: #d33b33;" class="btn btn-primary" name="submit" onclick="Javascript:window.location.href='orders.php';"><b>Submit Item</b></button></td>
                      <?php } ?>
                                    </form>
                    </thead>
                                 <thead align="center">
                                     <th></th>
                                 <th>Product Name</th>
                                 <th>Quantity</th>
                                 <th>Price</th>
                                 <th>Discount Price</th>
                                 <th>After discount price</th>
                                 <th>Amount</th>
                                 <th>Delivery Amount</th>

</thead>


                                 <?php 
                                
  
                                $bill=0;
                                
                                while($r1=mysqli_fetch_array($s1))
                                {
                                 ?>
                                     <tr align="center">
                                     <th align="center"><img class="rounded-circle mr-2" width="30" height="30" src="/Login/image/Project_images/<?php echo $r1['display_picture']; ?>"></th>
        
                                     <th  style= "text-transform:capitalize;"><?php echo $r1['name'];?></th>
                                     
                                     
                                     <th  required><?php echo $r1['quantity']; ?></th>
                                     
                                    
                                     <th  required>₹ <?php echo $r1['price']; ?></th>
                                    
                                   
                                     <th>₹ <?php echo $r1['discount_price']; ?></th>
                                     <th>₹ <?php echo $r1['price']-$r1['discount_price']; ?></th>
                                     <th >₹ <?php echo $r1['quantity']*($r1['price']-$r1['discount_price']); ?></th>
                                    <?php 
                                    $q2="SELECT * FROM request_delivery WHERE order_id=$oi";
                                    $s2=mysqli_query($conn,$q2);
                                    $q3="SELECT od.product_id FROM order_detail AS od INNER JOIN product AS p ON p.product_id=od.product_id WHERE order_id=$oi";    
                                    $s3=mysqli_query($conn,$q3);
                                    $q5="SELECT od.product_id FROM order_detail AS od INNER JOIN product AS p ON p.product_id=od.product_id WHERE order_id=$oi";    
                                    $s5=mysqli_query($conn,$q3);
                                    $del_amount=0;
while($r2=mysqli_fetch_array($s2))
{
    $del_amount=$r2['amount'];
   // echo $del_amount;
}
$total_products=0;
while($r3=mysqli_fetch_array($s3))
{
    $total_products++;
}
$vendor_products=0;
while($r5=mysqli_fetch_array($s5))
{
    $vendor_products++;
}

if($total_products==$vendor_products)
{  
    $final=$del_amount/$total_products;
    ?>
<th>₹<?php echo $final; ?></th>
    <?php
}
else
{
       $final= $del_amount/$vendor_products;           
                   ?>
                                    <th>₹<?php echo $final; ?></th>
                                    <?php } ?>
                                    </tr>
                                     <break>

                                    <?php $bill=$bill+($r1['quantity']*($r1['price']-$r1['discount_price']));?>


<?php 
$sql5=mysqli_query($conn,"UPDATE order_detail SET delivery_amount=$final WHERE order_id=$oi AND product_id=(SELECT product_id FROM product WHERE `name`='".$r1['name']."')");
?>










                        <?php
                                } ?>
                                 <tr align="center" style="color:teal">
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                     <th>Total Bill</th>
                                     <th>₹ <?php echo $bill; ?></th>
                                     </tr>

                                </thead>
                                </table>

                                </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                        </div>
                                <div class="col-md-6">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
             
 
             
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

  
</body>

</html>