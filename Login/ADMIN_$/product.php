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
    $record=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM product;"));

    $pagi=ceil($record/$per_page);
//ends here
$q5=mysqli_query($conn,"SELECT * FROM product");

while($r5=mysqli_fetch_array($q5))
{
    if($r5['offer/discount_id']==NULL)
    {
        $q1="SELECT p.product_id,p.name,p.description,p.price,p.value,p.unit_of_measurement,p.quantity_in_hand,pc.category_name,u.user_name,p.display_picture,p.p_status,p.`offer/discount_id` AS dis FROM product p INNER JOIN product_category pc ON p.product_category_id=pc.product_category_id INNER JOIN user u ON p.vendor_id=u.user_id ORDER BY u.user_name LIMIT $start,$per_page";

    }
    else
    {
        $q1="SELECT p.product_id,p.name,p.description,p.price,p.value,p.unit_of_measurement,p.quantity_in_hand,pc.category_name,u.user_name,p.display_picture,p.p_status,o.discount AS dis FROM product p INNER JOIN product_category pc ON p.product_category_id=pc.product_category_id INNER JOIN user u ON p.vendor_id=u.user_id INNER JOIN `offer/discount` o ON o.`offer/discount_id`=p.`offer/discount_id` ORDER BY u.user_name LIMIT $start,$per_page";

    }
}

// $r1 would fetch order,delivery,userand area details

$r1=mysqli_query($conn,$q1);


   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- below is for search -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Including our scripting file. for search -->
   <script type="text/javascript" src="script.js"></script>
   <!-- Including CSS file. for search-->
   <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     <link rel="stylesheet" href="styles.css" /> 
    <title>Products</title>
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Products</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                <div class="col-md-6">
                                    <!-- <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div> -->
                                    <!-- Search box. -->
   <input type="text" id="search" placeholder="Search by Product Name" />
                                </div> 
                                                     <!-- Suggestions of search will be displayed in below div. -->
                                                 
                                                        
                                                     <div id="display">
                                                    
      

   </div>
   
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable" style="width:100%;">
                                    <thead style= "text-transform:capitalize;">
                                        <tr align="center">
                                        <th>Product Image</th>
                                       <th>Product Id</th>
                                       <th>&nbsp;&nbsp;&nbsp;Product Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                       <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                       <th>&nbsp;&nbsp;Price</th>
                                       
                                       <th>Value</th>
                                      
                                       <th>Quantity in hand</th>
                                       <th>Product Category</th>
                                       <th>Vendor</th>
                                       <th>offer</th>
                                       <th>product status</th>
                                            
                                          
                                        </tr>
                                    </thead>

                                    <tbody>
                                       
                                    <?php 
while($row1=mysqli_fetch_array($r1))
{ 
    ?>
     <tr align="center">
    <td>
                 <img height="100px" width="100px" src="/Login/image/Project_images/<?php echo $row1['display_picture']; ?>">
    </td>
<td>
    <?php echo $row1['product_id'];?>
</td>
<td>
    <?php echo $row1['name'];?>
</td>
<td>
    <?php echo $row1['description'];?>
</td>

<td>
₹  <?php echo $row1['price'];?>
</td>
<td>
    <?php echo $row1['value'];?>
    <?php echo $row1['unit_of_measurement']; ?>
</td>

<?php
if($row1['quantity_in_hand'] == NULL){?>
    <td>
    -
</td>
<?php
}
else{?>
    <td>
    <?php echo $row1['quantity_in_hand'];?>
</td>
<?php
}
?>

<td>
    <?php echo $row1['category_name'];?>
</td>
<td>
    <?php echo $row1['user_name'];?>
</td>
<?php if($row1['dis']!=null)
{?>
<td>
    <?php echo $row1['dis'];?>%
</td>
<?php } 
else
{?>
<td>
    <?php echo $row1['dis'];?>
</td>
<?php } ?>

    <?php 
    if($row1['p_status']==0)
    {
    ?>
<td>INACTIVE</td>
<?php }
else
{
?>
<td>ACTIVE</td>

    <?php } 
?>
</tr>
<?php } ?>


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
   