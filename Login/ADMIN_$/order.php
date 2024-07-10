<?php
session_start();
include 'con12.php';
?>



<?php

   //below is for pagination
    $per_page=5;
    $start=0;
    $current_page=1;
    if(isset($_GET['start']))
    {
        $start=$_GET['start'];
        $current_page=$start;
        $start--;
        $start=$start*$per_page;
    }
    $record=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `order`;"));

    $pagi=ceil($record/$per_page);
//ends here
// $r1 would fetch order,delivery,userand area details
 $q1="SELECT o.order_id,o.area_pincode,o.order_date,o.delivery_date,o.delivery_address,o.delivery_status,o.payment_mode,o.order_status,o.cancellation_date,o.total_amount,u.user_name,a.area_name FROM `order` AS o INNER JOIN user AS u ON u.user_id=o.customer_id INNER JOIN area AS a ON a.pincode=o.area_pincode ORDER BY o.order_date DESC LIMIT $start,$per_page";
 $r1=mysqli_query($conn,$q1);
   
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
    <title>Orders</title>
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Orders</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable" style="width:120%;">
                                    <thead style= "text-transform:capitalize;">
                                        <tr align="center">
                                        <th style="width:10%;">Order Id</th>
                                            <th style="width:10%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Order date &nbsp;&nbsp;&nbsp;&nbsp;  </th>
                                            <th style="width:10%;">Delivery date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      </th>
                                            <th >Delivery address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                             <th>Delivery status</th> 
                                            <th>Payment mode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>Order status</th>
                                            <th>Cancellation date</th>
                                          
                                            <th>Customer name</th>
                                            <th>Area</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <!-- <th>Product Name</th>
                                            <th>Quantity purchased</th>
                                            
                                            <th>price after discount</th>
                                            <th>Product Replaced</th>
                                            <th>Total amount</th> -->
                                           
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>

<?php 
while($rows1=mysqli_fetch_array($r1))
{ 
                     $o1=$rows1['order_id'];    
?>
                <tr align="center">
                    <td><?php echo $rows1['order_id']; ?></td>
                    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $d_date = date("d-m-Y", strtotime($rows1['order_date'])); echo $d_date ;?></td>
                    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php $d_date = date("d-m-Y", strtotime($rows1['delivery_date'])); echo $d_date ;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td required pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows1['delivery_address']; ?></td>
                    <?php 
             if( $rows1['delivery_status'] =="accepted") 
             {  
            
?>                     <td align="center" ><button style="font-weight : bold;  color:white; background: green;border-radius: 25px;"> <?php echo $rows1['delivery_status']; ?> </button></td>
<?php
             }
?>
<?php
             if( $rows1['delivery_status'] =="delivered") 
             {  
?>                    <td align="center"> <button style="background: #c00;color:white; border-radius: 25px;"><?php echo $rows1['delivery_status']; ?> </button></td>
<?php
             } 
?>
<?php
             if( $rows1['delivery_status'] =="pending") 
            {  
            
?>                   <td align="center" style="background:blue;border-radius: 25px; font-weight : bold;"><?php echo $rows1['delivery_status']; ?></td>
<?php
            } 
?>
 <?php 
            if( $rows1['delivery_status'] ==NULL) 
            {  
?>                 <td align="center"> - </td>
<?php 
            }
?> 
                   <td align="center"style="text-transform:lowercase;" ><?php echo $rows1['payment_mode']; ?></td>
                   <?php
             if( $rows1['order_status'] =="confirmed") 
             {  
            
?>                 <td align="center" ><button style="font-weight : bold;  color:white; background: green;border-radius: 25px;"><?php echo $rows1['order_status']; ?> </button></td>
<?php
             } 
?>
<?php 
             if( $rows1['order_status'] =="rejected") 
             {  
            
?>                 <td align="center" style="background: #c00;border-radius: 25px;"><?php echo $rows1['order_status']; ?></td>
<?php 
            } 
?>
<?php 
            if( $rows1['order_status'] =="pending") 
            {  
?>                 <td align="center"> <button style="background:blue;border-radius: 25px; font-weight : bold;  color:white;"><?php echo $rows1['order_status']; ?> </button></td>
<?php 
            }
?>
<?php 
            if( $rows1['order_status'] =="delivered") 
            {  
?>                 <td align="center"> <button style="background:yellow;border-radius: 25px;"><?php echo $rows1['order_status']; ?> </button></td>
<?php 
            }
?>
<?php 
            if( $rows1['order_status'] ==null) 
            {  
?>                 <td align="center" ></td>
<?php 
            }
?>
<?php 
            if( $rows1['order_status'] =='cancelled') 
            {  
?>                <td align="center"> <button style="background:red;border-radius: 25px; font-weight : bold;  color:white;"><?php echo $rows1['order_status']; ?> </button></td>
<?php 
            }
?>
<?php 
if($rows1['cancellation_date']==null)
{
?>
 <td align="center"> - </td>
 
<?php
}
else
{
?>
                <td align="center" required pattern="^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/([12][0-9]{3})$"><?php echo $rows1['cancellation_date']; ?></td>
 <?php } ?>     
                <td align="center" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows1['user_name']; ?></td>
                 <td align="center" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows1['area_name']; ?></td>
                 <td> <center>  <a style="background-color:grey; font-weight: bold; color:white;" href = 'view_order.php?oi=<?php echo $rows1['order_id']; ?>' class="btn btn-primary">VIEW</a></center></td>
                 <?php $q5="SELECT * FROM order_replace";
                       $s5=mysqli_query($conn,$q5);
                       while($r5=mysqli_fetch_array($s5))
                       {
                           if($r5['order_id']==$o1)
                           {
                 ?>
                
                 
                 
                 <td> <center>  <a href = 'order_replace.php?oi=<?php echo $rows1['order_id']; ?>' class="btn btn-primary">VIEW  ORDER REPLACE  </a></center></td>
<?php } 
else
{?>
<td></td>
<?php } 
}?>
<?php 
//$rows2['requested']==1 means vendor has sent request to delivery person 
 if( $rows1['order_status'] =="delivered" || $rows1['order_status'] =="cancelled" || $rows1['order_status'] =="pending" /*|| $rows1['requested']==1 */)
 {
?>
 <td></td>
<?php } 
else {?>
<td> <center>  <a href = 'req_for_delivery.php?oid=<?php echo $o1;?>&area=<?php echo $rows1['area_pincode']; ?>' class="btn btn-primary"><i class="fa fa-truck">&nbsp;&nbsp;REQUEST</i> </a></center></td>

<?php } ?>
               </tr>
                
<?php
} 
?>




                                    </table>
                               
                               </div>
                               <div class="row">
                                   <div class="col-md-6 align-self-center">
                                           </div>
                                   <div class="col-md-6">
                                   <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <!-- <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                             -->
                                             <?php 
                                            
                                             for($i=1;$i<=$pagi;$i++)
                                             {
                                                $class='';
                                                if($current_page==$i)
                                                {
                                                    $class='active';
                                                } 
                                                 ?>
                                            <li class="page-item <?php echo $class; ?>"><a style="background-color:grey; color:white" class="page-link" href="?start=<?php echo $i?>"><?php echo $i?></a></li>
                                            <?php } ?>
                                             <!-- <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                         -->
                                        </ul>
                                    </nav> 
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
   