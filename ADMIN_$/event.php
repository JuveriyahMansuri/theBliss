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
    $record=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM event_booking;"));

     $pagi=ceil($record/$per_page);
 //ends here

    $sql="SELECT eb.event_booking_id,u.user_name,eb.event_booking_date,eb.event_date,eb.event_time,et.event_name,eb.event_status,eb.cancellation_date FROM event_booking eb INNER JOIN  user u ON u.user_id=eb.customer_id INNER JOIN event_type et ON et.event_type_id=eb.event_type_id LIMIT $start,$per_page";
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
    <title>Event</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:grey ;">
          <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
             
                    
                    <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Events</h3></p> </center>
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
                                    <thead style= "text-transform:capitalize;">
                                        <tr align="center" style="width:30px">
                                        <th>Event Booking Id</th>
                                            <th > &nbsp;Event Booking Date  </th>
                                            <th > Event Date</th>
                                            <th>Event Time</th>
                                            <th>Event Name</th>
                                           
                                            <th>Customer Name</th>
                                            <th>Event Status</th>
                                           <th>Cancellation Date</th>

                                            <!-- <th> &nbsp;&nbsp;&nbsp;Product_Name</th> -->
                                            <!-- <th>Quantity</th>
                                            <th>Image uploaded by customer</th> -->
                                            
                                            <!-- <th>Price</th>
                                            <th>Approval By Vendor</th> -->
                                            <th>Total amount</th>
                                            <th>     </th>
                                             <th>     </th>
                                            
                                           
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
include 'con12.php';
     while($rows=mysqli_fetch_array($result))
     {
        $e1=$rows['event_booking_id'];
?>
<tr>
        <td align="center" min="1"><?php echo $rows['event_booking_id']; ?></td>
        <td align="center"> <?php $d_date = date("d-m-Y", strtotime($rows['event_booking_date'])); echo $d_date ;?></td>
        <td align="center"> <?php $d_date = date("d-m-Y", strtotime($rows['event_date'])); echo $d_date ;?></td>
        <td align="center"><?php echo $rows['event_time']; ?></td>
        <td align="center" style= "text-transform:lowercase;"><?php echo $rows['event_name']; ?></td>
        <td align="center" style= "text-transform:capitalize;"><?php echo $rows['user_name']; ?></td>
        
                   <td align="center"><?php echo $rows['event_status']; ?></td>   


<?php
include 'con12.php';
           $q1="SELECT p.name,ebd.quantity,ebd.image,ebd.eprice,ebd.approval FROM event_booking_detail AS ebd INNER JOIN product AS p ON p.product_id=ebd.product_id WHERE ebd.event_booking_id=$e1";
           $r1=mysqli_query($conn,$q1);
           $j=0;
           $bill=0;
           while($row=mysqli_fetch_array($r1))
           {
                    if($j==0)
                    {
?>
                        <!-- <td align="center" style= "text-transform:lowercase;"><?php //echo $row['name']; ?></td>  -->
                        <!-- <td align="center" ><?php //echo $row['quantity']; ?></td>                              -->
                        <!-- <td align="center"><img src="image/Project_images/<?php //echo $row['image']; ?>" class="rounded-circle mr-2" width="30" height="30" ></td>
                        <td align="center"><?php //echo $row['price']; ?></td> -->

                      
       

                        <!-- <td align="center"><?php //echo $row['approval']; ?></td> -->
                        <?php 
                      
                        if($row['eprice']!=NULL)
                        {    
                            $bill=$bill+$row['eprice']*$row['quantity'];
                            }
                        else
                        {

                              $bill=$bill+0;                                
                       }
             
                        
                    }
                    else
                    {
                        
 ?>                    
                         <!-- <tr>
                         <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td> -->
                        <!-- <td align="center" required pattern="[0-9]{10}" style= "text-transform:capitalize;"><?php //echo $row['name']; ?></td> 
                       
                        <td align="center" required min="1"><?php //echo $row['quantity']; ?></td>  -->
<?php                   if($row['image']==NULL)
                        {       ?>
                                   <!-- <td align="center"></td> -->
  <?php                      }     
                         else
                         {     ?>
                                           <!-- <td align="center"><img src="/Login/image/Project_images/<?php //echo $row['image']; ?>" class="rounded-circle mr-2" width="30" height="30" ></td>
                       -->
        <?php                 }  ?>                      
                         <!-- <td align="center" min="1" required><?php //echo $row['price']; ?></td>
                        <td align="center"><?php // echo $row['approval']; ?></td> -->

<?php 
 
                        if($row['eprice']!=NULL)
                        {    
                            $bill=$bill+$row['eprice']*$row['quantity'];
                            }
                        else
                        {

                              $bill=$bill+0;                                
                       }
                    }
            
                    $j++;     
           }
       ?>
<td align="center">₹ <?php echo $bill; ?></td>
<td> <center>  <a style="background-color:grey; font-weight: bold; color:white; " href = 'event_detail.php?ei=<?php echo $e1; ?>' class="btn btn-primary" >VIEW   </a></center></td>
</tr>
<!-- <td align="center"><a href="payment_details.php?ei=<?php echo $e1; ?>&bill=<?php echo $bill; ?>" > View Payment Details</a></td>      -->

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
