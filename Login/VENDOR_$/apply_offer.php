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

    
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

    <title>Offer/Discount</title>
    <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
</head>

<body >
    <div class="d-flex" id="wrapper" >
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-image: linear-gradient(to right top, #f4f3f3, #f6cdcc, #f4a7a4, #ec8179, #df594e, #df594e, #df594e, #df594e, #ec8179, #f4a7a4, #f6cdcc, #f4f3f3);">
          <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
                <div class="card shadow">
                                       <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Apply Offer / Discount</h3></p> </center>
                        </div>
                        <div class="card-body">
<div align="center">
    <h5>Add offer / Discount 
    <a class="btn btn-primary"style="background-color: #d33b33;" href="add_offer_discount.php" name="submit">&#43;</a> </h5>
</div>
                        <?php 
include_once 'con12.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
       
      
       if(empty($_POST['main_category']))
       {
        ?>
        <div class="alert alert-primary" role="alert" align="center"> YOU DID NOT SELECTED DISCOUNT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>

<?php  
       }
      elseif(empty($_POST['p_id']))
      {      ?>
                      <div class="alert alert-primary" role="alert" align="center"> YOU DID NOT SELECTED ANY PRODUCT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
      
  <?php    }

         else
         {
            $o_id=$_POST['main_category'];
            $checkbox1=$_POST['p_id'];
             $c=count($checkbox1);
             for($i=0; $i < $c; $i++) 
             {  
                    $q1="UPDATE `product` SET `offer/discount_id`='$o_id' WHERE product_id='$checkbox1[$i]';";
                   $sql=mysqli_query($conn,$q1);
                  
             }  
             if(!$sql)
             {
                  echo "ERROR ";
                  echo mysqli_error($conn);
             }
              else
              {
                ?>
                     <div class="alert alert-primary" role="alert" align="center"> OFFER/DISCOUNT ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='view_product.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                     <?php
              }
}
    
    
    
}

?>


                            <div class="row">
                              
                               
                               
                                
  
                            </div>
                            <div>
                            <div class="card-body" >
                          			<form method="post">
			
                <div class="mb-4">
					<!-- <label class="form-label">Discount</label> -->
					<div class="row gx-2">
						<div class="col-4">
						    <!-- <input placeholder="Discount" name="discount" type="number" min="1" class="form-control"> -->
					  	</div>
</div>
</div>

                          <div class="mb-4">
					 <label class="form-label"><h6>Select Offer To Apply</h6></label>  
					<div class="row gx-2">
						<div class="col-4">
                       <?php 
                       include_once "con12.php";
                       $username=$_SESSION['username'];

$q6="SELECT * FROM user WHERE user_name='$username'";
$s6=mysqli_query($conn,$q6);

while($r1=mysqli_fetch_array($s6))
{
    $vendor_id=$r1['user_id'];
}
                       $q2="SELECT * FROM `offer/discount` WHERE vendor_id='$vendor_id';";
                       $s2=mysqli_query($conn,$q2);
                       ?>
                       <select class="form-select" name="main_category" id="main_category" required>
                        <option value="0">Select offer</option>
                       <?php 
                       while($r2=mysqli_fetch_array($s2))
                       {
                       ?>
                       
                          <option value="<?php echo $r2['offer/discount_id'];?>"><?php echo $r2['discount'];?> %</option>
					    
                       <?php } ?>
                       </select>
					  	</div>
                    </div>
                        </div>
                        <div class="mb-4">
					 <label class="form-label"><h6>Select one or multiple products</h6></label> 
					<div class="row gx-2">
						<div class="col-4" requireds>
                        
                        <?php 
                       include_once "con12.php";
                       

                       $q2="SELECT * FROM product WHERE vendor_id=$vendor_id";
                       $s2=mysqli_query($conn,$q2);
                       ?>
                       
                       <?php 
                       while($r2=mysqli_fetch_array($s2))
                       {
                       ?>
                          <input name="p_id[]" class="form-check-input" type="checkbox" value="<?php echo $r2['product_id']?>">    <?php echo $r2['name'];?>
                          <br>
                          <br>
                         
                       <?php } ?>
                      




					  	</div>
                    </div>
                        </div>
                        <!--label class="form-check mb-4">
				  <input class="form-check-input" type="checkbox" value="">
				  <span class="form-check-label">  Publish on website </span>
				</label-->

				<button style="background-color: #d33b33;" class="btn btn-primary" name="submit"><b>Apply Offer</b></button>

			</form>
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


