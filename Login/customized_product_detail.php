<?php
include 'con12.php';
include 'popup.php';
session_start();
if(!isset($_SESSION['username']))
{
    $username = "";
    $user = "";
    $discount = "";
}
else
{
    $username = $_SESSION['username'];
    //echo $username;
    $query = "SELECT user_id FROM User WHERE user_name = '$username';";
    $uid = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($uid);
    $user = $row['user_id'];
    //echo $username;
    $_SESSION['username'] = $username;
    $discount = 0;
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
    <title> Customized-Product-detail</title>
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
    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>


    <script>
        function addProduct(id){
            $.ajax({
                url:'add_to_cart.php',
                method: 'POST',
                data:{
                    pid : id,
                    username : "<?php echo $username?>"
                },
                success:function(data){
                    $('#badge').html(data);
                    console.log("success");
                }
            });
        }

        function viewcart(){
            $.ajax({
                url:'view_cart.php',
                method: 'POST',
                data:{
                    //user_id : userid
                   // console.log('pc_id');
                },
                success:function(data){
                    $('#view_cart').html(data);
                    console.log("success");

                }
            });
        }
</script>


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
                                  <!--  <i class="fab fa-opencart"></i> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="our-link">
                        <ul>
                        <?php
                            if($username!=null){?>
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
                    <a class="navbar-brand" href="index.php"><img width=100 height=100 src="Logo.jpg" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="dropdown megamenu-fw">
                          <!--  <a href="shop.php" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">Product</a> -->
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
                        <?php  if($username != NULL){?>
                        <li class="side-menu"><a href="#">
                        <i class="fa fa-shopping-bag"></i>
                        <span id="badge" class="badge" onclick="viewcart()"><?php 
                        $result = mysqli_query($con,"SELECT COUNT(*) FROM Cart WHERE user_id = '$user';");
                        $result = mysqli_fetch_assoc($result);
                        
                        echo implode($result);?>
                        </span>
					</a> <?php }?> </li>
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
                    <h2>Shop Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                        <li class="breadcrumb-item active">Shop Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php
                            include 'con12.php';
                            $name = $_GET['$pname'];
                            //echo $name;
                            $sql = "SELECT * FROM `Product_image` WHERE `product_id` = (SELECT product_id FROM product WHERE `name` = '$name');";
                            $res = mysqli_query($con, $sql);
                            if (mysqli_num_rows($res) > 0) {
                                $row_id = 0;
                                while($row = mysqli_fetch_array($res)) {
                                    if($row_id == 0){?>
                                        <div class="carousel-item active"> <img class="d-block w-100" src="image/Project_images/<?php echo $row['image']; ?>" alt="First slide" height='400px' width='200px'> </div>
                                        <?php $row_id = $row_id + 1;
                                        }
                                    else{?> 
                                        <div class="carousel-item"> <img class="d-block w-100" src="image/Project_images/<?php echo $row['image']; ?>" alt="Second slide" height='400px' width='200px'> </div>
                                    <?php
                                    }
                                }
                            }?>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>
                        <ol class="carousel-indicators">
                        <?php
                            include 'con12.php';
                            $name = $_GET['$pname'];
                            //echo $name;
                            $sql = "SELECT * FROM `Product_image` WHERE `product_id` = (SELECT product_id FROM product WHERE `name` = '$name');";
                            $res = mysqli_query($con, $sql);
                            if (mysqli_num_rows($res) > 0) {
                                $row_id = 0;
                                while($row = mysqli_fetch_array($res)) {
                                    if($row_id == 0){?>
                                        <li data-target="#carousel-example-1" data-slide-to="$row_id" class="active">
                                            <img class="d-block w-100 img-fluid" src="image/Project_images/<?php echo $row['image']; ?>" alt="" />
                                        </li>
                                    <?php
                                    }
                                    else{?>
                                        <li data-target="#carousel-example-1" data-slide-to="$row_id">
                                            <img class="d-block w-100 img-fluid" src="image/Project_images/<?php echo $row['image']; ?>" alt="" />
                                        </li>
                                    
                                    <?php
                                     }
                                     $row_id = $row_id + 1;
                                }
                            }?>
                        </ol>
                    </div>
                </div>






                <div class="col-xl-7 col-lg-7 col-md-6">
                     <?php 
                            $UM = "";
                            $price = "";
                            include 'con12.php';
                            $name = $_GET['$pname'];
                            $res1 = mysqli_query($con, "SELECT * FROM product WHERE `name` = '$name';");
                            $res1 = mysqli_fetch_assoc($res1);
                            $pid = $res1['product_id'];
                            $sql = mysqli_query($con, "SELECT `offer/discount_id` FROM Product WHERE `product_id` = '$pid';");
                            $row2 = mysqli_fetch_array($sql);
                            $offerid = $row2['offer/discount_id'];
                            if(($row2['offer/discount_id'])!=NULL)
                            {
                                $dis = mysqli_query($con,"SELECT `discount` FROM `offer/discount` WHERE `offer/discount_id` = '$offerid';");
                                $discount = mysqli_fetch_assoc($dis);
                                $discount = $discount['discount'];
                            }
                            $sql1 = "SELECT * FROM product WHERE `name` = '$name';";
                            $res1 = mysqli_query($con, $sql1);
                            if (mysqli_num_rows($res1) > 0) {
                                while($row1 = mysqli_fetch_array($res1)) { 
                                    $pid = $row1['product_id'];
                                    ?>

                    <div class="single-product-details">
                        <h2> <?php echo $row1['name']; ?> </h2>
                        <?php
                        if($discount != 0)
                                {?>
                                    <h5> Price : <del> <?php echo $row1['price']."rs";?> </del> &nbsp <?php $price = ($row1['price'] * $discount)/100; echo $row1['price'] - $price."rs"; ?> </h5>
                                    <h5> <?php echo "Offer : ".$discount."% off"; ?> </h5>
                            <?php 
                                }
                                else{?>
                                    <h5> <!-- <del>$ 60.00</del> --> <?php echo "Price: ".$row1['price']."rs";  ?> </h5>
                              <?php  }

                                ?>
                       <!-- <p class="available-stock"><span> More than 20 available / <a href="#">8 sold </a></span> -->
                            <p> 
                                <h4>Description:</h4>
                                <p> <?php echo $row1['description'] ?> </p>
                                        <div>
                                            <p> Quantity : <?php echo $row1['value']." ".$row1['unit_of_measurement']; ?>  </p>
                                            <?php $UM = $row1['unit_of_measurement'];
                                                  $price = $row1['price'];
                                            ?>
                                        </div>
                                   

                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                       <!-- <a class="btn hvr-hover" data-fancybox-close="" href="cart.php?$pname=<?php //echo $row1['name'];?>">Add to cart</a>-->

                                       
                                    <!--    <a class="btn hvr-hover" data-fancybox-close="" id="<?php //echo $row1['product_id'];?>" href="#" onclick="addProduct(this.id)">Add to Cart</a>-->
                                    </div>
                                </div>
<?php 
                            }
                        }    
?>
                                
                    </div>
           
               
    <!-- End Cart -->

<!-- Place Customized Order -->

    <!--Customized Details-->
    <?php

//echo $pid;
$cdate =  mysqli_query($con,"SELECT NOW();");
$cdate = mysqli_fetch_assoc($cdate);
$cdate=implode($cdate);
//echo $cdate;
//echo $user;
if(isset($_POST['c_order']))
{
    $user;
    $detail = $_POST["detail"];
    $qty = $_POST["qty"];
    $measurement = $_POST["measurement"];
    $filename = $_FILES["cimage"]["name"];
    $value = $_POST['value'];
    $pid;
    $cdate;
    $user;
    $price;

//File Upload Control
            $msg = "";
            $uploadOk = 1;
           // if (isset($_POST['upload'])) {

            // If upload button is clicked ...
            $filename = $_FILES["cimage"]["name"];
            $tempname = $_FILES["cimage"]["tmp_name"];    
            $folder = "image/custom_order/".$filename;
            $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));
            echo $folder;
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
        //}
//File Upload Control

    
    $sql = "INSERT INTO `customized_order` (`customized_details`,`quantity`,`value`,`unit_of_measurement`,`image`,`product_id`,`customer_id`,`c_date`,`amount`) VALUES ('$detail','$qty','$value','$measurement','$filename','$pid','$user','$cdate','$price');";
    $res = mysqli_query($con, $sql);
    var_dump($res);
    if($res){
    //    $cid = mysqli_query($con,"SELECT customized_id FROM `customized_order` WHERE `c_date` = '$c_date';"); 
    //    $customized_id = mysqli_fetch_assoc($cid);
    //    $customized_id = $customized_id['customized_id'];
        ?>
    
    <script>
    {
    alert("Request for customized order has been sent Successfully.");
    window.location.href = "order_history.php";
    }
</script>
        <br/> <!--<center> <h1> <strong>  "Request has been sent Successfully " </strong> </h1> </center> -->
    <?php }
    
}   
?>


    <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>ENTER YOUR CUSTOMIZATION DETAILS</h2>
                        <p></p>

                        <p style="color:red">*Price can be change as per the customization requirements.</p>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label_txt">Customization Details :</label>
                                        <textarea class="form-control" id="detail" name="detail" placeholder="Enter Your Customization Details" rows="4" data-error="Please enter your customization detail" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                   
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label_txt">Enter Quantity :(No. Of Pieces)</label>
                                        <input type="number" min="1" max="10" placeholder="Enter Quantity" id="qty" class="form-control" name="qty" required data-error="Please enter quantity">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label_txt"> Enter Value :  </label> 
                                        <input type="number" min="1" max="10" placeholder="Enter Value" id="value" class="form-control" name="value" required data-error="Please enter value">
                                       <br/>
                                       <label class="label_txt"> Unit of measurement :  </label> 
                                        <input id="measurement" class="form-control" name="measurement" value="<?php echo $UM; ?>" readonly>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                   
                                </div>


                                <!--upload image-->
                                <div class="form-group">
                                    <label class="label_txt"></label>
                                    Enter an image for reference : 
                                    <input type="file" name="cimage" id="cimage">  <br/> <br/>
                            </div> 
                            
                                <!--end upload image-->
                                </br>
                                </div>
                            </div>
                            <?php 
                            if ($username ==null AND $username =='root'){
                            ?>
                             <center> <button style="color:White; font-weight:bold;" onclick="showModal()" class="btn hvr-hover" id="c_order" type="submit">Send Order Request</button> </center> <br/> <br/> 
                           
                            <?php }
                            else{?>
                                    <center> <button style="color:White; font-weight:bold;" class="btn hvr-hover" name="c_order" id="c_order" type="submit">Send Order Request</button> </center> <br/> <br/> 
                          <?php  } ?>
                        </form>
                    </div>
                </div>
            </div>
    
        </div>    
    </div>
</div>
</div>
</div> 

<!-- Place Customized Order -->


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