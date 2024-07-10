<?php
session_start();
include 'con12.php';


$username=$_SESSION['username'];

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
$record=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `event_booking`;"));

$pagi=ceil($record/$per_page);
//ends here


$q8="SELECT * FROM user WHERE user_name='$username'";
$s8=mysqli_query($conn,$q8);
while($r8=mysqli_fetch_array($s8))
{
    $uid=$r8['user_id'];
}
// $r1 would fetch order,delivery,userand area details
// $q1="SELECT o.order_id,o.order_date,o.delivery_date,o.delivery_address,o.delivery_status,o.payment_mode,o.order_status,o.cancellation_date,o.total_amount,u.user_name,a.area_name FROM `order` AS o INNER JOIN user AS u ON u.user_id=o.customer_id INNER JOIN area AS a ON a.pincode=o.area_pincode";
 //$r1=mysqli_query($conn,$q1);
 $q1="SELECT DISTINCT e.event_booking_id FROM `event_booking` AS e INNER JOIN event_booking_detail AS ebd ON ebd.event_booking_id=e.event_booking_id INNER JOIN product AS p ON p.product_id=ebd.product_id WHERE p.vendor_id=$uid LIMIT $start,$per_page"; 
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
    <title>Events</title>
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Event</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                <!--div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div-->
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr align="center">
                                        <th>Event Booking Id</th>
                                            <th >Event Booking Date  </th>
                                            <th> Event Date      </th> 
                                            <th>Event Time</th>
                                            <th>Event Type</th>
                                           
                                          
                                            <th>Customer Name</th>
                                            <th>Address</th>
                                            <th>Event Status</th>
                                            <th></th>
                                            <!-- <th></th> -->
                                            
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
                     $o1=$rows1['event_booking_id'];  
                   $q2="SELECT e.event_booking_id,e.event_booking_date,et.event_name,e.event_time,e.event_date,u.user_name,u.addr,e.event_status FROM event_booking AS e  INNER JOIN event_type et ON et.event_type_id=e.event_type_id INNER JOIN user AS u ON u.user_id=e.customer_id WHERE e.event_booking_id=$o1";
                     $r2=mysqli_query($conn,$q2);
                     while($rows2=mysqli_fetch_array($r2))
                     {
                        $o1=$rows2['event_booking_id'];
?>

                <tr>
                    <td min="1" required><?php echo $rows2['event_booking_id']; ?></td>
                   <td type="date" format='dd-mm-yyyy' required><?php $d_date = date("d-m-Y", strtotime($rows2['event_booking_date'])); echo $d_date ;?></td>
                    <td required pattern="[A-Za-z\s]*"><?php echo $rows2['event_date']; ?></td>
                    <td required pattern="[A-Za-z\s]*"><?php echo $rows2['event_time']; ?></td>
                   
                   
                   <td align="center"><?php echo $rows2['event_name']; ?></td>
                   
                <td align="center" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows2['user_name']; ?></td>
                 <td align="center" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows2['addr']; ?></td>

                 <?php
                 if( $rows2['event_status'] == 'pending' )
                 {?>
                    <td align="center" style= "text-transform:capitalize;"> <button style="font-weight : bold;  color:white; background: blue;border-radius: 25px;"><?php echo $rows2['event_status']; ?> </button></td>
                <?php
                 }
                 ?>

<?php
                 if( $rows2['event_status'] == 'confirmed' )
                 {?>
                    <td align="center" style= "text-transform:capitalize;"> <button style="font-weight : bold;  color:white; background: green;border-radius: 25px;"><?php echo $rows2['event_status']; ?> </button></td>
                <?php
                 }
                 ?>

<?php
                 if( $rows2['event_status'] == 'rejected' )
                 {?>
                    <td align="center" style= "text-transform:capitalize;"> <button style="font-weight : bold;  color:white; background: red;border-radius: 25px;"><?php echo $rows2['event_status']; ?> </button></td>
                <?php
                 }

                 ?>

              
                
                 <td> <center>  <a href = 'view_event_details.php?oi=<?php echo $rows2['event_booking_id']; ?> && appr=<?php echo $rows2['event_status'];?>' style="background-color: #d33b33;" class="btn btn-primary"><b>VIEW EVENT BOOKING DETAILS</b> </a></center></td>
 
                 
                 <!-- <td> <center>  <a href = 'payment_details.php?ei=<?php echo $rows2['event_booking_id']; ?>' class="btn btn-primary">VIEW  ORDER REPLACE  </a></center></td>
        -->
                </tr>
                
<?php
} }
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
                                            <li class="page-item <?php echo $class; ?>"><a style="background-color: #d33b33; color:white;" class="page-link" href="?start=<?php echo $i?>"><?php echo $i?></a></li>
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
   