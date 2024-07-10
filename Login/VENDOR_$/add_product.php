<?php
include 'con12.php';
session_start();


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

    <title>Add Product</title>
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Add Product</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="5" selected="">5</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                    
                                  </div> -->
                               <div>
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
              echo "Please select a file";
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
    //below is of multiple images


    $product_name=$_POST['product_name'];
    $description=$_POST['description'];
    $main_category=$_POST['main_category'];
        if($_POST['sub_category']==0)
       {
        $product_category_id=$_POST['main_category'];
       }
        else
        {
              $product_category_id=$_POST['sub_category'];
         }
    
    $price=$_POST['price'];
    $value=$_POST['value'];
    $unit_of_measurement=$_POST['unit_of_measurement'];
    $quantity_in_hand=$_POST['quantity_in_hand'];

    $rep=$_POST['rep'];
    $cus=$_POST['cus'];

    $username=$_SESSION['username'];

    $searchPro = mysqli_query($conn,"SELECT * FROM `product` WHERE `name` = '$product_name';");
    if (mysqli_num_rows($searchPro) > 0) {
        
        $row = mysqli_fetch_assoc($searchPro);
        if($product_name == ($row['name']))
        {
             ?> <p style="color:red; font-weight:bold; font-size: 25px;"> *Product Already Exists </p> <?php
        }
    }
    else{

        include_once 'con12.php';
        $q1="SELECT * FROM user WHERE user_name='$username'";
        $s1=mysqli_query($conn,$q1);
        
        while($r1=mysqli_fetch_array($s1))
        {
            $vendor_id=$r1['user_id'];
        }
        
        
        
        if($unit_of_measurement==NULL)
        {
            
            $q3="INSERT INTO product (`is_customized`,`replaceable`,`display_picture`,`name`,`description`,`product_category_id`,`price`,`quantity_in_hand`,`vendor_id`) VALUES ('$cus','$rep','$singlefilename','$product_name','$description',$product_category_id,$price,$quantity_in_hand,$vendor_id)";
            $s3=mysqli_query($conn,$q3);
            
        }
        
        if($quantity_in_hand == NULL)
        {
            
            $q3="INSERT INTO product (`is_customized`,`replaceable`,`display_picture`,`name`,`description`,`product_category_id`,`price`,`vendor_id`,`unit_of_measurement`,`value`) VALUES ('$cus','$rep','$singlefilename','$product_name','$description',$product_category_id,$price,$vendor_id,'$unit_of_measurement','$value')";
            $s3=mysqli_query($conn,$q3);
            
        }
        
        else
        {
            
            $q3="INSERT INTO product (`is_customized`,`replaceable`,`display_picture`,`name`,`description`,`product_category_id`,`price`,`value`,`unit_of_measurement`,`quantity_in_hand`,`vendor_id`) VALUES ('$cus','$rep','$singlefilename','$product_name','$description',$product_category_id,$price,$value,'$unit_of_measurement',$quantity_in_hand,$vendor_id)";
            $s3=mysqli_query($conn,$q3);
            
        }
        
            if(!$s3)
            {
                echo "ERROR ";
                 echo mysqli_error($conn);
            }
            else
            {
                // $q4="SELECT * FROM product WHERE `name`='$product_name' AND vendor_id=$vendor_id";
                // $s4=mysqli_query($conn,$q4);
                // while($r4=mysqli_fetch_array($s4))
                // {
                //     $pid=$r4['product_id'];
                //     echo $pid;
                // }
                // if (mysqli_num_rows($res) > 0) {
                
                //     $row = mysqli_fetch_assoc($res);
                //     if($product_name == ($row['name']))
                //     {
                //             echo "Product  already exists";
                //     }
                    
                // }
                  // file upload for multiple images
        //    $total = count($_FILES['multiplefileupload']['name']);
        //             for( $i=0 ; $i < $total ; $i++ )
        //    {
        //       $tmpFilePath = $_FILES['multiplefileupload']['tmp_name'][$i];
        //       $q5="INSERT INTO product_image (`image`,product_id) VALUES ($tmpFilePath,$pid)";
        //       $s6=mysqli_query($conn,$q5);
        
        //       $newFilePath = "C:/xampp/htdocs/Login/image/Project_images/".$_FILES['multiplefileupload']['name'][$i];
        //       if(move_uploaded_file($tmpFilePath, $newFilePath))
        //        {
        
        //           //Handle other code here
            
        //         }
        //         else
        //         {
        //             echo "multiple upload error";
        //         }
        //    }
        
        //   //ends here of multiple images  
                ?>
                <div class="alert alert-primary" role="alert" align="center"> PRODUCT ADDED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" onClick="Javascript:window.location.href='view_product.php';" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                <?php
                    // header("location: \Login\VENDOR_$\view_product.php");
            }
        

    }


}



