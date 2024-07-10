<?php
 include 'con12.php';
 session_start();
 $username = $_SESSION['username'];

 $query = "SELECT user_id FROM User WHERE user_name = '$username';";
 $uid = mysqli_query($con, $query);
 $row = mysqli_fetch_assoc($uid);
$user = $row['user_id'];
?>

<script>
   // function o_cancel(){
    
//}

    </script>


<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Order History</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
   <link rel="shortcut icon" href="Logo.jpg" type="image/x-icon">  <!-- add your logo it will be visible on title bar -->
   <link rel="apple-touch-icon" href="Logo.jpg">


   

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <li style="color: White;" >  <strong> <?php //echo $username; ?> </strong></li>
                  <!--  <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                    <?php
                                    //echo  "WELCOME ".$username;
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="our-link">
                        <ul>
                        <li><a href="order_history.php">Order History <img style=" border-radius: 50%;" width="25" height="25" src="image/history_icon.png" alt=""></a></li>
                            <li><a href="Profile.php"> My Account  <img style=" border-radius: 50%;" width="25" height="25" src="image/new_profile.jpg" alt=""> </a></li>
                            <li> <a href= "#"id = "logout" onclick = "fun()">Log Out <img width=20 height=20 src="images.png" alt=""></a> </li>
                            <script>
function fun() {
  if (confirm("Are You Sure You Want to Logout!")) {
    location.href="logout.php";

  } else {
    location.href="#";
  }
}
</script>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="index.php"> <img width=100 height=100 src="Logo.jpg" class="logo" alt=""></a> <!-- add ur logo -->
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="dropdown megamenu-fw">
                            <a class="nav-link" href="shop.php">Product</a>
                        </li>
                        <li class="dropdown">
                        <?php  if($username!=null){?>
                            <a href="cart.php" class="nav-link">Cart</a>
                            </li>
                             <?php } ?>
                        <li class="nav-item"><a class="nav-link" href="event.php">Products for Event</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="side-menu"><a href="#">
						<i class="fa fa-shopping-bag"></i>
                        <span id="badge" class="badge"><?php 
                        $result = mysqli_query($con,"SELECT COUNT(*) FROM Cart WHERE user_id = '$user';");
                        $result = mysqli_fetch_assoc($result);
                        
                        echo implode($result);?>
                        </span>
					</a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                <ul class="cart-list">
                    <?php 
                     /*$t = "SELECT SUM(price) FROM Product WHERE product_id IN (SELECT product_id FROM Cart WHERE user_id = $user);";
                    $total = mysqli_query($con,  $t);
                    $amt = mysqli_fetch_assoc($total);*/

                    $amt = 0;
                    
                    $sql = "SELECT * FROM Cart WHERE user_id = '$user';";
                    $res1 = mysqli_query($con, $sql);
                    if (mysqli_num_rows($res1) > 0) {             
                        while($rows = mysqli_fetch_assoc($res1))
                        {
                            $pid = $rows['product_id'];
                            $sql2 = "SELECT * FROM Product WHERE product_id = '$pid';";
                            $res2 = mysqli_query($con,$sql2);
                            while ($row2 = mysqli_fetch_array($res2)){
                                $amount = $row2['price'] * $rows['quantity'];
                                $amt = $amt + $amount;

                            
                    ?>
                        <li>
                            <a href="#" class="photo"><img src="image/Project_images/<?php echo $row2['display_picture']; ?>" class="cart-thumb" alt="Image" /></a>
                            <h6><a href="#"> <?php echo $row2['name']; ?>  </a></h6>
                            <p> <?php echo $rows['quantity']." - "; ?> <span class="price"><?php echo $row2['price']; ?></span></p>
                        </li>
                    <?php 
                            
                        }
                        
                    }
                    
                }
                    ?>
                     <li class="total">
                            <a href="cart.php" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: <?php echo "₹".$amt; ?></span>
                        </li>  
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->
   
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                           <center> <h1> Orders </h1> </center>
                            <thead>
                                <tr>
                                    <th> Order id </th>
                                    <th> Date </th>
                                    <th> Order Status </th>
                                    <th>Total</th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = "SELECT order_id,order_date,order_status,total_amount,delivery_date FROM `order` WHERE customer_id = '$user' ORDER BY order_date DESC;";
                                $res = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($res))
                                { //echo $row['delivery_date'];
                                ?>
                            <tr>
                            <td>
                                        <a href="#">
                                            <?php echo  $row['order_id']; ?>
								</a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <?php $ordate = $row['order_date'];  $odate = date("d-m-Y", strtotime($ordate)); echo $odate; ?>
								</a>
                                    </td> 
                                    <td style="text-transform: capitalize;">
                                    <a href="#">
                                            <?php echo  $row['order_status']; ?>
								</a>
                                    </td> 
                                    <td>
                                    <a href="#">
                                            <?php echo  "₹ ".$row['total_amount']; 
                                                $order_id = $row['order_id'];
                                                $_SESSION['order_id'] = $order_id;
                                            ?>
								</a>
                                    </td> 
                                    <td> <?php 
                                            if($row['order_status'] == 'cancelled'){?>
                                                </td>
                                           <?php }else{

                                    ?>
                                    <button style ="color:white; font-weight:bold;"  onclick = "Javascript:window.location.href = 'order_history_detail.php?$oid=<?php echo $row['order_id'];?>';" class="btn hvr-hover"   type="submit" name="submit" class="btn btn-primary"> View </button> 
                                </td>
                                <?php } ?>
                                <td>
                                    <?php
                                    $deliverydate = $row['delivery_date'];
                                    $deliverydate = date("Y-m-d", strtotime($deliverydate));
                                   // $deldate = date('Y-m-d', strtotime($deliverydate. ' + 3 days'));
                                    $now = date("Y-m-d");
                                    $now = date("Y-m-d", strtotime($now));
                                    //echo $now;
                                    //$diff = floor( ($now - $deliverydate)/60/60/24);
                                    //echo $diff;
                                    //echo $deldate;
                                       if($row['order_status'] == 'pending'){

                                    ?>
                                <button style ="color:white; font-weight:bold;" id="<?php echo $row['order_id'];?>"  onclick = "orderCancel(this.id)" class="btn hvr-hover"   type="submit" name="cancel" class="btn btn-primary"> Cancel </button>
                                <script>
                                    function orderCancel(oid) {
                                    if (confirm("Are You Sure You Want to Cancel the order!")) {
                                        let reason = prompt("Please enter valid reason:");
                                        if(reason == null || reason == ""){
                                            location.href="#";
                                        }
                                        else{
                                            console.log(reason);
                                            //o_cancel();
                                            $.ajax({
                                                url:'order_cancel.php',
                                                method: 'POST',
                                                data:{
                                                    oid:oid,
                                                    reason:reason
                                                },
                                                success:function(data){
                                                    console.log(data);
                                                    location.reload(true);
                                                }
                                            });
                                        }
                                    }
                                    else {
                                        location.href="#";
                                    }
                            }
                                </script>
                             
                             
                             <?php           
                                    }
                                    else if($row['order_status'] == 'delivered'  ) {?>
                                        <!-- <button style ="color:white; font-weight:bold;"  onclick = "Javascript:window.location.href = 'order_replace.php?$oid=<?php// echo $row['order_id'];?>';" class="btn hvr-hover"   type="submit" name="submit" class="btn btn-primary"> Replace </button> -->

                                  <?php  }
                                  else{

                                  }
                                        ?>    
                            </td>

                                 </tr>


                            <?php
                                }
                                ?>


                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Customized Orders --> 

