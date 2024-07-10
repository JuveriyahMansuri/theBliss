<?php

session_start();
include 'con12.php';


$pid=$_GET['pro_cat'];


$q1="SELECT * FROM product_category WHERE product_category_id=$pid";
$r1=mysqli_query($conn,$q1);







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
    <title>Edit Category</title>
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

if(isset($_POST['n']))
{
  
  $cname = $_POST['p_cat_name'];
  //$sname=$_POST['sid'];
 
  $q3="UPDATE product_category SET category_name='$cname' WHERE product_category_id='$pid'";
  $s3=mysqli_query($conn,$q3);
  if(!$s3)
{
echo "ERROR ";
 echo mysqli_error($conn);
}
else
{
?>
<div class="alert alert-primary" role="alert" align="center"> CATEGORY UPDATED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button"onClick="Javascript:window.location.href = 'view_main_category.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
<?php

}

}
?>

          
                                   
									
                                    <form     method="post">
                                      <table>
                                        <tr>
                                        <h5 align="center">Edit Product Category</h5>
</tr>
<break>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <tr>
                                       <center>
                                        <div >
                                        <input required  pattern="[A-Za-z\s]*" style= "text-transform:lowercase;" type="hidden" id="p_cat_id" aria-describedby="p_cat_id" placeholder="product category name" name="p_cat_id" value="<?php echo $_GET['pc']; ?>" required>

                                          <label>Enter Product Category Name</label> 
                                      <?php while($rows=mysqli_fetch_array($r1))
                                      {?>
                                           <input required  pattern="[A-Za-z\s]*" style=  "text-transform:lowercase;" type="text" class="form-control select2bs4" value="<?php echo $rows['category_name']; ?>" title="Enter only Letters"  placeholder="product category name" name="p_cat_name" >
                                       <?php } ?>    
<break>
<break><script>
    function my()
    {
        var x=document.getElementById("p_cat_name");
        x.value=x.value.toLowerCase();
    }
</script> 
                                          
                                        </center>                                         
</tr>
<tr>
<div>
  <break>
<!-- <center>
<label>Select Sub Product Category </label> 
<select name="sid" class="form-control select2bs4" style="width: 100%;">
                        <option value="0" style= "text-transform:lowercase;">--- Select Category ---</option >
                        <?php
                        // include 'con12.php';
                        // $query = "select * from product_category WHERE sub_category_id IS NULL";
                        // $sql = mysqli_query($conn, $query);
                        // while ($data = mysqli_fetch_array($sql)) {
                        //   $selected = $data['product_category_id'] == $data1['product_category_id'] ? "selected" : "";
                        //   echo "<option value='{$data['product_category_id']}' $selected >{$data['category_name']} </option>";
                        // }

                        ?>
                      </select>

</center> -->
</div>
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
                                        <input onClick="my()" type="submit" name="n" value="SUBMIT" style="background-color:grey; font-weight: bold; color:white;" >
</center>
                                          </tr>
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





<!--


<select name="cname" class="form-control select2bs4" style="width: 100%;">
                        <option value="0">--- Select Category ---</option>
                       
                      </select>







                      if (isset($_POST['submit'])) {
  $scname = strtolower($_POST['scname']);
  $cname = $_POST['cname'];

 
    $query1 = "insert into tbl_subcategory (subcategory_name,category_id) values ('{$scname}','{$cname}')";
    $sql1 = mysqli_query($connection, $query1);
    if ($sql1) {
      echo "<script>success('Your Subcategory Is Inserted');</script>";
    }
  }



<form method="post" id="form">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Sub Category Name</label>
                          <input type="text" name="scname" class="form-control" id="exampleInputEmail1" placeholder="Enter Sub Category Name">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Select SubCategory</label>
                          <select name="cname" class="form-control select2bs4" style="width: 100%;" required>
                            <option value="0">--- Select Sub Category ---</option>
                       //     <?php
                       //     $query = "select * from tbl_category";
                       //     $sql = mysqli_query($connection, $query);
                       //     while ($data = mysqli_fetch_array($sql)) {
                       //       echo "<option value='{$data['category_id']}'>{$data['category_name']}</option>";
                       //     }

                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!--
                  <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a href='view-subcategory.php' class="btn btn-info">View</a>
                  </div>
                </form>
                          -->
                          