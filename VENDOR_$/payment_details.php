<?php

session_start();
include 'con12.php';


    
   $sql="SELECT pay.payment_id,pay.payment_mode,pay.amount,pay.payment_date,pay.payment_reference_type FROM payment AS pay INNER JOIN event_booking AS eb ON eb.event_booking_id=pay.event_booking_id WHERE eb.event_booking_id=".$_GET['ei'];
    $result=mysqli_query($conn,$sql);
   
   
   
   


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
        <div id="page-content-wrapper" style="background-image: linear-gradient(to right top, #f4f3f3, #f6cdcc, #f4a7a4, #ec8179, #df594e, #df594e, #df594e, #df594e, #ec8179, #f4a7a4, #f6cdcc, #f4f3f3);">
          <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
             
                    
                    <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Payment Details</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable">
                                    
                                    <thead align="center">
                                    <th align="center">Payment Id</th>
                                    <th align="center">Payment Mode</th>
                                    <th align="center">Amount paid</th>
                                    <th align="center">Payment Date </th>
                                    <th align="center">Payment Reference Type</th>
</thead>

                                    
                                    <?php
                                    $a=0;
                                    while($row=mysqli_fetch_array($result)) 
                                          {
                                            
                                              ?>
                                    
                                        <tr align="center">
                                       
                                        <td align="center"><?php echo $row['payment_id']; ?></td>
                                        
                                        
                                        <td align="center" style= "text-transform:lowercase;"><?php echo $row['payment_mode']; ?></td>
                                         
                                             <?php $a=$a+$row['amount']; ?>
                                       
                                        <td align="center"><?php echo $row['amount']; ?></td>
                                        
                                        
                                        <td align="center"> <?php $d_date = date("d-m-Y", strtotime($row['payment_date'])); echo $d_date ;?></td>
                                        
                                       
                                        <td align="center" required style= "text-transform:capitalize;"><?php echo $row['payment_reference_type']; ?></td>
                                         </tr>
         
                                         
         
                                       

                                   
                                    <?php }
                                    ?>

                                   
                                    <tbody>

                                
                                    
                                                   </table>
                                                   <table>
                                                   <?php 
                                    if($a==$_GET['bill'])
                                    {
                                        $a=0; 
                                    }
                                    else
                                    {
                                        $a=$_GET['bill']-$a;
                                    }
                                    
                                    ?>
                                    <break>
                                    <break>
                                    <break>
                                    <tr><h5 min="1" align="center">Amount Remaining to Pay <?php echo $a;?></h5></tr>
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














          