<div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                           <center> <h1> Customized Orders </h1> </center>
                            <thead>
                                <tr>
                                    <th> Customized Order id </th>
                                    <th> Date </th>
                                    <th> Customized Order Status </th>
                                    <th>Total</th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                //echo  $user;
                                $corders = "SELECT customized_id,c_date,approval,amount FROM `customized_order` WHERE customer_id = '$user' ORDER BY c_date DESC;";
                                $res1 = mysqli_query($con,$corders);
                                while($row1 = mysqli_fetch_array($res1))
                                {
                                ?>
                            <tr>
                            <td>
                                        <a href="#">
                                            <?php echo  $row1['customized_id']; ?>
								</a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <?php $cordate = $row1['c_date'];  $codate = date("d-m-Y", strtotime($cordate)); echo $codate; ?>
								</a>
                                    </td> 
                                    <td style="text-transform: capitalize;">
                                    <a href="#">
                                            <?php echo  $row1['approval']; ?>
								</a>
                                    </td> 
                                    <td>
                                    <a href="#">
                                            <?php echo  "₹".$row1['amount']; ?>
								</a>
                                    </td> 
                                    <td>
                                        <?php  if($row1['approval'] == 'cancelled'){

                                        }
                                        else{

                                        
                                        ?>
                                    <button style ="color:white; font-weight:bold;" onclick = "Javascript:window.location.href = 'customized_order_detail.php?$coid=<?php echo $row1['customized_id'];?>';" class="btn hvr-hover"   type="submit" name="submit" class="btn btn-primary"> View </button> 
                                <?php
                                        }
                                        ?>
                                    
                                
                                
                                </td>
                                <td>
                                    <?php
                                        if($row1['approval'] == 'pending'){

                                    ?>
                                <button style ="color:white; font-weight:bold;" id="<?php echo $row1['customized_id'];?>"  onclick = "customizedCancel(this.id)"   class="btn hvr-hover"   type="submit" name="cancel" class="btn btn-primary"> Cancel </button>
                                <script>
                                    function customizedCancel(coid) {
                                        if (confirm("Are You Sure You Want to Cancel the order!")) {
                                        $.ajax({
                                            url:'customized_order_cancel.php',
                                            method: 'POST',
                                            data:{
                                                coid:coid
                                            },
                                            success:function(data){
                                                console.log(data);
                                                console.log('success');
                                                location.reload(true);
                                               
                                            }
                                        });
                                        } 
                                        else {
                                            location.href="#";
                                        }
                                    }
                                </script>
                             
                             
                             <?php           
                                //     }else if(($row1['approval'] == 'delivered')){?>
                                        <!-- <button style ="color:white; font-weight:bold;"  onclick = "Javascript:window.location.href = 'order_replace.php?$coid=<?php //echo $row1['customized_id'];?>';" class="btn hvr-hover"   type="submit" name="submit" class="btn btn-primary"> Replace </button>-->

                                   <?php  
                                  }else{

                                  }
                                        ?>    
                            </td>

                                 </tr>


                            <?php
                                }
                                ?>


                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>







