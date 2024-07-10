<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'con12.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $address = $_POST["addr"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $usertype = $_POST['user_type'];
    $mobile = $_POST['mobile'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $area = $_POST['area'];
    $sques = $_POST['Security_ques'];
    $sans = $_POST['Security_ans'];
    $exists=false;
    $sql3="SELECT * from User where `user_name` = '$username' or `email_address` = '$email';";
    $res=mysqli_query($con, $sql3);

      if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        if($email == ($row['email_address']))
        {
            	echo "Email already exists";
        }
		if($username == ($row['user_name']))
		{
			echo "\n Username  already exists";
		}
	}
else{
            if($usertype == 2 or $usertype == 3)
            {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION["email"] = $email ;
                $_SESSION["addr"] = $address;
                $_SESSION["password"] = $password;
                $_SESSION["cpassword"] = $cpassword;
                $_SESSION['user_type'] = $usertype;
                $_SESSION['mobile'] =  $mobile;
                $_SESSION['state'] = $state;
                $_SESSION['city'] = $city;
                $_SESSION['area'] = $area;
                $_SESSION['Security_ques'] = $sques;
                $_SESSION['Security_ans'] = $sans;
                 header("location: membership.php");
            }
            else{

                        if(($password == $cpassword) && $exists==false){
                        $sql = "INSERT INTO `User` ( `user_name`,`email_address`,`addr`,`user_type_id`,`area_pincode`,`mobile`) VALUES ('$username','$email','$address','$usertype','$area','$mobile')";
                        $result = mysqli_query($con, $sql);
                        if ($result){
                        $showAlert = true;
                        $sql2 = "SELECT `user_id` FROM `User` WHERE `user_name` = '$username'";
                        $result = mysqli_query($con, $sql2);
                        $uid = mysqli_fetch_assoc($result);
                        $uid = (int)$uid['user_id'];
                        //var_dump ($uid);
                        $sql1 = "INSERT INTO `Login` (`username`, `password`, `security_question`, `security_answer`, `user_id`) VALUES ('$username','$password','$sques','$sans','$uid')";
                        $execute = mysqli_query($con, $sql1);
                        //echo "Record added succesfully";
                        }
                    }
             
                        else{
                                 $showError = "Passwords do not match";
                             }
               }
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
    <title>The Bliss - Registration</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
<div style="text-align:center"> <img width=200 height=200 src="Logo.jpg" class="logo" alt=""></a> <!-- add ur logo --> </div>
<?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>

<style>
  .required:after {
    content:" *";
    color: red;
  }
</style>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  color : black;
  font-weight : bold;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>



<div class="container my-4">
     <h1 class="text-center" style="font-weight:bold;">Sign up </h1> <br/>
     <form method="post">
         <table>
             <thead>
                 
</thead>
<tbody>
             <tr>
        <div class="form-group">
     <td>       <label for="username" class="required">Username</label> </td>
      <td>      <input type="text" pattern="[A-Za-z\s]*" class="form-control" id="username" placeholder="Enter Your Name" name="username" aria-describedby="emailHelp" maxlength="25" required> </td>
</tr>
 
        </div>
        <?php 
        include 'con12.php';
        $query = mysqli_query($con,"SELECT * FROM User_type");
        $rowcount=mysqli_num_rows($query);
        ?>
        <tr>
        <div class="form-group">
          <td>  <label for="form-group" class="required">User Type</label> </td>
         <td>   <select class="form-control" id="user_type" name='user_type' required>
                <option value="">Please Select Option</option>
                <?php 
        include 'con12.php';
        $query = mysqli_query($con,"SELECT * FROM User_type");
        $rowcount=mysqli_num_rows($query);
        ?>
                <?php
                for($i=1;$i<=$rowcount;$i++)
                {
                    $row=mysqli_fetch_array($query);
                
                ?>
                
                <option value="<?php echo $row["user_type_id"]?>"><?php echo $row["user_type"]?>
                    </option>
                    <?php
               }
               ?>
            </select> </td>
        </div>
            </tr>
            <tr>
        <div class="form-group">
        <td>    <label for="address" class="required">Address</label> </td>
        <td>   <!-- <input type="address" class="form-control" id="addr" placeholder="Address" name="addr" required >-->
         <textarea class="form-control" id="addr" placeholder="Address" name="addr" required>  </textarea> </td>
        </div>
            </tr>

            <tr>
        <div class="form-group">
     <td>       <label for="state" class="required">State</label> </td>
        <td>    <select class="form-control" name="state" id="state"  required>
                <option value="">Please Select Option</option>
                <?php
                    include "con12.php";
                    $result = mysqli_query($con,"SELECT * FROM State");
                    while($row = mysqli_fetch_array($result)) {
                ?>
                                <option value="<?php echo $row['state_id'];?>"><?php echo $row["state_name"];?>
                                </option>
                                <?php
}
?>
       
            </select> </td>
        </div>
</tr>

<tr>     
        <div class="form-group">
                        <td>    <label for="city" class="required">City</label> </td>
                        <td>    <select class="form-control" name="city" id="city" required>
                                <option value=""> </option>
                            </select> </td>
                        </div>
</tr>

<tr>
                        <div class="form-group">
                        <td>    <label for="area" class="required">Area</label> </td>
                        <td>    <select class="form-control" name="area" id="area" required>
                                <option value=""> </option>
                            </select> </td>
                        </div>   

                        <script>
    $(document).ready(function() {
        $('#state').on('change', function() {
            var state_id = this.value;
            $.ajax({
                url: "city-by-state.php",
                type: "POST",
                data: {
                    state_id: state_id
                },
                cache: false,
                success: function(result) {
                    $("#city").html(result);
                    $('#area').html(
                    '<option value="">Select City First</option>');
                }
            });
        });
        $('#city').on('change', function() {
            var city_id = this.value;
            $.ajax({
                url: "area-by-city.php",
                type: "POST",
                data: {
                    city_id: city_id
                },
                cache: false,
                success: function(result) {
                    $("#area").html(result);
                }
            });
        });
    });
    </script>  
    </tr> 
    
    <tr>
        <div class="form-group">
        <td>    <label for="email" class="required">E-mail</label> </td>
        <td>    <input type="email" class="form-control" id="email" placeholder="E-mail" name="email"  required> </td>
        </div>
</tr>

<tr>
        <div class="form-group">
        <td>    <label for="mobile" class="required">Enter Your Mobile No.:</label> </td>
        <td>    <input type="tel" class="form-control" id="mobile" placeholder="Mobile No." name="mobile" pattern="[7-9]{1}[0-9]{9}" maxlength="10" required> </td>
        </div>
</tr>

<tr>
        <div class="form-group">
        <td>    <label for="password" class="required">Password</label> </td>
          <!--  <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>-->
        <td>    <input type="password" class="form-control" id="password" placeholder="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required> </td>
        </div>
</tr>

<tr>
        <div class="form-group">
        <td>    <label for="cpassword" class="required">Confirm Password</label> </td>
        <td>    <input type="password" class="form-control" id="cpassword" placeholder="confirm password" name="cpassword" onfocusout="matchPassword()"  required>
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
            <input type="checkbox" onclick="myFunction()">Show Password  </td>

            <script>
            function myFunction() {
  var x = document.getElementById("cpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}



  
function matchPassword() {  
  var pw1 = document.getElementById("password");  
  var pw2 = document.getElementById("cpassword");  
  if(pw1 != pw2)  
  {   
    alert("Passwords did not match");  
  } else {  
    alert("Password created successfully");  
  }  
}  
  
</script>
        </div>
</tr>

<tr>
        <div class="form-group">
        <td>    <label for="Security_ques" class="required">Enter Security Question  </label> </td>
        <td>    <input type="text" class="form-control" id="Security_ques" placeholder="Enter Security Question" name="Security_ques" aria-describedby="emailHelp"  required> </td>
            
        </div>
</tr>

<tr>
        <div class="form-group">
        <td>    <label for="Security_ans" class="required">Enter Security Answer  </label> </td>
        <td>    <input type="text" class="form-control" id="Security_ans" placeholder="Enter Security Answer" name="Security_ans" aria-describedby="emailHelp"  required> </td>
            
        </div>
</tr>
         <br/>
</tbody>
</table>
<br/> <br/>
        <button style="font-weight : bold; color : white;" class="btn hvr-hover" type="submit" class="btn btn-primary">SignUp</button>
        <br/> <br/>
        <p style="font-weight : bold;  font-size: Large;">Already have an account? <a href="login.php">Login</a> </p>
     </form>
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
    
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->
</body>
</html>
