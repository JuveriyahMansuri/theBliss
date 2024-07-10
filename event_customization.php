<?php
include 'con12.php';
session_start();
if(!isset($_SESSION['username']))
{
    $username = "";
    $user = "";
}
else
{
    $username = $_SESSION['username'];
    $query = "SELECT user_id FROM User WHERE user_name = '$username';";
    $uid = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($uid);
    $user = $row['user_id'];
    //echo $username;
    $_SESSION['username'] = $username;
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
    <title>Customized Order</title>
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
                <li style="color: White;" >  <strong> <?php 
                if($username!=null)
                    echo ""; 
                else
                    echo ""?> </strong></li>
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
                        <ul><?php
                            if($username!=null){?>
                            <li><a href="order_history.php">Order History <img style=" border-radius: 50%;" width="25" height="25" src="image/history_icon.png" alt=""></a></li>
                            <li><a href="Profile.php"> My Account  <img style=" border-radius: 50%;" width="25" height="25" src="image/new_profile.jpg" alt=""> </a></li>
                            <li> <a href= "#"id = "logout" onclick = "fun()">Log Out <img width="20" height="20" src="images.png" alt=""></a> </li>
                            <script>
function fun() {
  if (confirm("Are You Sure You Want to Logout!")) {
    location.href="logout.php";

  } else {
    location.href="#";
  }
}
</script>
                        <?php
                        }
                        else {?>
                            <li><a href="login.php">Login</a></li>
                            <li> <a href= "Registration.php"id = "Registration" >Register</a> </li>
                <?php  }
                  ?>
                    
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
                        <?php  if($username != NULL){?>
                        <li class="side-menu"><a href="#"> 
						<i class="fa fa-shopping-bag"></i>
                        <span id="badge" class="badge"><?php  
                        $result = mysqli_query($con,"SELECT COUNT(*) FROM Cart WHERE user_id = '$user';");
                        $result = mysqli_fetch_assoc($result);
                        
                        echo implode($result);?>
                        </span>
					</a> <?php }?></li>
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


    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Customized Order</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="event_details.php">Event Details</a></li>
                        <li class="breadcrumb-item active">Customized Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

<?php
$pid = $_GET['$pid'];
$price = mysqli_query($con,"SELECT price FROM product WHERE product_id = '$pid';");
$price = mysqli_fetch_assoc($price);
$price = $price['price'];
$booking_id =  $_SESSION['booking_id'];
//echo $booking_id;
//echo $pid;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $detail = $_POST["detail"];
    $filename = $_FILES["cimage"]["name"];
    $pid;
    $booking_id;
    $qty = $_POST['qty'];


     $msg = "";
     $uploadOk = 1;
//     if (isset($_POST['submit'])) {

     // If upload button is clicked ...
     $filename = $_FILES["cimage"]["name"];
     $tempname = $_FILES["cimage"]["tmp_name"];    
     $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
     $folder = "image/custom_order/.$filename";
     
     // Allow certain file formats
     if ($filename == "")
     {
         echo "Please select a file";
     }
     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
     && $imageFileType != "gif" && $imageFileType != "pdf" ) 
     {
         echo "Only JPG, JPEG, PNG & GIF files are allowed.";
         $uploadOk = 0;
     }
          // Now let's move the uploaded image into the folder: image
         if (move_uploaded_file($tempname, $folder)) 
         {
             $msg = "Image uploaded successfully";
             echo $msg;
         }else{
             $msg = "Failed to upload image";
             echo $msg;
     }
// }

    
    $sql = "UPDATE event_booking_detail SET `customization_details` = '$detail' , `image` = '$filename' , `quantity` = '$qty' , `eprice` = '$price' WHERE `product_id` = '$pid' AND `event_booking_id` = '$booking_id';";
    $res = mysqli_query($con, $sql);
    if($res){?>
        <script>
            window.location.href = "event_details.php";
            </script>
  <?php  }
    var_dump($res);
    /*if($res){?>
       <br/> <center> <h1> <strong>  "Request has been sent Successfully " </strong> </h1> </center>
    <?php }*/
    
}   
?>




    <!--Customized Details-->
    <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>CUSTOMIZATION DETAILS</h2>
                        <p></p>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label_txt">Enter Your Customization Details :</label>
                                        <textarea class="form-control" id="detail" name="detail" placeholder="Enter Your Customization Details" rows="4" data-error="Please enter your customization detail" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                   
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label_txt">Enter Quantity :</label>
                                        <input type="number" min="1" max="10" placeholder="Enter Quantity" id="qty" class="form-control" name="qty" required data-error="Please enter quantity">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                   
                                
                                <!--upload image-->
                                <div class="form-group">
                                    <label class="label_txt"></label>
                                    Enter an image for reference : 
                                    <input type="file" name="cimage" id="cimage">   
                            </div> 
                                <!--end upload image-->
                                </br>
                                </div>
                            </div>
                           <center> <button style="color:White; font-weight:bold;" class="btn hvr-hover" id="submit" type="submit">Submit</button> </center> <br/> <br/> 
                            
                        </form>
                    </div>
                </div>
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