<!-- Customized Orders -->




<!-- Event History --> 

<div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                           <center> <h1> Events </h1> </center>
                            <thead>
                                <tr>
                                    <th> Event booking id </th>
                                    <th> Date </th>
                                    <th> Event Status </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                //echo  $user;
                                $corders = "SELECT event_booking_id,event_booking_date,event_status FROM `event_booking` WHERE customer_id = '$user' ORDER BY event_booking_id DESC;";
                                $res1 = mysqli_query($con,$corders);
                                while($row1 = mysqli_fetch_array($res1))
                                {
                                ?>
                            <tr>
                            <td>
                                        <a href="#">
                                            <?php echo  $row1['event_booking_id']; ?>
								</a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <?php $event_b_date = $row1['event_booking_date'];  $event_b_date = date("d-m-Y", strtotime($event_b_date)); echo $event_b_date; ?>
								</a>
                                    </td> 
                                    <td style="text-transform: capitalize;">
                                    <a href="#">
                                            <?php echo  $row1['event_status']; ?>
								</a>
                                    </td>  
                                    <td>
                                        <?php  if($row1['event_status'] == 'cancelled'){

                                        }
                                        else{

                                        
                                        ?>
                                    <button style ="color:white; font-weight:bold;" onclick = "Javascript:window.location.href = 'event_history.php?$eid=<?php echo $row1['event_booking_id'];?>';" class="btn hvr-hover"   type="submit" name="submit" class="btn btn-primary"> View </button> 
                                <?php
                                        }
                                        ?>
                                    
                                
                                
                                </td>
                                <td>
                                    <?php
                                        if($row1['event_status'] == 'pending'){

                                    ?>
                                <button style ="color:white; font-weight:bold;" id="<?php echo $row1['customized_id'];?>"  onclick = "customizedCancel(this.id)"   class="btn hvr-hover"   type="submit" name="cancel" class="btn btn-primary"> Cancel </button>
                                <script>
                                    function customizedCancel(coid) {
                                        if (confirm("Are You Sure You Want to Cancel the order!")) {
                                        $.ajax({
                                            url:'customized_order_cancel.php',
                                            method: 'POST',
                                            data:{
                                                coid:coid
                                            },
                                            success:function(data){
                                                console.log(data);
                                                console.log('success');
                                                location.reload(true);
                                               
                                            }
                                        });
                                        } 
                                        else {
                                            location.href="#";
                                        }
                                    }
                                </script>
                             
                             
                             <?php           
                                //     }else if(($row1['approval'] == 'delivered')){?>
                                        <!-- <button style ="color:white; font-weight:bold;"  onclick = "Javascript:window.location.href = 'order_replace.php?$coid=<?php //echo $row1['customized_id'];?>';" class="btn hvr-hover"   type="submit" name="submit" class="btn btn-primary"> Replace </button>-->

                                   <?php  
                                  }else{

                                  }
                                        ?>    
                            </td>

                                 </tr>


                            <?php
                                }
                                ?>


                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>







<!-- Event History -->

 <!-- Start Footer  -->
 <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About The Bliss</h4>
                            <p> The Bliss is a platform for unregistered businesses  where they can expand their scope of business.
Here, customers can find vendors (i.e. home bakers,  Decorators, Snacks maker, handmade gift makers individually), buy the products or plan a small event/party.
</p>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="service.php">Customer Service</a></li>
                                <li><a href="#">Our Sitemap</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                            <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: Navrangpura,Ahmedabad </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: +91 7845961230 <a href=""></a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="">thebliss@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2021-22 The Bliss
            </p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    



    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js."></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>