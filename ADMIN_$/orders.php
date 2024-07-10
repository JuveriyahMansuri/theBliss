<?php
session_start();
include 'con12.php';

// $sql would fetch order,delivery,userand area details
 $sql="SELECT o.order_id,o.order_date,o.delivery_date,o.delivery_address,o.delivery_status,o.payment_mode,o.order_status,o.cancellation_date,o.total_amount,u.user_name,a.area_name FROM `order` AS o INNER JOIN user AS u ON u.user_id=o.customer_id INNER JOIN area AS a ON a.pincode=o.area_pincode";
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
        <div id="page-content-wrapper" style="background-image: linear-gradient(to right top, #f4f3f3, #f6cdcc, #f4a7a4, #ec8179, #df594e, #df594e, #df594e, #df594e, #ec8179, #f4a7a4, #f6cdcc, #f4f3f3);">
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
                               
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr align="center">
                                        <th>Order Id</th>
                                            <th >Order Date  </th>
                                            <th> Delivery Date      </th>
                                            <th>Delivery Address</th>
                                            <th>Delivery Status</th>
                                            <th>Payment Mode</th>
                                            <th>Order Status</th>
                                            <th>Cancellation Date</th>
                                          
                                            <th>Customer name</th>
                                            <th>Area</th>
                                            <th>Product Name</th>
                                            <th>Quantity purchased</th>
                                            
                                            <th>price after discount</th>
                                            <th>Product Replaced</th>
                                            <th>Total amount</th>
                                           
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
<?php
                                   
