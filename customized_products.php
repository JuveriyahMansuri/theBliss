<?php
include 'con12.php';
include 'popup.php';
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
    <title>Customized Products</title>
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

        function productCategory(cid){
            var city_id = $('#city :selected').val();
            var is_customized =1;
            console.log(city_id);
            $.ajax({
                url:'Product_category.php',
                method: 'POST',
                data:{
                    pc_id : cid,
                    city_id : city_id,
                    is_customized : is_customized                   
                },
                success:function(data){
                    $('#row').html(data);
                    $('#row1').html(data);
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
        //$(document).ready(function(){
        $(document).on('change' , '#city' ,function(){
            var city_id = this.value;
            var is_customized =1;
            console.log(city_id);
            $.ajax({
                url:"product-by-city.php",
                method: 'POST',
                data: {
                    city_id:city_id,
                    is_customized : is_customized
                },
                success:function(data){
                    $('#row').html(data);
                    $('#row1').html(data);
                    console.log("success");
                }
            });
            
        });
        </script>


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
                                    <i > </i> <?php //echo $username; ?>
                                </li>
                            </ul>
                        </div>
                    </div>-->
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
                    <a class="navbar-brand" href="index.php"> <img width=100 height=100 src="Logo.jpg" class="logo" alt=""></a>
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
                        <li class="nav-item"><a class="nav-link" href="customized_products.php">Customized Products</a></li>
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
						<i class="fa fa-shopping-bag" > </i>
                        <span id="badge" class="badge" onclick="viewcart()"><?php 
                        $result = mysqli_query($con,"SELECT COUNT(*) FROM Cart WHERE user_id = '$user';");
                        $result = mysqli_fetch_assoc($result);
                        
                        echo implode($result);?>
                        </span>
					</a> <?php } ?> </li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#"  class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list" id="view_cart">
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
                    <h2>Shop</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Customized Products</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="#">
                                <input class="form-control" placeholder="Search here..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>

                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <div class="list-group-collapse sub-men">
                                <?php
//include 'con12.php';
$sql = "SELECT * FROM Product_category WHERE sub_category_id IS NULL;";
$res = mysqli_query($con, $sql);
if (mysqli_num_rows($res) > 0) {
        
    $i=0;
    while($row = mysqli_fetch_assoc($res)){
        $id = "sub-menu".$i;
        $i = $i + 1;
?>
<a class="list-group-item list-group-item-action" data-toggle="collapse" href="#<?php echo $id ?>" aria-expanded="true" aria-controls="<?php echo $id ?>"> <?php echo $row['category_name'];?> 
</a>                                  
<div class="collapse show" id="<?php echo $id ?>" data-parent="#list-group-men">
    <div class="list-group">
            <?php
            //include 'con12.php';
            $cid = $row['product_category_id'];
            $sql1 = "SELECT * FROM Product_category WHERE sub_category_id = '$cid';";
            $sub_res = mysqli_query($con, $sql1); 
            if (mysqli_num_rows($sub_res) > 0) {             
                while($row1 = mysqli_fetch_assoc($sub_res))
                { //echo $row1['product_category_id'];
            ?>
                        <a  id="<?php echo $row1['product_category_id'];?>" class="list-group-item list-group-item-action active" href="#" onclick="productCategory(this.id)"><?php echo $row1['category_name'];?>   </a>
            <?php
                }
                                               
             }
    ?>
        </div>
    </div>
    <?php 
    }
}
?>
</div>
</div>

                        </div>
                      <!--  <div class="filter-price-left">
                            <div class="title-left">
                                <h3>Price</h3>
                            </div>
                            <div class="price-box-slider">
                                <div id="slider-range"></div>
                                <p>
                                    <input type="text" id="amount" readonly style="border:0; color:#fbb714; font-weight:bold;">
                                    <button class="btn hvr-hover" type="submit">Filter</button>
                                </p>
                            </div>
                        </div>-->
                       


                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                <div class="toolbar-sorter-right">
                                <span>Sort by city</span>   
                                <select id="city" name="city" class="selectpicker show-tick form-control"> 
                                        <?php 
                                        $city = mysqli_query($con, "SELECT * FROM city;");
                                        while($cityname = mysqli_fetch_assoc($city)){
                                        ?>
									  <option value="<?php echo $cityname['city_id']; ?>"> <?php echo $cityname['city_name']; ?>   </option>
                                    <?php
                                }
                                        ?>
								</select>


                                </div>  
                                
                              <!--  <p>Showing all 4 results</p>-->
                            </div>
                           
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row" id="row">
                                        <?php 
                                            //include 'con12.php';
                                            $query = "SELECT * FROM Product WHERE `p_status` = '1' AND `is_customized` = '1';";
                                            $result = mysqli_query($con, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result)) {?>
                                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                        <div class="products-single fix">
                                                            <div class="box-img-hover">
                                                                <div class="type-lb">
                                                                 <!--   <p class="sale">Sale</p>-->
                                                                </div>  
                                                               <img src="image/Project_images/<?php echo $row['display_picture']; ?>" class="img-fluid" alt="Image" height = "200px" width = "200px">
                                                                <div class="mask-icon">
                                                                    <ul>
                                                                        <li> <a href="customized_product_detail.php?$pname=<?php echo $row['name'];?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                    </ul>
                                                                    <?php 
                                                                    if($username==null){ ?>
                                                                        <a class="cart" id="<?php echo $row['product_id'];?>" href="#" onclick="showModal()">Add to Cart</a>
                                                                    <?php
                                                                    }
                                                                    else{ ?>
                                                                        <a class="cart" id="<?php echo $row['product_id'];?>" href="#" onclick="addProduct(this.id)">Add to Cart</a>
                                                                    <?php
                                                                    }
                                                                    ?> 
                                                                  
                                                                </div>
                                                            </div>
                                                            <div class="why-text">
                                                                <h4> <?php echo $row['name']; ?></h4>
                                                                <h5> <?php echo "₹".$row['price']; ?></h5>
                                                            </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                            }
                                        ?>

                                    </div>
                                </div>




                                <div role="tabpanel" class="tab-pane fade" id="list-view">
                                    <div class="list-view-box">
                                        <div class="row" id="row1">
                                        <?php 
                                        //$usercity = mysqli_query($con, "SELECT city_id FROM area WHERE pincode IN(SELECT area_pincode FROM user WHERE user_id = '$user');");
                                        //$usercity = mysqli_fetch_assoc($usercity);
                                        //$city = $usercity['city_id'];
                                            //include 'con12.php';
                                            $query = "SELECT * FROM Product WHERE `p_status` = '1' AND `is_customized` = '1';";
                                            //$query = "SELECT * FROM `product` WHERE vendor_id IN (SELECT user_id FROM user WHERE area_pincode IN (SELECT pincode FROM area WHERE city_id = '$city'));";
                                           /* $query = "SELECT Product.*, Product_image.image
                                            FROM Product
                                            LEFT JOIN Product_image
                                            ON Product.product_id = Product_image.product_id;";*/
                                            $result = mysqli_query($con, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result)) {?>

                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                         <!--   <p class="new">New</p> -->
                                                        </div>
                                                        <img src="image/Project_images/<?php echo $row['display_picture']; ?>" class="img-fluid" alt="Image" height = "200px" width = "200px">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li> <a href="customized_product_detail.php?$pname=<?php echo $row['name'];?>"  data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4><?php echo $row['name']; ?></h4>
                                                    <h5> <!-- <del>$ 60.00</del> --> <?php echo "₹".$row['price']; ?></h5>
                                                    <p> <?php  echo "\n".$row['value'];  echo $row['unit_of_measurement'];  ?></p>
                                                   <a class="btn hvr-hover"  id="<?php echo $row['product_id'];?>" href="#" onclick="addProduct(this.id)">Add to Cart</a>
                                                   
                                                </div>
                                            </div>
                                        <?php
                                                }
                                            }
                                            ?>
                                            </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->



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
   
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js."></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->



  <!--<script>
    function getProduct($category_id){
        console.log($category_id);
        jQuery.ajax({
            url: "Product_category.php",
            data:"product_category_id="+$category_id,
            type: "POST"
            success:function(data){
                $("#row").html(data);
            },
            error:function (){}
        });
    });
    </script> -->

    
</body>
</html>