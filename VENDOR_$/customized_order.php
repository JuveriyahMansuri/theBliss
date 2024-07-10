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
$record=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `customized_order`;"));

$pagi=ceil($record/$per_page);
//ends here
    $sql=mysqli_query($conn,"SELECT c.image,c.c_date,c.quantity,c.customized_details,c.customized_id,p.name,u.user_name,c.approval,c.amount FROM customized_order c INNER JOIN user u ON c.customer_id=u.user_id INNER JOIN product p ON p.product_id=c.product_id WHERE p.vendor_id=(SELECT user_id FROM user WHERE user_name='$username') LIMIT $start,$per_page;");

?>

<!DOCTYPE html>
<html lang="en">

<link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">  <!-- add your logo it will be visible on title bar -->
    <link rel="apple-touch-icon" href="The Bliss.png">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Customized Order</title>
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Customized Orders</h3></p> </center>
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
                                <br> <br> <table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr align="center">
                                        <th>Customized Image</th>
                                            <th >Customized Id</th>
                                            <th>Customization Date</th>
                                            <th>Customized Details&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                         <th>Quantity</th>
                                         <th>&nbsp;Price</th>
                                            <th>Total Bill</th>
                                            <th>Product Name</th>
                                            
                                            <th>Customer Name</th>
                                            <th>Approval</th>
                                            <th></th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
  
 // the below code is to display database records 
    while($rows=mysqli_fetch_array($sql)){ ?>
        <tr>
            <?php if( $rows['image'] ==NULL) 
            {  
            
               ?> <td align="center">   </td>
          <?php  }
            else
            { ?>
                <td align="center"><img class="rounded-circle mr-2" width="50" height="50" src="/Login/image/custom_order/<?php echo $rows['image']; ?>"></td>
        
           <?php }
            ?>
       <td align="center" required min="1"><?php echo $rows['customized_id']; ?></td>
       <td align="center" type="date" format='dd-mm-yyyy'><?php $d_date = date("d-m-Y", strtotime($rows['c_date'])); echo $d_date ;?></td>
        <td align="center" required  pattern="[A-Za-z\s]*"><?php echo $rows['customized_details']; ?></td>
        <td align="center" min="1"><?php echo $rows['quantity']; ?></td>
        <td align="center" min="1">₹ <?php echo $rows['amount']; ?></td>

 <?php      
        if($rows['amount']==NULL)
        { ?>
                   <td align="center"></td>
        <?php }
        else
        {?>
        <td align="center">₹ <?php echo $rows['quantity']*$rows['amount']; ?></td>
        <?php } ?>
        <td align="center"pattern="[A-Za-z\s]*" required style= "text-transform:capitalize;"><?php echo $rows['name']; ?></td>
        
        <td align="center"pattern="[A-Za-z\s]*" required style= "text-transform:capitalize;"><?php echo $rows['user_name']; ?></td>
        <td align="center"><?php echo $rows['approval']; ?></td>
       
        
        <?php 
             
            if($rows['approval']=='pending')
            {
            ?>

<td> <a href="c_order_accept_reject.php?cid=<?php echo $rows['customized_id']; ?>" style="background-color: #d33b33;" class="btn btn-primary" name="submit"><b>Click here to accept the order</B</a></td>
<?php } 
else 
{
?>
<td></td>
<?php } ?>

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