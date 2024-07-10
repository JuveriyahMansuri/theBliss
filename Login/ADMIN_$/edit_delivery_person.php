<?php

session_start();
include 'con12.php';

$q1="SELECT u.user_id,u.user_name,u.email_address,u.mobile,u.addr FROM user AS u WHERE u.user_id=".$_GET['vid'];
$s1=mysqli_query($conn,$q1);




if($_SERVER['REQUEST_METHOD'] == 'POST')
{

$user_name = $_POST['user_name'];
$email_address = $_POST['email_address'];
$mobile = $_POST['mobile'];
$addr = $_POST['addr']; 
//$area_name = $_POST['area_name'];

$q2="UPDATE user SET user_name='$user_name',email_address='$email_address',mobile=$mobile,addr='$addr' WHERE user_id=".$_GET['vid'];
$s2=mysqli_query($conn,$q2);

header("location: \Login\ADMIN_$\delivery_person.php");
}



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

    <title>Admin Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:grey;">
          <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
                <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold" d ><h3>Edit Delivery Person Profile</h3></p> </center>
                        </div>
                        <div class="card-body">
                            
                            <div class="card-body">
                                <!-- form starts from below-->
			<form method="post" enctype="multipart/form-data">
                <table align="center">
                <?php while($r1=mysqli_fetch_array($s1))
                {?>
               
                <tr>
				<div class="mb-4">
					<td><label for="user_name" class="form-label">User Name</label>
                    </td>
            <td>
					<input type="text" pattern="[A-Za-z\s]*" style= "text-transform:capitalize;" value="<?php echo $r1['user_name'];?>" placeholder="User Name" class="form-control" id="user_name" name="user_name">
				</td>
                </div>
                </tr>
                
                
                <tr>
                <div class="mb-4">
                    <td>
					<label for="email"  class="form-label">Email Address</label>
                </td>
                <td>
					<input type="email" value="<?php echo $r1['email_address'];?>" placeholder="email" class="form-control" id="email_address" name="email_address">
				</td>
                </div>
                </tr>
                <tr>
                <div class="mb-4">
                    <td>
					<label for="mobile"  class="form-label">mobile</label>
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
					<input type="text"  style= "text-transform:capitalize;" value="<?php echo $r1['addr'];?>" placeholder="address" class="form-control" id="addr" name="addr">
				</td>
                </div>
                </tr>
              

				

                     

<br>
<br> 

 <tr align="center">
			<td>	<button class="btn btn-primary" style="background-color:grey; color:white;" name="submit"><b>UPDATE</b></button>
                </td>
        </tr>
        <!-- <script>
            function my()
            {
                

            }
            </script> -->
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