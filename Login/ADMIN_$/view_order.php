<?php 

session_start();
include_once 'con12.php';

$oi=$_GET['oi']; 

$q1="SELECT p.name,p.display_picture,od.quantity,od.price FROM order_detail AS od INNER JOIN product AS p ON p.product_id=od.product_id WHERE order_id=$oi";    
  
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
    <title>Payment Details</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:grey;">
          <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
             
                    
                    <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Order Details of <?php echo $oi;?> Order id</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable">
                                <thead >
                                        <tr align="center">
                                        
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Line Total</th>
                                            
                                            
                                          
                                        </tr>
                                    </thead>
                                
                                 <?php 
                                
  
                                $bill=0;
                                while($r1=mysqli_fetch_array($s1))
                                {
                                 ?>
                                 <tr align="center">
                                    
                                     <td required  ><img  height="50px" width="50px" src="image/Project_images/<?php echo $r1['display_picture'];?>"></td>
                                    
                                    
                                     <td required   style= "text-transform:lowercase;"><?php echo $r1['name'];?></td>
                                    
                                     <td min="1" required><?php echo $r1['quantity']; ?></td>
                                    
                                   
                                     <td min="1" required>₹  <?php echo $r1['price']; ?></td>
                                     <td>₹ <?php echo $r1['quantity']*$r1['price']; ?></td>
                                     </tr>
                                     
                                     <break>
                                    <?php $bill=$bill+($r1['quantity']*$r1['price']);?>













                        <?php
                                } ?>
                                 <tr align="center">
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                     <th>Total Bill</th>
                                     <th min="1">₹  <?php echo $bill; ?></th>
                                     </tr>

                            
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