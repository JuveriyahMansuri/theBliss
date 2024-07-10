<?php 
session_start();
include 'con12.php';
$username=$_SESSION['username'];
$oi=$_GET['oi']; 
$appr=$_GET['appr'];
$q1="SELECT ebd.image,p.product_id,p.display_picture,p.name,ebd.quantity,ebd.eprice,p.price,ebd.customization_details FROM event_booking_detail AS ebd INNER JOIN product AS p ON p.product_id=ebd.product_id WHERE event_booking_id=$oi && p.vendor_id=(SELECT user_id FROM user WHERE user_name='$username')";    
  
$s1=mysqli_query($conn,$q1);

$eprice = 0;
$booking_id = $oi;

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
    <title>Event Details</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">

     <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

     <script>
        function updatePrice(id){
            pid = $(id).attr("id");
            eprice = $(id).val();
            console.log(pid);
            $.ajax({
                url:'update_price_event.php',
                method: 'POST',
                data:{
                    pid : pid,
                    eprice : eprice,
                    booking_id : <?php echo $booking_id; ?>
                },
                success:function(data){
                    console.log('success');
                }
            });
        }
        </script>


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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Event Details of  event id <?php echo $oi;?></h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    <?php 
                                    // if($_SERVER['REQUEST_METHOD'] == 'POST')
                                    // {
                                    //     $val=$_POST['approval'];
                                       
                                    //     $q2="UPDATE `event_booking_detail` SET approval='$val' WHERE event_booking_id=$oi";
                                    //     $s2=mysqli_query($conn,$q2);
                                    //     if(!$s2)
                                    //     {
                                    //         echo "ERROR ";
                                    //          echo mysqli_error($conn);
                                    //     }
                                    //     else
                                    //     {
                                    //         ?>
                                             <!-- <div class="alert alert-primary" role="alert" align="center"> RECORD ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" onClick="Javascript:window.location.href='event.php';" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                        -->
                                       <?php
                                    //            //header("location: \Login\VENDOR_$\view_product.php");
                                    //     }
                                    // }
                                    
                                    ?>
                                  </div>
                               
                                <!-- <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div> -->
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br>
                             
                                <table class="table dataTable my-0" id="dataTable" align="center">
                              
                                 <thead align="center">
                                <th> Product Image</th>
                                 <th>Product Name</th>
                                 <th>Quantity</th>
                                 <th> Customized </th>
                                 <th>Customization details</th>
                                 <th> Reference Image </th>
                                 <th>Price (₹)</th>
                                 <th> </th>
                                 <!-- <th>Discount Price</th> -->
                                 <!-- <th>After discount price</th> -->
                                 <!-- <th>Amount</th> -->

</thead>


                                 <?php 
                                
  
                                $bill=0;
                                
                                while($r1=mysqli_fetch_array($s1))
                                {
                                                                     ?>
                                     <tr align="center">
                                   

                                        <th align="center"><img class="rounded-circle mr-2" width="50" height="50" src="/Login/image/Project_images/<?php echo $r1['display_picture']; ?>"></th>
                                  
                                   
        
                                     <th  style= "text-transform:capitalize;"><?php 
                                     $pid=$r1['product_id'];
                                     echo $r1['name'];?></th>
                                     
                                     
                                     <th  required><?php echo $r1['quantity']; ?></th>
                                     <?php
                                        if($r1['customization_details'] != NULL)
                                        {?>
                                                <th> Product is Customizable </th>
                                        <?php
                                        }
                                                else{?>
                                                    <th> - </th>
                                              <?php  }             
                                                ?>
                                                <?php
                                        if($r1['customization_details'] == NULL)
                                        {?>
                                            <th> - </th>
                                       <?php }
                                       else{
                                           ?>
                                        <th> <?php echo $r1['customization_details']; ?></th>
                                       <?php
                                       }
                                    ?>



<?php
                                        if($r1['image'] == NULL)
                                        {?>
                                            <th> - </th>
                                       <?php }
                                       else{
                                           ?>
                                        <th align="center"><img class="rounded-circle mr-2" width="50" height="50" src="/Login/image/custom_order/<?php echo $r1['image']; ?>"></th>
                                       <?php
                                       }
                                    ?>





                                     
                                   <form method="post">
                                  <th> <input  name="eprice" id="<?php echo $r1['product_id']; ?>" value="<?php echo $r1['eprice']; ?>" onchange="updatePrice(this)"> </th>
                 
                                 
                                 
                                  
                                 
                                    
                                   
                                
                                    
                                    </tr>

                                     <break>

                                    <?php $bill=$bill+($r1['quantity']*$r1['eprice']);?>












                        <?php
                                } ?>



                            
                            <tr style="color:teal">
                           
                            <th> </th>
                                 <th> </th>
                                 <th> </th>
                                 <th> </th>
                                 <th> </th>
                               
                                     <th> <br> Total  : </th>
                                         <th><br> <?php echo "₹".$bill; ?></th>
                            </tr>
                            <tr>
                                     <?php
                                     if($appr == 'pending'){?>
                                                <th> <button type="submit" name="submit" onclick="myFunction()"> Accept </button></th>
                                                <th> <button type="submit" name="reject" onclick="myFunction()"> Reject </button></th>
                                     <?php
                                     }  
                                      ?>
                                     
                                     </tr>
                                     </form>
                                </thead>
                               
 <?php
                                        if(isset($_POST['submit']))
                                        {
                                            $sql = mysqli_query($conn,"UPDATE event_booking SET event_status = 'confirmed' WHERE event_booking_id = '$oi';");
                                            if($sql){?>
                                            <script>
                                                    alert("Request has been accepted");
                                                    window.location.href = "event.php";
                                                </script>
                                                <?php

                                            }

                                        }
                                        if(isset($_POST['reject'])){
                                            $sql = mysqli_query($conn,"UPDATE event_booking SET event_status = 'rejected' WHERE event_booking_id = '$oi';");
                                            if($sql){?>
                                                <script>
                                                        alert("Request has been rejected");
                                                        window.location.href = "event.php";
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