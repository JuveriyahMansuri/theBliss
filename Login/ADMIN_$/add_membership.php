<?php 
session_start();
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
    <title>Add Membership</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
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
              
                <div class="mm">
    <form action="/Login/ADMIN_$/add_membership.php" method="post">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-7">
                                <div class="p-5">
                                    
                                <?php
include "con12.php";


/*if(isset($_POST['submit']))
{
	$username=get_safe_value($con,$_POST['username']);
	$password=get_safe_value($con,$_POST['password']);
	$sql="select * from User where username='$username' and password ='$password'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']='$username';
		header('location:product.php');
		die();
		
	}else{
		"Please enter correct login details";
	}
		
}*/

    if($_SERVER['REQUEST_METHOD'] == 'POST')
{		
//$pid = $_POST['p_cat_id'];
    $mtype = $_POST['mtype'];
    $mrate = $_POST['mrate'];
    $mdays = $_POST['mdays'];

$sql = mysqli_query($conn,"INSERT INTO `membership` (`membership_type`,`membership_rate`,membership_duration) VALUES ('$mtype',$mrate,$mdays)");

//$insert = mysqli_query($db,"INSERT INTO `tblemp`(`fullname`, `age`) VALUES ('$fullname','$age')");
//$sql="INSERT INTO product_category VALUES (product_category_id,'$pname')";
//$res=$conn->query($sql);


//echo "$sql";
if(!$sql)
{
    echo "ERROR ";
     echo mysqli_error($conn);
}
else
{
    ?>
    <div class="alert alert-primary" role="alert" align="center"> MEMBERSHIP TYPE ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" onClick="Javascript:window.location.href = 'membership.php';"  data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php
    
    //header("location: \Login\ADMIN_$\edit_p_cat.php");
}
}


?>
<!--<script>
    header("location: \Login\ADMIN_$\edit_p_cat.php");
</script> -->

          
                                   
									<form action="/ADMIN_$/add_membership.php" method="post">
                                    <form    action="/ADMIN_$/add_membership.php" method="post">
                                      <table>
                                        <tr>
                                        <h5 align="center">Add Membership</h5>
</tr>
<break>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <tr>
                                       <center>
                                        <div >
                                          <label>Enter Membership Type</label> 

                                          <input  type="text" style= "text-transform:capitalize;" pattern="[A-Za-z\s]*" title="Enter only Letters" id="p_cat_name" aria-describedby="p_cat_name" placeholder="membership type" name="mtype" required>

                                        </center>                                       
 <script>
    function my()
    {
        var x=document.getElementById("mtype");
        x.value=x.value.toLowerCase();
    }
</script> 
</tr>
<break>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <!--       <input  type="text" id="p_cat_id" aria-describedby="p_cat_id" placeholder="Enter product category id" name="p_cat_id" required>  -->
                                    
                                    </div>

                                    <center>
                                        <div >
                                          <label>Enter Membership Rate</label> 

                                          <input  type="number" min="0" id="p_cat_name" aria-describedby="p_cat_name" placeholder="membership rate" name="mrate" required>

                                        </center>                                       
 <script>
    function my()
    {
        var x=document.getElementById("mrate");
        x.value=x.value.toLowerCase();
    }
</script> 
</tr>
<break>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <!--       <input  type="text" id="p_cat_id" aria-describedby="p_cat_id" placeholder="Enter product category id" name="p_cat_id" required>  -->
                                    
                                    </div>
                                    <center>
                                        <div >
                                          <label>Enter Membership Duration</label> 

                                          <input  type="number"   min="10" id="p_cat_name" aria-describedby="p_cat_name" placeholder="membership days" name="mdays" required>

                                        </center>                                       
 <script>
    function my()
    {
        var x=document.getElementById("mdays");
        x.value=x.value.toLowerCase();
    }
</script> 
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
                                        <tr>
                                          <center>
                                              
                                        <input  onlclick="my()" type="submit" style="background-color:grey; font-weight: bold; color:white; " name="submit" value="SUBMIT" >
</center>
                 
</tr>
                                        <hr>
</table>
                                    </form>
									
									</form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
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
<?php mysqli_close($conn);?>