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
    <!-- the below script is for ajax code-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Add Product</title>
    <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
    <script>
        function updatePrice(id){
            oid = $(id).attr("id");
            a_r = $(id).val();
            console.log(oid);
            $.ajax({
                url:'change-status.php',
                method: 'POST',
                data:{
                    oid : oid,
                    a_r : a_r,
                    
                },
                success:function(data){
                    console.log('success');
                    window.location.href('status_of_delivery.php');
                }
            });
           
        }
        
        </script>

</head>

<!-- <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap.min.css" rel="stylesheet" /> -->
    <!-- the below script is for ajax code-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Delivery Dashboard</title> 
</head>  -->

<body >
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Orders</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <!-- <div class="row">
                                
                               
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div> -->
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr align="center">
                                            <th>Request Id</th>
                                            <th>Order Id</th>
                                            <th>Delivery Date</th>
                                            <th>Customer Name</th>
                                        <th>Customer Mobile</th>
                                        
                                       
                                      
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delivery Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <!-- <th>Product Name</th> -->
                                        <th>Vendor Name</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vendor Address&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Delivery Status</th>
                                        <th></th> 
                                                                       
                                        </tr>
                                    </thead>
                                    <tbody>   
                                    <form method="post" enctype="multipart/form-data">                               
                                   <?php 
                                  $q1="SELECT o.delivery_status,r.request_delivery_id,o.order_id,o.delivery_date,c.user_name AS customer,c.mobile,o.delivery_address,v.user_name AS vendor,v.addr AS vendor_address,r.is_accept FROM request_delivery r INNER JOIN `order` o ON r.order_id=o.order_id INNER JOIN user v ON r.vendor_id=v.user_id INNER JOIN user c ON c.user_id=o.customer_id WHERE r.is_accept LIKE 'accepted' AND r.delivery_person_id=(SELECT user_id FROM user WHERE user_name='$username') ";
                                  $s1=mysqli_query($conn,$q1);
                                   while($r1=mysqli_fetch_array($s1))
                                   { ?>
<tr align="center">
    <td ><?php echo $r1['request_delivery_id']; ?></td>
    <?php $rd_id=$r1['request_delivery_id']; ?>
    <td id="<?php echo $r1['order_id']; ?>" name="o"><?php echo $r1['order_id']; ?></td>
    <?php $o_id=$r1['order_id']; ?>
    <td ><?php echo $r1['delivery_date']; ?></td>
    <td style="text-transform:capitalize;"><?php echo $r1['customer']; ?></td>
    <td ><?php echo $r1['mobile']; ?></td>
    <td ><?php echo $r1['delivery_address']; ?></td>
    <td style="text-transform:capitalize;"><?php echo $r1['vendor']; ?></td>
    <td ><?php echo $r1['vendor_address']; ?></td>
    <td ><?php echo $r1['delivery_status']; ?></td>
  
    <!-- <td >
        
<select name="a_r" id="a_r">
    
    <option value="picked_up">picked_up</option>
    <option value="delivered">delivered</option>
    <option value="processing">processing</option>
    <option value="on_the_way">on_the_way</option>

    </select>
    
    <button class="btn btn-primary" name="submit">Submit item</button>

	

    </td> -->
   
    <!-- <form method="post"> -->
        <form>
        <?php 
        if($r1['delivery_status']=="delivered")
        { ?>
        <td></td>
<?php
        }
        else
        {
        ?>
    <td>
    <form method="post">
<select name="a_r" id="<?php echo $r1['order_id']; ?>" value="<?php echo $r1['a_r']; ?>" onchange="updatePrice(this)" >
    
    <option value="picked up">picked up</option>
    <option value="delivered">delivered</option>
    <option value="processing">processing</option>
    <option value="on the way">on the way</option>

    <!-- <script>
         $(document).ready(function() {
    $('#a_r').on('change', function() {
        //var ds = this.value;
        //ageddajax = $("#agedd").val();
       // window.print("hey");
        oid = $("#o").val();
        ds = $("#a_r").val();
        //var oid = $o_id.value;
        $.ajax({
            url: "change-status.php",
            type: "POST",
            data: {
               { ds:ds,oid:oid}
            },
            cache: false,
            success: function(result) {
                $("#diss").html(result);
            }
        });
    });
});
      </script> -->
    </form> 
    <div id="diss"class="alert alert-primary" role="alert" align="center">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='status_of_delivery.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>

                                   </td>
                                  
                                   <!-- <td><a href = 'status_of_delivery.php?action=delete&a_r=<?php echo $a_r; ?>&oid=<?php echo $o_id;  ?>' style="background-color:grey;" class="btn btn-primary" >update</a></td>
                                 -->
                                   <?php } ?>
 <!-- </form>  -->
                                   
  <!-- <td><a class="btn btn-primary" href="update_del.php" name="submit">UPDATE</a></td>

   -->
                                   </tr>
                                   <?php

                                   }

                                   ?>

  
</form>
<?php 
  
//   if(isset($_GET['action']) && $_GET['action']=="delete") 
//    {
    
//      $req_id=$_GET['req_id'];
//        $q5="UPDATE `order` SET delivery_status='$a_r' WHERE order_id=$req_id";
//        $s5=mysqli_query($conn,$q5);
//        if(!$s5)
//        {
//              echo mysqli_error($conn);
//        }
//        else
//        { ?>
<!-- //         <div class="alert alert-primary" role="alert" align="center"> RECORD ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='status_of_delivery.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
//     -->
 <?php  
//        }
//    }
   ?>  
   <?php 
//   if(isset($_GET['action']) && $_GET['action']=="delete")
//    {
//          $oid=$_GET['oid'];
//        $a_r=$_GET['a_r'];
    
//       // $req_id=$_POST['req_id'];
      
//        $q5="UPDATE `order` SET delivery_status='$a_r' WHERE order_id=$oid";
//                $s5=mysqli_query($conn,$q5);
//                echo $o_id;
//                var_dump($s5);
//                if(!$s5)
//                {
//                      echo mysqli_error($conn);
//                }
//               else
//                { ?>
<!-- //                 <div class="alert alert-primary" role="alert" align="center"> STATUS UPDATED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='status_of_delivery.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div> -->

            <?php  
//                }

//    }
   ?>
                                </table>
                               
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <!-- <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                 -->
                                </div>
                                <!--div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div-->
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