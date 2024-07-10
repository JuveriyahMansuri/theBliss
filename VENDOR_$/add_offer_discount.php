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

    <title>Add Offers</title>
    <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Add Offer / Discount</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="5" selected="">5</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                    
                                  </div>
                               
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                                 -->
  
                            </div>
                            <div>
                            <div class="card-body" >
                            <?php
include_once 'con12.php';
$username=$_SESSION['username'];

$q6="SELECT * FROM user WHERE user_name='$username'";
$s6=mysqli_query($conn,$q6);

while($r1=mysqli_fetch_array($s6))
{
    $vendor_id=$r1['user_id'];
}



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $discount=$_POST['discount'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];

    $q1="INSERT INTO `offer/discount` (vendor_id,discount,start_date,end_date) VALUES ('$vendor_id','$discount','$start_date','$end_date');";
    $sql=mysqli_query($conn,$q1);
    
    if(!$sql)
    {
        echo "ERROR ";
         echo mysqli_error($conn);

    }
    else
    {
        ?>
        <div class="alert alert-primary" role="alert" align="center" > OFFER/DISCOUNT ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" style="background-color: #d33b33;" onClick="Javascript:window.location.href='apply_offer.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        <?php
       // header("location: \Login\VENDOR_$\apply_offer.php");
                                 
    
    }
}
?>
			<form method="post">
			
                <div class="mb-4">
					<label class="form-label">Discount</label>
					<div class="row gx-2">
						<div class="col-4">
						    <input placeholder="Discount" name="discount" required type="number" min="1" class="form-control">
					  	</div>
</div>
</div>

                          <div class="mb-4">
					<label class="form-label">Select Start Date</label>
					<div class="row gx-2">
						<div class="col-4">
                        <input type="date" id="dpicker" required name="start_date" class="form-control" format= 'yyyy-mm-dd' />
                        
					  	</div>
                    </div>
                        </div>

                        <div class="mb-4">
					<label class="form-label">Select End Date</label>
					<div class="row gx-2">
						<div class="col-4">
                        <input type="date" id="dpicker1" required name="end_date" class="form-control" format= 'yyyy-mm-dd'/>
                        
					  	</div>
                    </div>
                        </div>
                        <script type="text/javascript">
                $(function () {

                    $(function(){
                        var dtToday = new Date();
                        var month = dtToday.getMonth() + 1;
                        var day = dtToday.getDate();
                        var daynew = dtToday.getDate() + 1;
                        var year = dtToday.getFullYear();
                        if(month < 10)
                            month = '0' + month.toString();
                        if(day < 10)
                            day = '0' + day.toString();

                        if(daynew < 10)
                            daynew = '0' + daynew.toString(); 

                        var maxDate = year + '-' + month + '-' + day;
                        var newmaxdate = year + '-' + month + '-' + daynew;
                        //alert(newmaxdate);
                        $('#dpicker').attr('min', maxDate);
                        $('#dpicker1').attr('min', newmaxdate);
                    });


                    $("#submit").click(function () {
                        var fromdate = new Date($("#dpicker").val()); //Year, Month, Date
                        var todate = new Date($("#dpicker1").val()); //Year, Month, Date
                        // if (todate <= fromdate) {
                        //     alert("end date should be greater than start date");
                        // } else {
                        //     alert("start date should be greater or equal to than today's date");
                        // }
                    });
                });
            </script>
                        <!--label class="form-check mb-4">
				  <input class="form-check-input" type="checkbox" value="">
				  <span class="form-check-label">  Publish on website </span>
				</label-->

				<button class="btn btn-primary" style="background-color: #d33b33;" id="submit" name="submit"><b>Add Offer</></button>

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


