<?php

session_start();
include 'con12.php';

// $q5="SELECT o.offer_discount_id,o.end_date,p.offer_discount_id AS pod FROM offer_discount o INNER JOIN product p ON p.offer_discount_id=o.offer_discount_id";
// $s5=mysqli_query($conn,$q5);
// $today=date('Y-m-d');

// echo $today;

// while($r5=mysqli_fetch_array($s5))
// {
//     echo "offer id".$r5['offer_discount_id'];
//     echo "end date".getDate($r5['end_date']);
// if(getDate(strtotime($r5['end_date'])) > $today)
// {
//         if($r5['pod']!=NULL)
//         {
//             echo "hey";
//             include_once 'con12.php';
//       $s6=mysqli_query($conn,"UPDATE product SET offer_discount_id=NULL WHERE offer_discount_id=".$r5['pod']);
//        $s7=mysqli_query($conn,"UPDATE offer_discount SET vendor_id=NULL WHERE offer_discount_id=".$r5['offer_discount_id']);
     

//        $s8=mysqli_query($conn,"DELETE FROM offer_discount WHERE offer_discount_id=".$r5['offer_discount_id']);
//         }
// }

// }
 
 ?>
<?php


//include_once 'con12.php';

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
$record=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM product;"));

$pagi=ceil($record/$per_page);
//ends here

$q1="SELECT p.`product_id`,p.is_customized,p.replaceable,p.p_status,p.`name`,p.`price`,p.`description`,p.`value`,p.`display_picture`,p.`unit_of_measurement`,p.`quantity_in_hand`,p.`offer/discount_id`,pc.`category_name` FROM product p INNER JOIN product_category pc ON pc.product_category_id=p.product_category_id WHERE p.vendor_id=(SELECT user_id FROM user WHERE user_name='$username' LIMIT $start,$per_page);";
$s1=mysqli_query($conn,$q1);

?>


<!DOCTYPE html>
<html lang="en">

<head>

<script src="jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
 <!-- pencil logo-->
 <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Vendor</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
</head>

<body>
    <!-- below code starts of fetching today's date and checking in offer table last date -->
    


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
                           <center> <p class="text-primary m-0 font-weight-bold"><h3>Products</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                <!--div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter">
                                        <form method="post" action="search.php">
                                        <label><input type="search" id="search" name="search_text" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search">
                                       
<div id="result">
</div>
                                    </label>
                                    </form> 
                                    </div>
                                </div-->
                            </div>
                           
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                                <div align="center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Add product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><a href="add_product.php" style="background-color: #d33b33;" class="btn btn-primary" name="submit">&#43;</a></div>

                                <table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr align="center">
                                        <th></th>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;Price</th>
                                        <th>Value & Measurement
                                        </th>
                                        <th>Quantity In Hand</th>
                                        <th> Status</th>
                                        <th>Product Category</th>
                                        <th>Customizable</th> 
                                        <th>Replacable</th>
                                        
                                        <th>Discount</th>
                                           <th></th>
                                           <th></th>
                                            
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
  
          // below code is to display database records
    while($rows=mysqli_fetch_array($s1))
    { ?>
        <tr>
            <?php if( $rows['display_picture'] ==NULL) 
            {  
            
               ?> <td align="center">   </td>
          <?php  }
            else
            { ?>
                <td align="center"><img width="65" height="65" src="/Login/image/Project_images/<?php echo $rows['display_picture']; ?>"></td>
        
           <?php }
            ?>
       <td align="center" min="1" required><?php echo $rows['product_id']; ?></td>
     
        <td align="center" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows['name']; ?></td>
        <td align="center" required  pattern="[A-Za-z\s]*"><?php echo $rows['description']; ?></td>
        

        <td align="center"min="1">₹ <?php echo $rows['price']; ?></td>
        <td align="center" min="0"><?php echo $rows['value']; ?>
        <?php echo $rows['unit_of_measurement']; ?></td>

        
        <td align="center" min="0"><?php echo $rows['quantity_in_hand']; ?></td>
        <?php 
        if($rows['p_status']==0)
        { ?>
        <td align="center" >inactive</td>
        <?php } 
         if($rows['p_status']==1)
         { ?>
         <td align="center" >active</td>
         <?php } ?>
         
       
        <td align="center" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows['category_name']; ?></td>
       <?php 
        if($rows['is_customized']==0)
        {
       ?>
        <td align="center">No</td>
       <?php }
       else
       {?>
        <td align="center">Yes</td>
       <?php }?>
       
       <?php 
        if($rows['replaceable']==0)
        {
       ?>
        <td align="center">No</td>
       <?php }
       else
       {?>
        <td align="center">Yes</td>
       <?php }?>
        <?php 
        if($rows['offer/discount_id']==NULL)
        {?>
         <td min="1" required align="center"><?php echo $rows['offer/discount_id']; ?></td>
        <?php 
        }
        else
        {
            $q2="SELECT `discount` FROM `offer/discount` WHERE `offer/discount_id`=".$rows['offer/discount_id'];
            $s2=mysqli_query($conn,$q2);
            while($r2=mysqli_fetch_array($s2))
            { ?>

<td align="center"><?php echo $r2['discount']; ?>%</td>                  

         <?php   }
            ?>
            
        <?php } ?>
      
<td>
 
<a href="edit_product.php?pid=<?php echo $rows['product_id']; ?>" style="background-color: #d33b33;" class="btn btn-primary" name="submit">	<i style='font-size:15px' class='fas'>&#xf304;</i></a></td>
<td>
    <form method="post">
<?php if($rows['p_status']==0)
  {  ?>    
<center>  <a href = 'view_product.php?action=delete&ps=1&pc=<?php echo $rows["product_id"];  ?>' style="background-color: #d33b33;" class="btn btn-primary" onclick="return confirm('Are you sure you want to active?')">ACTIVE   </a></center>

<?php }
else
{?>

 <center>  <a href = 'view_product.php?action=delete&ps=0&pc=<?php echo $rows["product_id"];  ?>' style="background-color: #d33b33;" class="btn btn-primary" onclick="return confirm('Are you sure you want to inactive?')">INACTIVE   </a></center>
<?php } ?>
</form>
</td>

        </tr>
        <?php } ?>
  

        <?php
if(isset($_GET['action']) && $_GET['action']=="delete") 
{
    $ps=$_GET['ps'];
    $pc=$_GET['pc'];
     $query=mysqli_query($conn,"UPDATE product SET p_status=$ps WHERE product_id=$pc");   
     if($query)
     {?>
            <script>
             window.location.href = 'view_product.php';
            </script>
         <?php
     }
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
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    
</body>

</html>
<?php connection_aborted(); ?>