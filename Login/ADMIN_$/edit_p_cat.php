<?php
session_start();
include 'con12.php';

 
?>



<?php

   //below is for pagination
    $per_page=5;
    $start=0;
    $current_page=1;
    if(isset($_GET['start']))
    {
        $start=$_GET['start'];
        $current_page=$start;
        $start--;
        $start=$start*$per_page;
    }

    $record=mysqli_num_rows(mysqli_query($conn,"SELECT s.product_category_id,s.category_name,p.category_name AS sub FROM product_category AS s LEFT JOIN product_category AS p ON s.sub_category_id=p.product_category_id WHERE s.sub_category_id IS NOT NULL;"));

    $pagi=ceil($record/$per_page);
//ends here


    $sql=mysqli_query($conn,"SELECT s.product_category_id,s.category_name,p.category_name AS sub FROM product_category AS s LEFT JOIN product_category AS p ON s.sub_category_id=p.product_category_id WHERE s.sub_category_id IS NOT NULL LIMIT $start,$per_page;");
  

?>


<!DOCTYPE html>
<html lang="en">

<?php
$page = $_SERVER['PHP_SELF'];
$sec = "2";
?>

<head>
  
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Product Category</title>
     <!-- Site Icons -->
     <link rel="shortcut icon" href="The Bliss.png" type="image/x-icon">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color:gray;">   <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
              
                    
                    <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Sub Product Category</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <!-- <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="5" selected="">5</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                     -->
                                  </div>
                               
                                <!-- <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div> -->
                                
  
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br><table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <!-- <tr align="center">
                                            <th>        </th>
                                            <th>     Add Main-Category :   </th>
                                            <th>      <center> <a href='add_p_cat.php' class="btn btn-primary">ADD </a></center>  </th>
                                            <th>    </th>
                                            <th>  </th>

                                        
</tr> -->
<tr align="center">
                                            <th>        </th>
                                            <th>     Add Sub-Category :   </th>
                                            <th>      <center> <a href='add_sp_cat.php' style="background-color:grey; " class="btn btn-primary">&#43;  </a></center>  </th>
                                            <th>    </th>
                                            <th>  </th>

                                        
</tr>
                                        <tr align="center">
                                            
                                            <th >Product Category Id</th>
                                            <th>Product Category Name</th>
                                            <th>Main Product Category Name</th>
                                          <th></th>
                                          <th>  </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                   
 <?php  
 
$i=0;

 while($rows=mysqli_fetch_array($sql))
 { ?>
        <tr class="<?php if(isset($classname)) echo $classname; ?>">
        <td align="center" min="1"><?php echo $rows['product_category_id']; ?></td>
            
        <td align="center"  pattern="[A-Za-z\s]*" style="text-transform:capitalize;"><?php echo $rows['category_name']; ?></td>
        <td align="center"><?php echo $rows['sub']; ?></td>
        <td> <center> <a  href='update_s.php?pro_cat=<?php echo $rows["product_category_id"]; ?>' onClick="my()" style="background-color:grey; " class="btn btn-primary">&#9999;</a></center>  </td>
      <td> <center>  <a href = 'edit_p_cat.php?action=delete&pc=<?php echo $rows["product_category_id"];  ?>' style="background-color:grey;" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i>   </a></center></td>

        </tr>
        <?php 
         $i++;
    }?>
 <script>
    function my()
    {
        var x=document.getElementById("category_name");
        x.value=x.value.toLowerCase();
    }
</script> 
<?php 
include 'con12.php';
if(isset($_GET['action']) && $_GET['action']=="delete")
{
    $query=mysqli_query($conn,"DELETE FROM product_category WHERE product_category_id='".$_GET['pc']."'");
    
    if($query)
    { ?>
        <div class="alert alert-primary" role="alert" align="center"> CATEGORY DELETED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
         <!-- below code is for auto refresh-->
        <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
 
 <?php   }
    if(!$query)
    {  ?>
        <div class="alert alert-primary" role="alert" align="center">UNSUCCUESSFUL AS RECORD IS REFERRED TO ANOTHER RECORD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
       
  <?php  }
        }

?>

  

                         
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                     </div>
                                <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <!-- <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                             -->
                                             <?php 
                                            
                                             for($i=1;$i<=$pagi;$i++)
                                             {
                                                $class='';
                                                if($current_page==$i)
                                                {
                                                    $class='active';
                                                } 
                                                 ?>
                                            <li class="page-item <?php echo $class; ?>"><a style="background-color:grey; color:white" class="page-link" href="?start=<?php echo $i?>"><?php echo $i?></a></li>
                                            <?php } ?>
                                             <!-- <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                         -->
                                        </ul>
                                    </nav> 
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
<?php connection_aborted(); ?>

