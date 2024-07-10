<?php
include 'con12.php';
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION["email"];
    $address = $_SESSION["addr"];
    $password = $_SESSION["password"];
    $cpassword = $_SESSION["cpassword"];
    $usertype = $_SESSION['user_type'];
    $mobile = $_SESSION['mobile'];
    $state = $_SESSION['state'];
    $city = $_SESSION['city'];
    $area = $_SESSION['area'];
    $sques = $_SESSION['Security_ques'];
    $sans = $_SESSION['Security_ans'];
    //echo $password.$cpassword;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $dt = date('Y-m-d h:i:sa');

      if($usertype == 2)
              {
                    $filename2 = $_FILES["skillcerti"]["name"];
                    $vendor_category = $_POST['category_type'];
                    $membership = $_POST['membership'];
                    $idProof = $_POST['proof_type'];
                    $filename1 = $_FILES["dpfileupload"]["name"];
                    $idProof_type = 'Aadhar Card';
                    if(($password == $cpassword)){
                      $sql = "INSERT INTO `User` (`user_name`,`email_address`,`addr`,`user_type_id`,`area_pincode`,`mobile`,`display_picture`,`user_id_proof`,`user_id_proof_type`,`skill_certificate`,`vendor_category_id`,`membership_id`,`membership_start_date`) VALUES ('$username','$email','$address','$usertype','$area','$mobile','$filename1','$idProof',' $idProof_type','$filename2','$vendor_category','$membership','$dt');";
                      $result = mysqli_query($con, $sql);
                      if($result)
                      {
                        header("location: \Login\_payment.php");
                      }
                    }
              }
      else{
             
              //$filename2 = $_FILES["skillcerti"]["name"];
              //$vendor_category = $_POST['category_type'];
              $membership = $_POST['membership'];
              $idProof = $_POST['proof_type'];
              $filename1 = $_FILES["dpfileupload"]["name"];
              $idProof_type = 'Driving License';
              if(($password == $cpassword)){
                $sql = "INSERT INTO `User` (`user_name`,`email_address`,`addr`,`user_type_id`,`area_pincode`,`mobile`,`display_picture`,`user_id_proof`,`user_id_proof_type`,`membership_id`,`membership_start_date`) VALUES ('$username','$email','$address','$usertype','$area','$mobile','$filename1','$idProof',' $idProof_type','$membership','$dt');";
                $result = mysqli_query($con, $sql);
                 //var_dump($result);
                if($result)
                {
                  header("location: \Login\_payment.php");
                }
               
              }
        }
                if ($result){
                    $showAlert = true;
                    $sql2 = "SELECT `user_id` FROM `User` WHERE `user_name` = '$username'";
                    $result1 = mysqli_query($con, $sql2);
                    $uid = mysqli_fetch_assoc($result1);
                    $uid = (int)$uid['user_id'];
                    //var_dump ($uid);
                    $sql1 = "INSERT INTO `Login` (`username`, `password`, `security_question`, `security_answer`, `user_id`) VALUES ('$username','$password','$sques','$sans','$uid');";
                    $execute = mysqli_query($con, $sql1);
                    //var_dump($execute);?>
                 <strong>  <h1> <?php echo "You are registered succesfully now you can login";?></h1> </strong> <?php
                }
            else{
                         $showError = "Passwords do not match";
                     }

    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Membership</title>

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

    <link rel="stylesheet" href="newstyle_membership.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>

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
  width: 120%;
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



<div class="container">
        <form method = "POST" enctype="multipart/form-data">
          <table>
            <thead>
</thead>
<tbody>
<?php 
if ($usertype == 2)
{

  ?> 
  <tr><div class="form-group">
      <td>      <label for="form-group" class="required">Category Type</label> </td>
      <td>      <select class="form-control" id="category_type" name='category_type'>
                <option value="">Please Select Option</option>
                <?php 
       // include 'con12.php';
        $query = mysqli_query($con,"SELECT * FROM Vendor_category");
        $rowcount=mysqli_num_rows($query);
        ?>
                <?php
                for($i=1;$i<=$rowcount;$i++)
                {
                    $row=mysqli_fetch_array($query);
                
                ?>
                
                <option value="<?php echo $row["vendor_category_id"]?>"><?php echo $row["category_name"]?>
                    </option>
                    <?php
               }
               ?>
            </select> </td> <br/>
        </div>
 </tr>
<tr> 
        <div class="form-group">
     <td>      <label class="label_txt required">Enter Skill Certificate: </label> </td>&nbsp &nbsp &nbsp &nbsp  
      <td>        [Select image to upload:]  &nbsp 
            <input type="file" name="skillcerti" id="skillcerti">
             <!-- <input type="submit" value="Upload Image" name="upload"> -->

<?php
             //FILE UPLOAD FOR SKILL CERTIFICATE
      $msg = "";
      $uploadOk = 1;
                      
                        
     // If upload button is clicked ...
    if (isset($_POST['submit'])) {
                        
      $filename2 = $_FILES["skillcerti"]["name"];
      $tempname = $_FILES["skillcerti"]["tmp_name"];    
      $imageFileType = strtolower(pathinfo($filename2,PATHINFO_EXTENSION));
      $folder = "image/user".$filename2;
      // Allow certain file formats
      if ($filename2 == "")
      {
          echo "Please select a file";
      }
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" && $imageFileType != "pdf" ) {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
      }
    // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }
  }
  //FILE UPLOAD FOR SKILL CERTIFICATE
