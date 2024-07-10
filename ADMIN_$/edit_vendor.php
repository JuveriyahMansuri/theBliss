<?php

session_start();
include 'con12.php';

$q1="SELECT u.user_id,u.user_id_proof_type,u.display_picture,u.user_name,u.user_id_proof,u.email_address,u.mobile,u.addr,v.category_name,m.membership_type,u.membership_start_date,u.skill_certificate,a.area_name FROM user AS u INNER JOIN area AS a ON u.area_pincode=a.pincode INNER JOIN membership AS m ON u.membership_id=m.membership_id INNER JOIN vendor_category AS v ON v.vendor_category_id=u.vendor_category_id WHERE u.user_type_id=2 AND u.user_id=".$_GET['vid'];
$s1=mysqli_query($conn,$q1);


$msg = "";
$uploadOk = 1;

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
    <!-- the below script is for ajax code-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Vendor Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:gray; ">
          <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
                <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Edit Vendor</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <?php
                             if($_SERVER['REQUEST_METHOD'] == 'POST')
                            {
                                include 'con12.php';
                            //file upload start of display picture
                            
                            $filename_dp = $_FILES["dp"]["name"];
                            $tempname_dp = $_FILES["dp"]["tmp_name"];    
                            $imageFileType = strtolower(pathinfo($filename_dp,PATHINFO_EXTENSION));
                            
                            $folder_dp = "C:/xampp/htdocs/Login/image/user/".$filename_dp;
                            // Allow certain file formats
                            if ($filename_dp == "")
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
                                if (move_uploaded_file($tempname_dp, $folder_dp))  
                                {
                                    $msg = "Image uploaded successfully";
                                }
                                else
                                {
                                    $msg = "Failed to upload image";
                                }
                            
                            
                            //file upload end of display picture
                            
                            //file upload start of id proof
                            
                            // $filename_id = $_FILES["id_proof"]["name"];
                            // $tempname_id = $_FILES["id_proof"]["tmp_name"];    
                            // $imageFileType = strtolower(pathinfo($filename_id,PATHINFO_EXTENSION));
                            
                            // $folder_id = "C:/xampp/htdocs/Login/image/user/".$filename_id;
                            // // Allow certain file formats
                            // if ($filename_id == "")
                            // {
                            //     //echo "Please select a file";
                            // }
                            // else if($imageFileType != "jpg" &&  $imageFileType != "png" && $imageFileType != "jpeg"
                            // && $imageFileType != "gif" && $imageFileType != "pdf" )
                            // {
                            //     echo "Only JPG, JPEG, PNG , GIF files are allowed.";
                            //     $uploadOk = 0;
                            // }
                            // else{
                            
                            // // Get all the submitted data from the form
                            // // $sql = "UPDATE User SET user_id_proof = '$filename' WHERE user_name = '$username'";
                            
                            // // Execute query
                            // //mysqli_query($con, $sql);
                            // }
                            // // Now let's move the uploaded image into the folder: image
                            //     if (move_uploaded_file($tempname_id, $folder_id))  
                            //     {
                            //         $msg = "Image uploaded successfully";
                            //     }
                            //     else
                            //     {
                            //         $msg = "Failed to upload image";
                            //     }
                            
                            
                            //file upload end of id proof
                            
                            //file upload start of skill
                            
                            $filename_sc = $_FILES["sc"]["name"];
                            $tempname_sc = $_FILES["sc"]["tmp_name"];    
                            $imageFileType = strtolower(pathinfo($filename_sc,PATHINFO_EXTENSION));
                            
                            $folder_sc = "C:/xampp/htdocs/Login/image/user/".$filename_sc;
                            // Allow certain file formats
                            if ($filename_sc == "")
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
                                if (move_uploaded_file($tempname_sc, $folder_sc))  
                                {
                                    $msg = "Image uploaded successfully";
                                }
                                else
                                {
                                    $msg = "Failed to upload image";
                                }
                            
                            
                            //file upload end of skill
                            
                            $dp = $_FILES['dp']["name"];
                            $sc = $_FILES['sc']["name"];
                            //$id_proof = $_FILES['id_proof']["name"];
                            //$id_proof=$_POST['id_proof'];
                            $user_name = $_POST['user_name'];
                            $email_address = $_POST['email_address'];
                            $mobile = $_POST['mobile'];
                            $addr = $_POST['addr']; 
                            //$area_name = $_POST['area_name'];
                            if($dp!=NULL && $sc!=NULL)
                            {
                                $q2="UPDATE `user` SET display_picture='$dp',skill_certificate='$sc',`user_name` = '$user_name',`email_address` = '$email_address', `mobile` = '$mobile', `addr` = '$addr' WHERE `user_id`=".$_GET['vid'];
   
                            }
                            else if($dp==NULL && $sc==NULL)
                             {
                                 $q2="UPDATE `user` SET `user_name` = '$user_name',`email_address` = '$email_address', `mobile` = '$mobile', `addr` = '$addr' WHERE `user_id`=".$_GET['vid'];
   
                             }
                             else if($sc==NULL )
                              {
                                 $q2="UPDATE `user` SET display_picture='$dp',`user_name` = '$user_name',`email_address` = '$email_address', `mobile` = '$mobile', `addr` = '$addr' WHERE `user_id`=".$_GET['vid'];
   
                             }
                             else if($dp==NULL)
                             {
                              $q2="UPDATE `user` SET skill_certificate='$sc',`user_name` = '$user_name',`email_address` = '$email_address', `mobile` = '$mobile', `addr` = '$addr' WHERE `user_id`=".$_GET['vid'];
   
                             }
                             else if($dp==NULL)
                             {
                                 $q2="UPDATE `user` SET skill_certificate='$sc',`user_name` = '$user_name',`email_address` = '$email_address', `mobile` = '$mobile', `addr` = '$addr' WHERE `user_id`=".$_GET['vid'];
    
                             }
                            else if($sc==NULL)
                            {
                                $q2="UPDATE `user` SET display_picture='$dp',user_id_proof='$id_proof',`user_name` = '$user_name',`email_address` = '$email_address', `mobile` = '$mobile', `addr` = '$addr' WHERE `user_id`=".$_GET['vid'];
   
                            }
                            
                            else if($id_proof==NULL)
                            {
                                $q2="UPDATE `user` SET display_picture='$dp',skill_certificate='$sc',`user_name` = '$user_name',`email_address` = '$email_address', `mobile` = '$mobile', `addr` = '$addr' WHERE `user_id`=".$_GET['vid'];
   
                            }
                             
                            else
                            {
                                $q2="UPDATE `user` SET `user_name` = '$user_name',`email_address` = '$email_address', `mobile` = '$mobile', `addr` = '$addr' WHERE `user_id`=".$_GET['vid'];
   
                            }
                                                    $s2=mysqli_query($conn,$q2);
                            //var_dump($s2);
                            
                            if(!$s2)
                            {
                                echo "ERROR ";
                                echo mysqli_error($conn);
                            }
                            else
                            {
                                ?>
                                <div class="alert alert-primary" role="alert" align="center"> VENDOR DETAILS UPDATED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='vendor.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                  
                                <?php
                            }
                            
                            }
                            
                            
                            
                            ?>
                            
                            <div class="card-body">
                                <!-- form starts from below-->
			<form method="post" enctype="multipart/form-data">
                <table align="center">
                <?php while($r1=mysqli_fetch_array($s1))
                {?>
                <tr>
                <div class="mb-4">
				<td>	<label for="display_picture" class="form-label">Display picture</label> 
            </td>
            <td>
					<center><img height="150px" width="150px" src="/Login/image/user/<?php echo $r1['display_picture']; ?>"></center>
                    <input class="form-control" type="file" name="dp">
                </td>
                </div>
                </tr>
                <tr>
				<div class="mb-4">
					<td ><label for="user_name" class="form-label">User Name</label>
                    </td>
            <td>
					<input style= "text-transform:capitalize;" type="text" pattern="[A-Za-z\s]*" type="text" value="<?php echo $r1['user_name'];?>" placeholder="User Name" class="form-control" id="user_name" name="user_name">
				</td>
                </div>
                </tr>
                <tr>
                <!-- <div class="mb-4">
                     <td>
					<label for="user_id_proof" class="form-label">User id Proof</label>
                </td> 
                <td>
					<center><img height="150px" width="150px" src="/Login/image/user/<?php echo $r1['user_id_proof']; ?>" ></center>
                    <input type="file" name="id_proof">
                </td>
                </div> -->
                </tr>
                <tr>
                <div class="mb-4">
                    <td>
					<label for="skill_certificate" class="form-label">skill certificate</label>
                </td>
                <td>
                    <center><img height="150px" width="150px" src="/Login/image/user/<?php echo $r1['skill_certificate']; ?>" ></center>
                    <input type="file" name="sc">
                </td>
                </div>
                </tr>
                <tr>
                <div class="mb-4">
                    <td>
					<label for="email" class="form-label">Email Address</label>
                </td>
                <td>
					<input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $r1['email_address'];?>" placeholder="email" class="form-control" id="email_address" name="email_address">
				</td>
                </div>
                </tr>
                <tr>
                <div class="mb-4">
                    <td>
					<label for="mobile" class="form-label">mobile</label>
                </td>
                <td>
					<input type="text" pattern="[0-9]{10}" value="<?php echo $r1['mobile'];?>" placeholder="mobile" class="form-control" id="mobile" name="mobile">
				</td>
                </div>
                </tr>
                <tr>
                <div class="mb-4">
                    <td>
					<label for="addr" class="form-label">Address</label>
                </td>
                <td>
					<input type="text" style="text-transform:capitaliza;" value="<?php echo $r1['addr'];?>" placeholder="address" class="form-control" id="addr" name="addr">
				</td>
                </div>
                </tr>
                <!-- <tr>
                <div class="mb-4">
                    <td>
					<label for="category_name" class="form-label">Vendor Category</label>
                </td>
                <td>
					<input type="text" value="<?php// echo $r1['category_name'];?>" placeholder="address" class="form-control" id="category_name" name="category_name">
				</td>
                </div>
                </tr>
                <tr>
                <div class="mb-4">
                    <td>
					<label for="membership_type" class="form-label">membership_type</label>
                </td>
                <td>
                    <input type="text" value="<?php //echo $r1['membership_type'];?>" placeholder="address" class="form-control" id="membership_type" name="membership_type">
				</td>
                </div>
				</tr>
                <tr>
                <div class="mb-4">
                    <td>
					<label for="membership_start_date" class="form-label">membership_start_date</label>
                </td>
                <td>
                    <input type="text" value="<?php //echo $r1['membership_start_date'];?>" placeholder="address" class="form-control" id="membership_start_date" name="membership_start_date">
				</td>
                </div>
				</tr> -->
                <!-- <tr>
                <div class="mb-4">
                    <td>
					<label for="area_name" class="form-label">area_name</label>
                </td>
                <td>
					<input type="text" value="<?php //echo $r1['area_name'];?>" placeholder="address" class="form-control" id="area_name" name="area_name">
				</td>
                </div>
                </tr> -->
                


				

				

				

                     

<br>
<br> 

 <tr align="center">
			<td>	<button class="btn btn-primary" value="SUBMIT" style="background-color:grey; color:white;"  name="submit"><b>UPDATE</b></button>
                </td>
        </tr>
       
<?php } ?>
                </table>
			</form>
          </div>


                             
 
                         
                                
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