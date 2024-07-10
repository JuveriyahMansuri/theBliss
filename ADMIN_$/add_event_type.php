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
    <title>Add Event Type</title>
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
    <form action="/Login/ADMIN_$/add_event_type.php" method="post">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-7">
                                <div class="p-5">
                                    
                                <?php
include 'con12.php';




    if($_SERVER['REQUEST_METHOD'] == 'POST')
{		

    $ename = $_POST['event_name'];
    $s5=mysqli_query($conn,"SELECT event_name FROM event_type WHERE event_type_id IS NULL");

    while($r5=mysqli_fetch_array($s5))
    {
        $duplicate_name=0;
if($r5['event_name']==$ename)
{
    $duplicate_name=1;
    
}

    }

if($duplicate_name==1)
{ 
    ?>
    <div class="alert alert-primary" role="alert" align="center"> EVENT TYPE ALREADY EXISTS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" onClick="Javascript:window.location.href = 'view_event_type.php';"  data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php
}
else

$sql = mysqli_query($conn,"INSERT INTO `event_type` (`event_name`) VALUES ('$ename')");


if(!$sql)
{
    echo "ERROR ";
     echo mysqli_error($conn);
}
else
{
    ?>
    <div class="alert alert-primary" role="alert" align="center"> EVENT TYPE ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href = 'view_event_type.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php

}
}

?>

          
                                   
									<form action="/ADMIN_$/add_event_type.php" method="post">
                                    <form    action="/ADMIN_$/add_event_type.php" method="post">
                                      <table>
                                        <tr>
                                        <h5 align="center">Add Event Type</h5>
</tr>
<break>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <tr>
                                       <center>
                                        <div >
                                          <label>Enter Event Name</label> 
                                           <input style= "text-transform:caapitalize;" type="text" pattern="[A-Za-z\s]*" title="Enter only Letters" id="event_name" aria-describedby="event_name" placeholder="event name" name="event_name" required>
</center>                                         
</tr><script>
    function my()
    {
        var x=document.getElementById("event_name");
        x.value=x.value.toLowerCase();
    }
</script> 
<break>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <!--       <input  type="text" id="p_cat_id" aria-describedby="p_cat_id" placeholder="Enter product category id" name="p_cat_id" required>  -->
                                    
                                    </div>
                                        
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <tr>
                                          <center>
                                        <input onClick="my()"  type="submit" style="background-color:grey; font-weight: bold; color:white; " name="submit" value="SUBMIT" >
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