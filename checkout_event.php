<?php
include 'con12.php';
session_start();
$username = $_SESSION['username'];
$query = "SELECT user_id FROM User WHERE user_name = '$username';";
$uid = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($uid);
$user = $row['user_id'];
//echo $username;
$_SESSION['username'] = $username;
$st = 0;
$discountprice = 0;
$gt = 0;


$booking_id =  $_SESSION['booking_id'];

if(isset($_POST['placeorder'])){
     $deliveryadd = $_POST["address"];
     $paymode = $_POST["payment"];
     $area = $_POST['area'];
    
    $sql3 = "UPDATE event_booking SET delivery_address = '$deliveryadd' , payment_mode = '$paymode' , area_pincode = '$area' WHERE event_booking_id = '$booking_id';";
    $res3 = mysqli_query($con , $sql3);
    if($res3){?>
    <script>
        alert("Request Placed successfully");
        window.location.href = "event_history.php?$eid=<?php echo $booking_id;?>";

        </script>
        
   <?php
    }
    
   
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Checkout Event</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="Logo.jpg" type="image/x-icon">
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
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <li>
                                  <!--  <i class="fab fa-opencart"></i>  -->
                                </li>
                            </ul>
                        </div>
                    </div>
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
                    <a class="navbar-brand" href="index.php"><img width=100 height=100 src="Logo.jpg" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="dropdown active megamenu-fw">
                         <!--   <a href="shop.php" class="nav-link" >Product</a> -->
                            <li class="nav-item"><a class="nav-link" href="shop.php">Product</a></li>
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
                    $query = "SELECT user_id FROM User WHERE user_name = '$username';";
                    $uid = mysqli_query($con, $query);
                    while($row = mysqli_fetch_assoc($uid)){
                        $user = $row['user_id'];
                    }
                    $t = "SELECT SUM(price) FROM Product WHERE product_id IN (SELECT product_id FROM Cart WHERE user_id = $user);";
                    $total = mysqli_query($con,  $t);
                    $amt = mysqli_fetch_assoc($total);
                    
                    
                    $sql = "SELECT * FROM Cart WHERE user_id = '$user';";
                    $res1 = mysqli_query($con, $sql);
                    if (mysqli_num_rows($res1) > 0) {             
                        while($rows = mysqli_fetch_assoc($res1))
                        {
                            $pid = $rows['product_id'];
                            $sql2 = "SELECT * FROM Product WHERE product_id = '$pid';";
                            $res2 = mysqli_query($con,$sql2);
                            while ($row2 = mysqli_fetch_array($res2)){

                            
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
                            <span class="float-right"><strong>Total</strong>: <?php echo "₹".implode($amt); ?></span>
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

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

 
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
 
        <form method="post">
        

            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                   <!--     <form class="needs-validation" novalidate>-->
                            <div class="row">
                                
                               
            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php $add = mysqli_query($con,"SELECT * FROM `User` WHERE `user_id` = '$user';"); $add=mysqli_fetch_array($add); $addr=$add['addr']; echo $addr; ?>" required> 
                                
                            </div>
                            
                            <div class="col-md-5 mb-3">
                                    <label for="area">Area *</label>
                                    <select class="wide w-100" id="area" name="area">
                                        <?php 
                                         $uarea = $add['area_pincode'];     
                                        $area = mysqli_query($con,"SELECT * FROM area WHERE pincode = '$uarea';");
                                        $area = mysqli_fetch_array($area);
                                        $area = $area['area_name'];
                                        //$pincode = $area['pincode'];
                                        //var_dump($area);
                                        //echo $area;
                                        ?>
									<option value="<?php echo $uarea; ?>" data-display="Select"><?php echo $area; ?></option>
									<?php
                    $result = mysqli_query($con,"SELECT * FROM Area");
                    while($row = mysqli_fetch_array($result)) {
                ?>
                                <option value="<?php echo $row['pincode'];?>"><?php echo $row["area_name"];?>
                                </option>
                                <?php
}
?>
								</select>
            </div>

                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Payment Mode</h3>
                                </div>
                                <div class="mb-4">
                                <input class="radio" type="radio" name="payment" value="Cash on Delivery" checked /> <span>Cash on Delivery</span>
                                <input class="radio" type="radio" name="payment" value="Online" /> <span>Online</span> 
                            </div>
            </div>
            
                            
                            
                            
                           
                            <hr class="mb-1"> 
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Products</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                <p style="color:red">*Prices can be changed as per the customization requirements.</p>
                                <?php
                                 $sql = "SELECT * FROM Product p , event_booking_detail eb WHERE p.product_id = eb.product_id AND event_booking_id='$booking_id';";
                                 $res = mysqli_query($con, $sql);
                                 while ($row1 = mysqli_fetch_array($res)){
                                     ?>
                                    <div class="media mb-2 border-bottom">

                                        <div class="media-body"> <a href="detail.html"> <?php echo $row1['name']; ?> </a>

                                        <?php
                                        $pid = $row1['product_id'];
                                        $disprice = $row1['price'];
                                        $sql = mysqli_query($con, "SELECT `offer/discount_id` FROM Product WHERE `product_id` = '$pid';");
                                        $row2 = mysqli_fetch_array($sql);
                                        $offerid = $row2['offer/discount_id'];

                                        if(($row2['offer/discount_id'])!=NULL)
                                        {
                                            $dis = mysqli_query($con,"SELECT `discount` FROM `offer/discount` WHERE `offer/discount_id` = '$offerid';");
                                            $discount = mysqli_fetch_assoc($dis);
                                            $per = $discount['discount'];
                                            //$disprice = $disprice - ($disprice * $per/100);                                       
                                            $dprice = $disprice * $per/100;
                                            $disprice = $disprice - $dprice;
                                            $discountprice = $discountprice + ($dprice * $row1['quantity']);
                                        
                                        }
        
                                     echo "₹";   echo $disprice;?>

                                            <div class="small text-muted">Price: ₹<?php echo $disprice * $row1['quantity']; ?> <span class="mx-2">|</span>Qty: <?php echo $row1['quantity']; ?><span class="mx-2">|</span> Subtotal: ₹<?php echo $disprice * $row1['quantity']; ?></div>
                                            <?php $st = $st + ($row1['price'] * $row1['quantity']);?>
                                        </div>
                                    </div>
                                
                        <?php }
                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                                 </div>
                                 </div>
                                 <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold"></div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold">₹  <?php echo $st; ?></div>
                                </div>
                                <div class="d-flex">
                                    <h4>Discount</h4>
                                    <div class="ml-auto font-weight-bold">₹ <?php echo $discountprice; ?></div>
                                </div>
                                
                                <hr class="my-1">
                               
                                <hr>
                                <?php $gt = $st - $discountprice; ?>
                                <div  class="d-flex gr-total" >
                                    <h5>Grand Total</h5>
                                    <div id="gt" name="gt" class="ml-auto h5" >₹  <?php echo $gt; ?> </div>
                                    <input type="hidden" name="gt" id="gt" value="<?php echo $gt; ?>">
                                </div>
                                <hr> </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"> <button type="submit" style ="color:white" class="ml-auto btn hvr-hover"  name="placeorder"> <b> Send event request  </b></button> </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
                                    </form>
    <!-- End Cart -->
    
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