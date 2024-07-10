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
    <title>Add Category</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:gray;"> 
         <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
              
                <div class="mm">
    <form action="/Login/ADMIN_$/add_p_cat.php" method="post">
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




    if($_SERVER['REQUEST_METHOD'] == 'POST')
{		
//$pid = $_POST['p_cat_id'];
    $pname = $_POST['p_cat_name'];

    $s5=mysqli_query($conn,"SELECT * FROM product_category WHERE sub_category_id IS NULL");

    while($r5=mysqli_fetch_array($s5))
    {
        $duplicate_name=0;
if($r5['category_name']==$pname)
{
    $duplicate_name=1;
    
}

    }

if($duplicate_name==1)
{ 
    ?>
    <div class="alert alert-primary" role="alert" align="center"> CATEGORY ALREADY EXISTS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" onClick="Javascript:window.location.href = 'view_main_category.php';"  data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php
}
else
{
$sql = mysqli_query($conn,"INSERT INTO `product_category` (`category_name`,`sub_category_id`) VALUES ('$pname',NULL )");
if($sql)
{
    ?>
    <div class="alert alert-primary" role="alert" align="center"> CATEGORY ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" onClick="Javascript:window.location.href = 'view_main_category.php';"  data-bs-dismiss="alert" aria-label="Close"></button></div>
    <?php
    
    //header("location: \Login\ADMIN_$\edit_p_cat.php");

}
}
//echo "$sql";



    
}
?>
<!--<script>
    header("location: \Login\ADMIN_$\edit_p_cat.php");
</script> -->

          
                                   
									<form action="/ADMIN_$/add_p_cat.php" method="post">
                                    <form    action="/ADMIN_$/add_p_cat.php" method="post">
                                      <table>
                                        <tr>
                                        <h5 align="center">Add Product Categories</h5>
</tr>
<break>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <tr>
                                       <center>
                                        <div >
                                          <label>Enter Product Category Name</label> 

                                          <input  type="text" style= "text-transform:capitalize;" pattern="[A-Za-z\s]*" title="Enter only Letters" id="p_cat_name" aria-describedby="p_cat_name" placeholder="product category name" name="p_cat_name" required>

                                        </center>                                       
 <script>
    function my()
    {
        var x=document.getElementById("p_cat_name");
        x.value=x.value.toLowerCase();
    }
</script> 
<script>
         $(document).ready(function() {
    $('#p_cat_name').on('focusout', function() {
        var category_name = this.value;
        $.ajax({
            url: "dup.php",
            //type: "POST",
            data: {
                category_name: category_name
            },
            //cache: false,
            success: function(result) {
                if (result == 'success') {
                    alert("success"); 
               } else {
                    alert("duplicate");
                    return false;
               }
            }
        });
    });
});
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