//$i=0;
 // the below code is to display database records 
        while($rows=mysqli_fetch_array($result))
        { 
               $o1=$rows['order_id'];
?>
            <tr>
                       <td align="center" min="1" required><?php echo $rows['order_id']; ?></td>
                       <td align="center" required pattern="^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/([12][0-9]{3})$"><?php echo $rows['order_date']; ?></td>
                       <td align="center"required pattern="^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/([12][0-9]{3})$"><?php echo $rows['delivery_date']; ?></td>
                       <td align="center" required  pattern="[A-Za-z\s]*"><?php echo $rows['delivery_address']; ?></td>
<?php 
             if( $rows['delivery_status'] =="accepted") 
             {  
            
?>                     <td align="center" style="background: green;border-radius: 25px;"><?php echo $rows['delivery_status']; ?></td>
<?php
             }
?>
<?php
             if( $rows['delivery_status'] =="rejected") 
             {  
?>                    <td align="center" style="background: #c00;border-radius: 25px;"><?php echo $rows['delivery_status']; ?></td>
<?php
             } 
?>
<?php
             if( $rows['delivery_status'] =="pending") 
            {  
            
?>                   <td align="center" style="background:yellow;border-radius: 25px;"><?php echo $rows['delivery_status']; ?></td>
<?php
            } 
?>
               
                     <td align="center"><?php echo $rows['payment_mode']; ?></td>
       
<?php
             if( $rows['order_status'] =="confirmed") 
             {  
            
?>                 <td align="center" style="background: green;border-radius: 25px;"><?php echo $rows['order_status']; ?></td>
<?php
             } 
?>
<?php 
             if( $rows['order_status'] =="rejected") 
             {  
            
?>                 <td align="center" style="background: #c00;border-radius: 25px;"><?php echo $rows['order_status']; ?></td>
<?php 
            } 
?>
<?php 
            if( $rows['order_status'] =="pending") 
            {  
?>                 <td align="center" style="background:yellow;border-radius: 25px;"><?php echo $rows['order_status']; ?></td>
<?php 
            }
?>
                    <td align="center" required pattern="^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/([12][0-9]{3})$" ><?php echo $rows['cancellation_date']; ?></td>
      
                    <td align="center" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows['user_name']; ?></td>
                    <td align="center" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows['area_name']; ?></td>
       
<?php
       
                    $q2="SELECT od.quantity,p.offer_discount_id,od.quantity,od.product_id,p.name,p.product_id,p.price FROM order_detail AS od INNER JOIN product AS p ON p.product_id=od.product_id WHERE order_id=$o1";
                    $res=mysqli_query($conn,$q2);
           
           
                    $q3="SELECT product_id FROM order_replace_detail WHERE order_replace_id=(SELECT order_replace_id FROM order_replace WHERE order_id=$o1)";
                    $r3=mysqli_query($conn,$q3);

$j=0;
                    // the below code is to display database records 
                    while($row=mysqli_fetch_array($res))
                    { 

                            if($j==0)
                            { 
                                        if($row['offer_discount_id']!=NULL)
                                        {
                                                     $q1="SELECT offer.discount,p.price FROM offer_discount AS offer INNER JOIN product AS p ON p.offer_discount_id=offer.offer_discount_id WHERE p.product_id=".$row['product_id'];
                                                     $r1=mysqli_query($conn,$q1);
                                                     $dis=0;
                                                     $amt_after_dis=0;

                                                            while($r=mysqli_fetch_array($r1))
                                                            {
                     
                                                                       $dis=$r['price'] * ($r['discount']/100);
                                                                       $amt_after_dis=$r['price']-$dis;
                                                                       $bill=$row['quantity']*$amt_after_dis;
                                                            }
                                        }

                                         else
                                        {
                                        $amt_after_dis=$row['price'];
                                        $bill=$row['quantity']*$amt_after_dis;
                                        }
            
?>
                                        <td align="center"><?php echo $row['name']; ?></td>
                                        <td align="center"><?php echo $row['quantity']; ?></td>
    
                                        <td align="center"><?php echo $amt_after_dis; ?></td>


 <?php 
                                while($r=mysqli_fetch_array($r3))
                                {
                                        
                                            if($r['product_id']==$row['product_id'])
                                            { ?>
                                                    <td align="center"><a href="order_replace.php?oi=<?php echo $rows['order_id'];?>">YES</a></td>
                                      <?php }  
                 
                                            if($r['product_id']!=$row['product_id'])
                                            { ?>
                                                    <td align="center"><a href="">NO</a></td>
                                   <?php    }
                                   ?>
                     <?php      } ?>
          
    <?php                 }
                          else      
                          {

                                        if($row['offer_discount_id']!=NULL)
                                        {
                                          $q1="SELECT offer.discount,p.price FROM offer_discount AS offer INNER JOIN product AS p ON p.offer_discount_id=offer.offer_discount_id WHERE p.product_id=".$row['product_id'];
                                          $r1=mysqli_query($conn,$q1);
                                          $dis=0;
                                          $amt_after_dis=0;
             
                                                         while($r=mysqli_fetch_array($r1))
                                                        {
                                                                  $dis=$r['price'] * ($r['discount']/100);
                                                                  $amt_after_dis=$r['price']-$dis;
                                                                  $bill=$row['quantity']*$amt_after_dis;
                                                         }
           
             
                                        }
                                        else
                                        {
                                             $amt_after_dis=$row['price'];
                                             $bill=$row['quantity']*$amt_after_dis;
                                        }

        ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="center" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $row['name']; ?></td>
                                    <td align="center" min="1" required><?php echo $row['quantity']; ?></td>
                                    <td align="center" min="1"><?php echo $amt_after_dis; ?></td>
                                     <td align="center"></td>

        <?php 
                                    while($r=mysqli_fetch_array($r3))
                                    {
                                                 if($r['product_id']==$row['product_id'])
                                                 { ?>
                                                      <td align="center"><a href="order_replace.php?">YES</a></td>
                                          <?php   }  
                
                                                 if($r['product_id']!=$row['product_id'])
                                                 { ?>
                                                           <td align="center"><a href="">NO</a></td>
                                        <?php    }
                                            ?>
                              <?php } ?>
                       <?php } 
     ?>
      

        
      
        <?php
        $rows['total_amount']=$rows['total_amount']+$bill;
       
$j++;
}
?>
       
      
       
       
       <td align="center"><?php echo $rows['total_amount']; ?></td>

       <?php
//$i++;
}
?>

</tr>
                                </table>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                        </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
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
