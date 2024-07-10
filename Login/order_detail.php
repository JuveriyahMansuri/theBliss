<?php
include 'con12.php';
session_start();
$username = $_SESSION['username'];
$query = "SELECT user_id FROM User WHERE user_name = '$username';";
$uid = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($uid);
$user = $row['user_id'];
$st = 0;
$price = 0;
$gt = 0;
$discountprice=0;

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
    <title>Order Detail</title>
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
                <li style="color: White;" >  <strong> <?php //echo "Welcome ".$username; ?> </strong></li>
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

<!--<div style="text-align:center"> <img width=200 height=200 src="Logo.jpg" class="logo" alt=""></a> add ur logo  </div> -->
<!--<div style="background: #d33b33; color: #ffffff;"> <b> customer_id : </b></div>-->
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
            </div>
        </div>
    </div>
</div>
  <!-- End Side Menu -->
  </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

<center> <h1> Your order has been placed successfully </h1> </center>

<div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price(₹)</th>
                                    <th>Quantity</th>
                                    <th>Total(₹)</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             $orid = $_SESSION['order_id'];
                             //echo $orid;
                               
                              
//$sql = "SELECT `product_id`,`discount_price`,`quantity` FROM order_detail WHERE `order_id` IN (SELECT `order_id` FROM `order` WHERE `customer_id` = '$user');";
$sql = "SELECT `product_id`,`discount_price`,`quantity` FROM order_detail WHERE `order_id` = '$orid';";
$result = mysqli_query($con, $sql);
//$oid = mysqli_fetch_assoc($result);
while($row = mysqli_fetch_assoc($result)){
$pid = $row['product_id'];
//echo $pid;
$discount = $row['discount_price'];
$qty =$row['quantity'];


                                 $sql1 = "SELECT * FROM Product WHERE product_id = '$pid' ;";
                                 $res = mysqli_query($con, $sql1);
                                 while ($row1 = mysqli_fetch_assoc($res)){
                                     ?>
                                     <tr>
                                     <td class="name-pr">
                                        <a href="#">
                                            <?php echo $row1['name']; ?>
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p> <?php  echo $price= $row1['price'] - $discount; $discountprice = $discount + $discountprice;?> </p>
                                 </td>
                                 <td>  <p > <?php echo $qty; ?> </p> </td>
                                 <td class="total-pr"> <?php echo $price * $qty;  $st = $st + ($row1['price'] * $qty ); ?> </td>

                                    
                                 </tr>
<?php }
}
?>
        </tbody>
</table>
                       
                </div>
            </div>
        </div>


<div class="row my-5">
                <div class="col-lg-8 col-sm-12"> 

                <?php
                //$orid = mysqli_query($con, "SELECT * FROM `order` WHERE customer_id = '$user';"); 
                //$orid = mysqli_fetch_assoc($orid); 
                //$oid=$orid['order_id']; 
                //echo $oid;
                //$odate =$orid['order_date']; 
                //$odate= date("d-m-Y", strtotime($odate));
                //$odate = mysqli_query($con,"SELECT NOW();");
                //$odate = mysqli_fetch_array($odate);
                //echo implode($odate);


                ?>
                  
                    <strong> <!--<div class="media-body rounded p-2 bg-light"> <a href="#"> Total bill :  <?php  //$gt = $st - $discountprice; echo "₹",$gt; ?></a> </div> -->
                    <div class="media-body rounded p-2 bg-light"> <a href="#"> Order id :  <?php //$orid = mysqli_query($con, "SELECT order_id FROM `order` WHERE customer_id = '$user';"); 
                   // $orid = mysqli_fetch_assoc($orid); $oid=$orid['order_id']; 
                    echo $orid; ?></a> </div> 
                     <div class="media-body rounded p-2 bg-light"> <a href="#"> Customer name :  <?php echo $username; ?> 
                    </a> </div> 
                    <div class="media-body rounded p-2 bg-light"> <a href="#"> Delivery address :  <?php $d_address = mysqli_query($con,"SELECT * FROM `order` WHERE order_id = '$orid';"); 
                    $d_address = mysqli_fetch_array($d_address); $add=$d_address['delivery_address']; $pay = $d_address['payment_mode'];  $d_date = $d_address['delivery_date']; echo $add;?>
                    </a> </div> 
                    <div class="media-body rounded p-2 bg-light"> <a href="#"> Payment mode :  <?php echo $pay; ?> 
                    </a> </div> 
                   <div class="media-body rounded p-2 bg-light" > <a href="#"> Your Order will be delivered within a day or two.
                    </a> </div>

                    </strong>  
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> <?php echo "₹ ".$st; ?> </div>
                        </div>
                        <div class="d-flex">
                            <h4>Discount</h4>
                            <div class="ml-auto font-weight-bold"> <?php echo "₹".$discountprice; ?></div>
                        </div>
                        <hr>
                        <?php $gt = $st - $discountprice; ?>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> <?php echo "₹".$gt; ?> </div>
                        </div>
                        <hr> </div>
                </div>
        </div>
    </div>
</div>




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
        <p class="footer-company">All Rights Reserved. &copy; 2021-22 <a href="#">The Bliss</a>
            </p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

</body>
</html>