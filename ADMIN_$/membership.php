<?php
session_start();
include 'con12.php';

 



    $sql=mysqli_query($conn,"SELECT * FROM membership ;");
  

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
        <div id="page-content-wrapper" style="background-color:grey;">
          <?php include 'nav.php'; ?>
<!-- this is the main content place holder -->
            <div class="container-fluid px-4">
                <!-- write code from here -->
              
                    
                    <div class="card shadow">
                        <div class="card-header py-3">
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Membership</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <!-- <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="5" selected="">5</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                     -->
                                  </div>
                               
                                
                                
  
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br><table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr align="center">
                                            <th>        </th>
                                            <th>     Add Membership Type :   </th>
                                             <th>      <center> <a href='add_membership.php'style="background-color:grey; " class="btn btn-primary">&#43; </a></center>  </th> 
                                            <th>    </th>
                                            <th>  </th>

                                        
</tr>
<!-- <tr align="center">
                                            <th>        </th>
                                            <th>     Add Sub-Category :   </th>
                                            <th>      <center> <a href='add_sp_cat.php' class="btn btn-primary">ADD </a></center>  </th>
                                            <th>    </th>
                                            <th>  </th>

                                        
</tr> -->
                                        <tr align="center">
                                        <!-- <th> <center>  <a href = 'membership.php?action=del' class="btn btn-primary" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i>   </a></center></th> -->

                                            <th >Membership Id</th>
                                            <th>Membership Type</th>
                                            <th>Membership Rate</th>
                                            <th>Membership Duration (Days)</th>
                                            <th></th>
                                          <th></th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                   
 <?php  
 
$i=0;

 while($rows=mysqli_fetch_array($sql))
 { ?>
        <tr class="<?php if(isset($classname)) echo $classname; ?>">
        <!-- Checkbox -->
        <!-- <td><input type='checkbox' name='dell[]' value='<?php echo $rows['membership_id']; ?>' ></td>
         -->
        <td align="center" min="1"><?php echo $rows['membership_id']; ?></td>
            
        <td align="center" required pattern="[0-9]{10}" style="text-transform:capitalize;"><?php echo $rows['membership_type']; ?></td>
        <td align="center" required pattern="[0-9]{10}" style="text-transform:capitalize;"><?php echo $rows['membership_rate']; ?></td>
      
        <td align="center" required pattern="[0-9]{10}" style="text-transform:capitalize;"><?php echo $rows['membership_duration']; ?></td>
      
        
      <td> <center>  <a href = 'membership.php?action=delete&pc=<?php echo $rows["membership_id"];  ?>'style="background-color:grey; " class="btn btn-primary" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i>   </a></center></td>

        </tr>
        <?php 
         $i++;
    }?>
 
<?php 
include 'con12.php';
if(isset($_GET['action']) && $_GET['action']=="delete")
{
    $query=mysqli_query($conn,"DELETE FROM membership WHERE membership_id='".$_GET['pc']."'");
    
    if($query)
    { ?>
        <div class="alert alert-primary" role="alert" align="center"> MEMBERSHIP DELETED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
         <!-- below code is for auto refresh-->
        <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
 
 <?php   }
    if(!$query)
    {  ?>
        <div class="alert alert-primary" role="alert" align="center">UNSUCCUESSFUL AS RECORD IS REFERRED TO ANOTHER RECORD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
       
  <?php  }
        }

?>

<?php 
include 'con12.php';
if(isset($_GET['action']) && $_GET['action']=="del")
{
    $del=$_POST['dell'];
    foreach($del as $deleteid)
    {
    $query=mysqli_query($conn,"DELETE FROM membership WHERE membership_id=$deleteid");
    }
    if($query)
    { ?>
        <div class="alert alert-primary" role="alert" align="center"> RECORD DELETED SUCCESSFULLY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
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
                                    <!-- <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav> -->
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