?>


</div>
                                <!--div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                                
                               
                            </div-->

                            <div class="card-body">
			<form method="post" enctype="multipart/form-data">
				<div class="mb-4">
					<label for="product_name" class="form-label">Product Name</label>
					<input type="text" required  pattern="[A-Za-z\s]*" style= "text-transform:capitalize;" placeholder="Enter Product Name" class="form-control" id="product_name" name="product_name">
				</div>

                  
                   <div class="col-sm-6 mb-3">
					    <label class="form-label">Main-category</label>

					    <select class="form-select" name="main_category" id="main_category" required> 
                        <option required value="0">Select Category</option>
                        <?php 
                       
                      // $q2="SELECT s.product_category_id,s.category_name,p.category_name AS sub FROM product_category AS s LEFT JOIN product_category AS p ON s.sub_category_id=p.product_category_id WHERE p.product_category_id=NULL";
                      $q2="SELECT * FROM product_category WHERE sub_category_id IS NULL";
                       $s2=mysqli_query($conn,$q2);
                       while($row=mysqli_fetch_array($s2))
                       {
                       ?>
					    	<option value="<?php echo $row['product_category_id'];?>" required><?php echo $row['category_name'];?> </option>
					    	<?php 
                       }
                            ?>
					    </select>
                        </div>

                     


<div class="col-sm-6 mb-3">
					    <label class="form-label">Sub-category</label>
					    <select class="form-select" name="sub_category" id="sub_category" required>
                        <option value="0">Select Category</option>
                        <option value="" required> </option>
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

					  </div>


				<div class="mb-4">
					<label class="form-label">Product description</label>
					<textarea required  pattern="[A-Za-z\s]*" placeholder="Enter Product description" class="form-control" rows="4" name="description"></textarea>
				</div>
 

                
                <div class="mb-4">
					<label class="form-label">Display picture</label>
					<input class="form-control" required type="file" name="singlefileupload" >
				</div>
     


	<!--			<div class="mb-4">
					<label class="form-label">Multiple Images</label>
					<input class="form-control" type="file" multiple="multiple" name="multiplefileupload[]" >
				</div>-->

				

				<div class="row gx-2">
               
               
                     
				</div> <!-- row.// -->


				<div class="mb-4">
					<label class="form-label">Price</label>
					<div class="row gx-2">
						<div class="col-4">
						    <input placeholder="Price" min="1" required type="number" class="form-control" name="price">
					  	</div>
						
					</div> <!-- row.// -->
				</div>
                <div class="mb-4">
					<label class="form-label">Replaceable</label>
					<div class="row gx-2">
						<div class="col-4">
						<input type="radio" name="rep" value="1"> Yes  
                        <input type="radio" name="rep" value="0"> No 
                    </div>
						
					</div> <!-- row.// -->
				</div>
                <div class="mb-4">
					<label class="form-label">Customizable</label>
					<div class="row gx-2">
						<div class="col-4">
						<input type="radio" name="cus" value="1"> Yes  
                        <input type="radio" name="cus" value="0"> No 
                    </div>
						
					</div> <!-- row.// -->
				</div>
                <div class="mb-4">

                      <label class="form-label">Value</label>
					<div class="row gx-2">
						<div class="col-4">
						    <input placeholder="Value" min="1" type="number" class="form-control" name="value">
                            <break>
                            <break>
                            &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                            &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                            &nbsp;  &nbsp;  &nbsp;  &nbsp;
                            <label class="form-label">Unit of Measurement</label>
                            <select class="form-select" name="unit_of_measurement" id="unit_of_measurement">
                        <option value="NULL">Select Unit of measurement</option>
                        <option value="grams">grams </option>
                        <option value="kilograms">kilograms </option>
                        <option value="ml">ML </option>
                        <option value="pair">pair </option>
                        <option value="set">set </option>
                        <option value="piece">piece </option>
					    </select>
                        <!-- <input value="" placeholder="unit of measurement" type="text" class="form-control" name="unit_of_measurement">
                             -->
					  	</div>
						

					
					<div class="row gx-2">
						
					
					
					</div>  &nbsp;  &nbsp;
                    &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                    &nbsp;  &nbsp;
                    
                    <label class="form-label">Quantity in hand</label>
					<div class="row gx-2">
						<div class="col-4">
						    <input value=" "  min="1" placeholder="quantity_in_hand" type="number" class="form-control" name="quantity_in_hand">
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
				<button onlclick="my()" style="background-color: #d33b33;" class="btn btn-primary" name="submit"><b>Submit Item</b></button>

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