?>
             
          </div> <br/>
</td>
        
<?php
              }
              ?>

</tr>
<tr>
<?php
if ($usertype == 3)
{?>
         <td>    <p class="required">Enter Your Driving Lincense Number :</p> </td>
         <td>     <input type="text" id="Driving License" name="proof_type" placeholder="Driving License" pattern = "[A-Z]{2}[0-9]{2}[-]{1}[0-9]{4}[0-9]{7}">
            </td>
        
        <?php
        }
        
        else{

       
  ?> 
              
            
           


          <td>    <p class="required">Please Enter Your Aadhar Number :</p> </td>
           <td> <input type="text" id="aadhar card" name="proof_type" placeholder="Aadhar Card Number" pattern="[2-9]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}">
            </td>    
<?php
        }
        ?>
 
</tr>
     
 

<tr> 
        <div class="form-group">
     <td>      <label class="label_txt required">Display Picture: </label> </td>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <td>        [Select image to upload:] &nbsp
              <input type="file" name="dpfileupload" id="dpfileupload">
            <!--  <input type="submit" value="Upload Image" name="upload">-->
<?php

  //FILE UPLOAD FOR DISPLAY PICTURE
  $msg = "";
  $uploadOk = 1;


// If upload button is clicked ...
if (isset($_POST['submit'])) {

  $filename1 = $_FILES["dpfileupload"]["name"];
  $tempname = $_FILES["dpfileupload"]["tmp_name"];    
  $imageFileType = strtolower(pathinfo($filename1,PATHINFO_EXTENSION));
  $folder = "image/user".$filename1;
  // Allow certain file formats
  if ($filename1 == "")
  {
      echo "Please select a file";
  }
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" && $imageFileType != "pdf" ) {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
  }
// Now let's move the uploaded image into the folder: image
      if (move_uploaded_file($tempname, $folder))  {
          $msg = "Image uploaded successfully";
      }else{
          $msg = "Failed to upload image";
      }
}
//FILE UPLOAD FOR DISPLAY PICTURE

?>



          </div>
<br/> </td> </tr>



</tbody>
              </table>    
</div>
<div class="container">
<?php
            include 'con12.php';
            $query = mysqli_query($con,"SELECT * FROM Membership;");
            if (mysqli_num_rows($query) > 0) {
                $row_id = 1;
                while($row = mysqli_fetch_array($query)) {
                    $row_Class = "pricing-table table".$row_id?>
                    
       
      <div class="<?php echo $row_Class ?>">
        <div class="pricing-header">
          <div class="price"> 
           <?php     echo "₹",$row["membership_rate"];
          ?></div>
          <div class="title"> <?php echo  $row["membership_type"]; ?> </div>
        </div>
        <ul class="pricing-list">
          <li>
          <input type="radio" id="membership" name="membership" value="<?php echo $row['membership_id'];?>">
          <?php
                echo "Membership Type : ", $row["membership_type"];
          ?>
          </li>
          <div class="border"></div>
          <li>
          <?php
                echo " Membership Rate : " ,$row["membership_rate"];
          ?>
          </li>
          <div class="border"></div>
          <li>
          <?php
                echo "Duration :", $row["membership_duration"];
          ?>
          </li>
          <div class="border"></div>
          <li>  <!--<label for="membership"></label><br> --> </li>
        </ul>
        <a href="_payment.php">Pay Now</a>
      </div>
<?php 
 $row_id ++;  
}
             
            }
                ?>
      </div>
    </div>
    
          

  <center>  <button class = "btn hvr-hover" style="font-weight:bold; color:white;" type="submit" name = "submit" > SUBMIT </button> </center> <br/>
              </form>

<!-- Start copyright  -->
<div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2021-22 The Bliss</a>
            </p>
    </div>

  </body>
</html>
