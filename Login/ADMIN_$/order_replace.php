<?php
session_start();
include 'con12.php';



    $sql="SELECT o_r.order_replace_id,o_r.date,ord.quantity,ord.reason,ord.product_id,p.display_picture,p.name FROM order_replace_detail AS ord INNER JOIN order_replace AS o_r ON o_r.order_replace_id=ord.order_replace_id INNER JOIN product AS p ON p.product_id=ord.product_id WHERE o_r.order_id=".$_GET['oi'];
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
    <title>Replaced Orders</title>
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Order Replace Details</h3></p> </center>
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
                                        
                                        <th>Order Replace Id</th>
                                        <th>Order Replace Date</th> 
                                        <th>Order Replace Reason</th> 
                                        <th>Replace Product</th>
                                        <th></th>
                                        <th>Replace Quantity </th>
                                        </tr>
                                    </thead>
                                    <?php while($row=mysqli_fetch_array($result)) 
                                          {?>
                                   
                                        <tr align="center">
                                        
                                        <th required  min="1" ><?php echo $row['order_replace_id']; ?></th>
                                        
                                       
                                        <th> <?php $d_date = date("d-m-Y", strtotime($row['date'])); echo $d_date ;?></th>
                                        
                                        
                                        <th pattern="[A-Za-z\s]*"><?php echo $row['reason']; ?></th>
                                        
                                      
                                        <th pattern="[A-Za-z\s]*" style= "text-transform:lowercase;"><?php echo $row['name']; ?></th>
                                         <th><img  height="50px" width="50px" src="/Login/image/Project_images/<?php echo $row['display_picture'];?>"></th>
                                       
                                        <th min="1"><?php echo $row['quantity']; ?> </th>
                                       
                                         </tr>
                                         <?php
                                                    include 'con12.php';
                                                    $q1="SELECT * FROM order_detail WHERE product_id=".$row['product_id']." AND order_id=".$_GET['oi'];
                                                    $s1=mysqli_query($conn,$q1);

                                          while($r1=mysqli_fetch_array($s1))
                                          {
                                              
                                              if($r1['quantity']==$row['quantity'])
                                              {
                                                include 'con12.php';
                                                  $q2="DELETE FROM order_detail WHERE product_id=".$row['product_id']." AND order_id=".$_GET['oi'];
                                                  $s2=mysqli_query($conn,$q2) ;
                                              }
                                              if($row['quantity']<$r1['quantity'])
                                              {
                                                  //here $r1[quantity] represents order_detail quantity
                                                  //and $row[quantity] represents order_replace_detail quantity
                                                  include 'con12.php';
                                                  $reduced_quantity=$r1['quantity']-$row['quantity'];
                                                  $q4="UPDATE order_detail SET quantity=$reduced_quantity WHERE product_id=".$row['product_id']." AND order_id=".$_GET['oi'];
                                                  $s4=mysqli_query($conn,$q4);
                                                }
                                              
                                            }  
                                        ?>
                                        

                                       

                                   
                                    <?php }?>
                                    <tbody>

                                
                                    
                                                   </table>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                        </div>
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
