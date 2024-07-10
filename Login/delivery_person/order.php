<?php


include 'con12.php';
session_start();
$username=$_SESSION['username'];
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
        <div id="page-content-wrapper" style="background-color:teal;">
         <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
             
                    
                    <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Request For Delivery</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="5" selected="">5</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                    
                                  </div> -->
                               
                               
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr align="center">
                                            <th>Request Id</th>
                                            <th>Order Id</th>
                                            <th>Amount</th>
                                            <th>Delivery Date</th>
                                            <th>Customer Name</th>
                                        <th>Customer Mobile</th>
                                        
                                      
                                      
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delivery Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <!-- <th>Product Name</th> -->
                                        <!-- <th>Vendor Name</th>
                                        <th>Vendor Address</th> -->
                                        <th>Status</th>
                                        <th></th>
                                        <th></th> 
                                                                       
                                        </tr>
                                    </thead>
                                    <tbody>   
                                    <form method="post">                               
                                   <?php 
                                  $q1="SELECT r.amount,r.request_delivery_id,o.order_id,o.delivery_date,c.user_name AS customer,c.mobile,o.delivery_address,r.is_accept FROM request_delivery r INNER JOIN `order` o ON r.order_id=o.order_id INNER JOIN user c ON c.user_id=o.customer_id WHERE r.delivery_person_id=(SELECT user_id FROM user WHERE user_name='$username') ORDER BY r.request_delivery_id DESC";
                                  $s1=mysqli_query($conn,$q1);
                                  
                                   while($r1=mysqli_fetch_array($s1))
                                   { ?>
<tr align="center">
    <td ><?php echo $r1['request_delivery_id']; ?></td>
    <?php $rd_id=$r1['request_delivery_id']; ?>
    <td ><?php echo $r1['order_id']; ?></td>
    <td ><?php echo $r1['amount']; ?></td>
    <td ><?php echo $r1['delivery_date']; ?></td>
    <td ><?php echo $r1['customer']; ?></td>
    <td ><?php echo $r1['mobile']; ?></td>
    <td ><?php echo $r1['delivery_address']; ?></td>
    <!-- <td ><?php// echo $r1['vendor']; ?></td>
    <td ><?php// echo $r1['vendor_address']; ?></td> -->
   <?php
    if($r1['is_accept']==NULL || $r1['is_accept']=="pending")
    { ?>
 <td >pending</td>
   <?php }
//    if($r1['is_accept']==null)
//     {
    ?>
   <?php 
    if($r1['is_accept']=="accepted")
    {
    ?>
    <td ><?php echo "accepted" ?></td>
    <?php } 
   if($r1['is_accept']=="rejected")
    {?>
     <td ><?php echo "rejected" ?></td>
    <?php }
    ?>
    <td >
    </td>
<td>
    <?php
    if($r1['is_accept'] == 'pending'){?>
        <a style="background-color:teal;" class="btn btn-primary" href="accept.php?amt=<?php echo $r1['amount']; ?>&ac=<?php echo $r1['is_accept'];?>&r_id=<?php echo $r1['request_delivery_id']; ?>" name="submit">View</a>
    </td>
 <?php   }
   
    ?>
   


    </td>
   <?php //} 
//    if($r1['is_accept']!=null)
//    {?>
   <td></td>
   <?php //} ?>

  
    </tr>
       <?php

}

?>
                                  
                               

   
</form>
    
                                </table>
                                            
                            </div>
                            <div class="row">
                                <!-- <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div> -->
                                <div class="col-md-6">
                                    <!-- <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav> -->
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