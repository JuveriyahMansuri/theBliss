<?php

session_start();
$username=$_SESSION['username'];
include 'con12.php';

$pid=$_GET['pid'];

$q5="SELECT p.name,p.display_picture,p.description,p.price,p.product_category_id,p.value,p.unit_of_measurement,p.quantity_in_hand,p.is_customized,p.replaceable FROM product p WHERE p.product_id=$pid";
$s5=mysqli_query($conn,$q5);





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

    <title>Edit Product</title>
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Edit Product of product id <?php echo $pid;?></h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="5" selected="">5</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                    
                                  </div> -->
                               
                                <!-- <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div> -->
                                <?php 
                                if($_SERVER['REQUEST_METHOD'] == 'POST')
                                {
                                    // file upload for display picture
         $filename = $_FILES["singlefileupload"]["name"];
         $tempname = $_FILES["singlefileupload"]["tmp_name"];
         $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
         $folder = "C:/xampp/htdocs/Login/image/Project_images/";
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
           else
           {

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



    //ends here of display picture

    
                                
                                 // below is of display_picture
    $singlefilename = $_FILES['singlefileupload']["name"];
                                    $product_name=$_POST['product_name'];
                                    $description=$_POST['description'];
                                    //$main_category=$_POST['main_category'];
                                    /*if($_POST['sub_category']==0)
                                    {
                                        $product_category_id=$_POST['main_category'];
                                    }
                                    else
                                    {
                                        $product_category_id=$_POST['sub_category'];
                                    }*/
                                    
                                    $price=$_POST['price'];
                                    $value=$_POST['value'];
                                    $unit_of_measurement=$_POST['unit_of_measurement'];
                                   // echo $unit_of_measurement;
                                    $quantity_in_hand=$_POST['quantity_in_hand'];
                                
                                    $rep=$_POST['rep'];
                                    $cus=$_POST['cus'];
                                   
                                 
                                    if($singlefilename==NULL)
                                    {
                                        $q3="UPDATE product SET is_customized=$cus,replaceable=$rep,`name`='$product_name',description='$description',price=$price,value=NULL,unit_of_measurement='$unit_of_measurement',quantity_in_hand=$quantity_in_hand WHERE product_id=$pid";
                                        $s3=mysqli_query($conn,$q3);
                                    }
                                else if($unit_of_measurement==NULL)
                                {
                                    $q3="UPDATE product SET is_customized=$cus,replaceable=$rep,display_picture='$singlefilename',name='$product_name',description='$description',price=$price,value=NULL,unit_of_measurement='$unit_of_measurement',quantity_in_hand=$quantity_in_hand WHERE product_id=$pid";
                                    $s3=mysqli_query($conn,$q3);
                                }
                                else if($quantity_in_hand==NULL)
                                {
                                    $q3="UPDATE product SET is_customized=$cus,replaceable=$rep,`name`='$product_name',description='$description',price=$price,value=NULL,unit_of_measurement='$unit_of_measurement',display_picture='$singlefilename' WHERE product_id=$pid";
                                    $s3=mysqli_query($conn,$q3);
                                }
                              
                                
                                else
                                {
                                    
                                    //$q3="INSERT INTO product (display_picture,name,description,product_category_id,price,value,unit_of_measurement,quantity_in_hand,vendor_id) VALUES ('$filename','$product_name','$description',$product_category_id,$price,$value,'$unit_of_measurement',$quantity_in_hand,$vendor_id)";
                                     $q3="UPDATE product SET display_picture='$singlefilename',name='$product_name',description='$description',price=$price,value=$value,unit_of_measurement='$unit_of_measurement',quantity_in_hand=$quantity_in_hand WHERE product_id=$pid";
                                    $s3=mysqli_query($conn,$q3);
                                }
                                    if(!$s3)
                                    {
                                        echo "ERROR ";
                                         echo mysqli_error($conn);
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="alert alert-primary" role="alert" align="center"> PRODUCT UPDATED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" onClick="Javascript:window.location.href='view_product.php';" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                        <?php
                                           //header("location: \Login\VENDOR_$\view_product.php");
                                    }
                                
                                }
                                ?>
                               
                            </div>

                            <div class="card-body">
                                <!-- form starts from below-->
			<form method="post" enctype="multipart/form-data">
                <?php while($r5=mysqli_fetch_array($s5))
                {?>
				<div class="mb-4">
					<label for="product_name" class="form-label">Product Name</label>
					<input type="text" pattern="[A-Za-z\s]*" style="text-tranform:capitalize;" value="<?php echo $r5['name'];?>" placeholder="Enter Product Name" class="form-control" id="product_name" name="product_name">
				</div>

				<div class="mb-4">
					<label class="form-label">Product description</label>
					<input type="textarea" value="<?php echo $r5['description'];?>" placeholder="Enter Product description" class="form-control" style="rows:4px;" name="description">
				</div>
 

                <div align="center">
                <img height="100px" width="100px" src="/Login/image/Project_images/<?php echo $r5['display_picture']; ?>">
				
                </div>
                <div>
                </div>
                <div class="mb-4">
                   	<label class="form-label">Display picture</label>
					<input class="form-control" type="file" name="singlefileupload">
				</div>
     



				<div class="mb-4">
					<label class="form-label">Images</label>
					<input class="form-control" type="file" name="file">
				</div>

				

				<div class="row gx-2">
			
                      <!-- <div class="col-sm-6 mb-3">
					    <label class="form-label">Main-category</label>

					    <select class="form-select" name="main_category" id="main_category" required>
                        <option value="">Select Category</option>
                        <?php 
                       
                      // $q2="SELECT s.product_category_id,s.category_name,p.category_name AS sub FROM product_category AS s LEFT JOIN product_category AS p ON s.sub_category_id=p.product_category_id WHERE p.product_category_id=NULL";
                     // $q2="SELECT * FROM product_category WHERE sub_category_id IS NULL";
                     //  $s2=mysqli_query($conn,$q2);
                     //  while($row=mysqli_fetch_array($s2))
                     //  {
                       ?>
					    	<required option value="<?php //echo $row['product_category_id'];?>" ><?php //echo $row['category_name'];?> </option>
					    	<?php 
                     //  }
                            ?>
					    </select>
					  </div> -->

                     


<!-- <div class="col-sm-6 mb-3">
					    <label class="form-label">Sub-category</label>
					    <select class="form-select" name="sub_category" id="sub_category" required>
                        <option value="0">Select Category</option>
                        <option value=""> </option>
					    </select>

                         <script>
         $(document).ready(function() {
    $('#main_category').on('change', function() {
        var product_category_id = this.value;
        $.ajax({
            url: "main-by-sub.php",
            type: "POST",
            data: {
                product_category_id: product_category_id
            },
            cache: false,
            success: function(result) {
                $("#sub_category").html(result);
            }
        });
    });
});
      </script> 

					  </div> -->
				</div> <!-- row.// -->


				<div class="mb-4">
					<label class="form-label">Price</label>
					<div class="row gx-2">
						<div class="col-4">
						    <input value="<?php echo $r5['price'];?>" placeholder="Price" min="1" type="number" class="form-control" name="price">
					  	</div>
						
					</div> <!-- row.// -->
				</div>
               <!-- row.// -->
				</div>

                <?php $replaceable = $r5['replaceable']; ?>

                <div class="mb-4">
					<label class="form-label">Replaceable</label>
					<div class="row gx-2">
						<div class="col-4">
						<input type="radio" name="rep" value="1"  <?php if($replaceable =='1'){ echo "checked=checked";}  ?>  > Yes  
                        <input type="radio" name="rep" value="0"  <?php if($replaceable =='0'){ echo "checked=checked";}  ?> > No 
                    </div>
						
					</div> <!-- row.// -->
				</div>
               
                <?php $customized = $r5['is_customized']; ?>  

                <div class="mb-4">
					<label class="form-label">Customizable</label>
					<div class="row gx-2">
						<div class="col-4">
                        
						<input type="radio" name="cus" value="1"    <?php if($customized=='1'){ echo "checked=checked";}  ?> > Yes  
                        <input type="radio" name="cus" value="0"   <?php if($customized=='0'){ echo "checked=checked";}  ?> > No 
                    </div>
						
					</div> <!-- row.// -->
				</div>
                <div class="mb-4">

                      <label class="form-label"min = "0">Value</label>
					<div class="row gx-2">
						<div class="col-4">
						    <input value="<?php echo $r5['value'];?>" placeholder="Value" type="number" class="form-control" name="value">
                            <break>
                            <break>
                            &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                            &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                            &nbsp;  &nbsp;  &nbsp;  &nbsp;
                            <label class="form-label">Unit of Measurement</label>
                            <!-- <input value="<?php echo $r5['unit_of_measurement'];?>" placeholder="unit of measurement" type="text" class="form-control" name="unit_of_measurement">
                             -->
                             <select class="form-select" name="unit_of_measurement" id="unit_of_measurement">
                        <option value="NULL">Select Unit of measurement</option>
                        <option value="grams">grams </option>
                        <option value="kilograms">kilograms </option>
                        <option value="pair">pair </option>
                        <option value="set">set </option>
                        <option value="piece">piece </option>
					    </select>
                            <!--<select class="form-select" name="unit_of_measurement" id="unit_of_measurement"> -->
                            <?php 
                             /*if($r5['unit_of_measurement']=="grams")
                             {
                            ?>
                           <!-- <option value="NULL">Select Unit of measurement</option>-->
                            <option value="<?php echo $r5['value'];?>">grams </option>
                        
                        
                        <option value="kilograms">kilograms </option>
                        <?php } 
                             if($r5['unit_of_measurement']=="kilogram")
                             {
                            ?>
                            <option value="<?php echo $r5['value'];?>">killogram </option>
                            <!--<option value="NULL">Select Unit of measurement</option>-->
                        
                        <option value="grams">grams </option>
                        <?php } 
                              if($r5['unit_of_measurement']==NULL)
                             {
                            ?>
                            <option value="<?php echo $r5['value'];?>">Select Unit of measurement</option>
                        
                            <option value="grams">grams </option>
                        
                        <option value="kilograms">kilograms </option>
                        <?php } ?>
					    </select>*/?>
                            
					  	</div>
						

					
					<div class="row gx-2">
						
					
					
					</div>  &nbsp;  &nbsp;
                    &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                    &nbsp;  &nbsp;
                    
                    <label class="form-label" min="0">Quantity in hand</label>
					<div class="row gx-2">
						<div class="col-4">
						    <input pattern="[A-Za-z\s]*" value="<?php echo $r5['quantity_in_hand'];?>" placeholder="Quantity" type="number" min="0" class="form-control" name="quantity_in_hand">
					  	</div>
						
					</div>
                    
                    <!-- row.// -->
				</div>
<br><br>
				<!-- <label class="form-check mb-4">
				  <input class="form-check-input" type="checkbox" value="">
				  <span class="form-check-label">  Publish on website </span>
				</label> -->
                <script>
    function my()
    {
        var x=document.getElementById("product_name");
        x.value=x.value.toLowerCase();
    }
</script> 
				<button class="btn btn-primary"  style="background-color: #d33b33;" onclick="my()" name="submit" onclick="Javascript:window.location.href='view_product.php';"><b>Submit Item</b></button>
<?php } ?>
			</form>
          </div>


                            <?php  
 /*
$i=0;

 while($rows=mysqli_fetch_array($sql))
 { ?>
        <tr class="<?php if(isset($classname)) echo $classname; ?>">
        <td align="center"><?php echo $rows['product_category_id']; ?></td>
            
        <td align="center"><?php echo $rows['category_name']; ?></td>
        <td align="center"><?php echo $rows['sub']; ?></td>
        <td> <center> <a href='update.php?pc=<?php echo $rows["product_category_id"]; ?>' class="btn btn-primary">EDIT  </a></center>  </td>
      <td> <center>  <a href = 'edit_p_cat.php?action=delete&pc=<?php echo $rows["product_category_id"];  ?>' class="btn btn-primary" onclick="return confirm('Are you sure you want to delete?')">DELETE   </a></center></td>

        </tr>
        <?php 
         $i++;
    }?>
 
<?php 

if(isset($_GET['action']) && $_GET['action']=="delete")
{
    $query=mysqli_query($conn,"DELETE FROM product_category WHERE product_category_id='".$_GET['pc']."'");
    
    if($query)
    { ?>
        <div class="alert alert-primary" role="alert" align="center"> RECORD DELETED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
 
 <?php   }
    else
    {
        echo "ERROR";
    }
        }

*/?>

  

                         
                                <!--</table>
                            </div-->
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