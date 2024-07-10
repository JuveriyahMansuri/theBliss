<?php 
include 'con12.php';
session_start();
$pincode=$_GET['area'];


$q1="SELECT city_id FROM area WHERE pincode=$pincode";
$s1=mysqli_query($conn,$q1);
while($r1=mysqli_fetch_array($s1))
{
    $city=$r1['city_id'];
}

?>

<!DOCTYPE html>
<html lang="en">

<link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">  <!-- add your logo it will be visible on title bar -->
    <link rel="apple-touch-icon" href="The Bliss.png">

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
        <div id="page-content-wrapper" style="background-image: linear-gradient(to right top, #f4f3f3, #f6cdcc, #f4a7a4, #ec8179, #df594e, #df594e, #df594e, #df594e, #ec8179, #f4a7a4, #f6cdcc, #f4f3f3);">
          <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
                <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Assign Delivery</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $delivery_person_id=$_POST['del'];
    $vendor_id=$_GET['uid'];
    $oid=$_GET['oid'];
    $amt=$_POST['amt'];
    $s3=mysqli_query($conn,"SELECT * FROM user  WHERE user_id=$vendor_id");
    while($r3=mysqli_fetch_array($s3))
    {
        $pick_up_pincode=$r3['area_pincode'];
    }
    $q4="INSERT INTO request_delivery (amount,vendor_id,delivery_person_id,order_id,pickup_area_pincode) VALUES ($amt,$vendor_id,$delivery_person_id,$oid,$pick_up_pincode)";
    $s4=mysqli_query($conn,$q4);

    if(!$s4)
    {
        echo "error";
        echo mysqli_error($conn);
    }
    else
    {
        echo "success";
    }
}
    ?>
                                <!-- <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="5" selected="">5</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                    
                                  </div> -->
                               <div>
                               </div>
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                                
                               
                            </div>

                            <div class="card-body">
			<form method="post" enctype="multipart/form-data">
            <div>
            <div>
     <label class="form-label">Enter Amount</label>
     <input type="number" name="amt" min="50">
                    </div>          
			
                <label class="form-label">Select Delivery Person</label>
					    <select class="form-select" name="del" id="del" required>
                        <option value="0">Select Delivery Person</option>
                        <?php 
                        $q0="SELECT u.* FROM user u INNER JOIN user_type ut ON ut.user_type_id=u.user_type_id INNER JOIN area a ON a.pincode=u.area_pincode WHERE ut.user_type='Delivery Person' AND a.city_id=$city";

                        $s0=mysqli_query($conn,$q0);
                        while($r0=mysqli_fetch_array($s0))
                        {
                        ?>
                        <option value=<?php echo $r0['user_id'];?>><?php echo $r0['user_name']; ?></option>
                        <?php 
                        }
                        ?>
					    </select>
</div>
    

                  
                  
                     













<div class="row gx-2">


     
</div> <!-- row.// -->



<div class="mb-4">

     
        

    
    <div class="row gx-2">
        
    
    
    </div>  &nbsp;  &nbsp;
    &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
    &nbsp;  &nbsp;
    
    
    
    <!-- row.// -->
</div>
<br><br>


<button class="btn btn-primary" name="submit">Submit item</button>

</form>
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