<?php 

include_once "con12.php";
session_start();
$username=$_SESSION['username'];
$s1="SELECT * FROM user WHERE user_name='$username'";
$r1=mysqli_query($conn,$s1);

$msg = "";
$uploadOk = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Profile Page</title>
<!--<link rel="stylesheet" href="profile.css"> -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
   

    <link rel="shortcut icon" href="Logo.jpg" type="image/x-icon">  <!-- add your logo it will be visible on title bar -->
    <link rel="apple-touch-icon" href="Logo.jpg">

</head>

<body >
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
              
                <div class="mm">
   
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row justify-content-center">
                        <?php 
if (isset($_POST["submit"]))
{		
    //file upload start

    $filename = $_FILES["fileupload"]["name"];
    $tempname = $_FILES["fileupload"]["tmp_name"];    
    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    
    $folder = "C:/xampp/htdocs/Login/image/user/";
    //$folder = "/Login/image/user";
    // Allow certain file formats
    if ($filename == "")
    {
        //echo "Please select a file";
    }
    else if($imageFileType != "jpg" &&  $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "pdf" )
    {
        echo "Only JPG, JPEG, PNG , GIF files are allowed.";
        $uploadOk = 0;
    }
    else{

    // Get all the submitted data from the form
   // $sql = "UPDATE User SET user_id_proof = '$filename' WHERE user_name = '$username'";

    // Execute query
   //mysqli_query($con, $sql);
    }
 // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder.$filename))  
        {
            $msg = "Image uploaded successfully";
        }
        else
        {
            $msg = "Failed to upload image";
        }


//file upload end
    $uname = $_POST['username'];
    $email = $_POST['email_id'];
    $phone = $_POST['phone_number'];
    $address = $_POST['address'];
    $filename = $_FILES['fileupload']["name"];

    if($filename == NULL){
        $sql = mysqli_query($conn,"UPDATE user SET user_name='$uname',email_address='$email',mobile='$phone',addr='$address' WHERE user_name='$username';");
    }
    else{
        $sql = mysqli_query($conn,"UPDATE user SET user_name='$uname',display_picture='$filename',email_address='$email',mobile='$phone',addr='$address' WHERE user_name='$username';");
    }
   
    //$sql2 = mysqli_query($conn,"UPDATE `login` SET `username`='$uname' WHERE `username` = '$username';");
    //echo "Profile updated successfully";
//$insert = mysqli_query($db,"INSERT INTO `tblemp`(`fullname`, `age`) VALUES ('$fullname','$age')");
//$sql="INSERT INTO product_category VALUES (product_category_id,'$pname')";
//$res=$conn->query($sql);


//echo "$sql";

if($sql)
{
    ?>
    <div class="alert alert-primary" role="alert" align="center"> PROFILE UPDATED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='profile.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php

}
else{
        echo "ERROR ";
        echo mysqli_error($conn);
}



    // if(!$sql OR !$sql1)
    // {
    //     echo "ERROR ";
    //     echo mysqli_error($conn);
    // }
    // else
    // {
    //     ?>
   <!-- //     <div class="alert alert-primary" role="alert" align="center"> PROFILE UPDATED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='profile.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    //     --><?php

    // }
}
?>



                            <div class="col-lg-7">
                                <div class="p-5">
                                    
                               
          
                                   
									
                                    <form    action="/Login/VENDOR_$/profile.php" method="post" enctype="multipart/form-data">
                                      <table>
                                        <tr>

                                     <?php while($row=mysqli_fetch_array($r1))
                                     { ?>

                                        <h2 align="center" style="color: black">Profile</h2>
</tr>
<break>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <tr>
                                     <center>
                                         
 
  
<!--UPLOAD IMAGE-->

<!--<p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
                                     -->  

<p><img id="output" class="rounded-circle mr-2" width="100%" height="100%" style="width:100px;height: 100px;margin:20px 35% ;" align="middle" src="/Login/image/user/<?php echo $row['display_picture']; ?>"/></p>
<p> <input type="file" name="fileupload" id="fileupload"></p>

<?php


?>

<script>
var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
<table>

<tr>
  <p>
 <td> <label> Name : </label> </td>     
<td> <input type="text" class="form-control select2bs4" style="text-transform:capitalize;" placeholder="User Name" name="username" pattern="[A-Za-z\s]*"  value="<?php echo $row['user_name'];?>" required> </td>
</p>
</tr> 

<tr>
<p>
<td> <label> Email : </label> </td> 
<td> <input type="Email" class="form-control select2bs4" placeholder="Email ID" name="email_id"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  value="<?php echo $row['email_address'];?>" required> </td>

</p>
</tr>

<tr>
<p>
<td> <label> Contact No. : </label> </td> 
<td> <input type="tel" class="form-control select2bs4" placeholder="Phone Number" name="phone_number" pattern="[0-9]{10}"  value="<?php echo $row['mobile'];?>" required> </td>
</p>
</tr>


<!--<input type="text" placeholder="Vendor Category" name="" required> -->
<tr>
<p>
<td> <label> Address : </label> </td> 
<td> <textarea class="form-control select2bs4" style="text-transform=capitalize" placeholder="Enter Address" name="address"  value="<?php echo $row['addr'];?>" required> <?php echo $row['addr'];?> </textarea> </td>
<!--<input type="number" placeholder="Area Pincode" name="area" pattern="[0-9]{5}" required> -->
</p>
</tr>




</table> 

</center>

<br/> <br/>
<button type="" name="" style="float: left;margin: 10px 0 0 18.2%;background-color: #d33b33;"><i style="color:white"><b>CANCEL</b></i></button>

<button type="submit" name="submit" value="Submit" style="float: right;margin:10px 18.2% 0 0;background-color: #d33b33;"><i style="color:white"><b>UPDATE</b></i></button>
<br/><br/>
<br/><br/>

</div>


</center>
  <?php } ?>      
  </tr>
<break>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <!--       <input  type="text" id="p_cat_id" aria-describedby="p_cat_id" placeholder="Enter product category id" name="p_cat_id" required>  -->
                                    
                                    </div>
                                        
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                        <hr>
</table>
                                    </form>
									
									
                                    
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