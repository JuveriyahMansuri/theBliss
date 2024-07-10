<?php
session_start();
include 'con12.php';

$username=$_SESSION['username'];


// $sql=mysqli_query($conn,"SELECT fi.feedback_image,f.feedback_id,f.feedback,f.feedback_date,p.name,u.user_name FROM feedback f INNER JOIN feedback_image fi ON f.feedback_id=fi.feedback_image_id INNER JOIN product p ON p.product_id=f.product_id INNER JOIN  user u ON f.customer_id=u.user_id WHERE p.vendor_id=(SELECT user_id FROM user WHERE user_name='$username');");
$sql=mysqli_query($conn,"SELECT f.feedback_id,f.feedback,f.feedback_date,p.name,u.user_name FROM feedback f INNER JOIN product p ON p.product_id=f.product_id INNER JOIN  user u ON f.customer_id=u.user_id WHERE p.vendor_id=(SELECT user_id FROM user WHERE user_name='$username');");
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
    <title>Feedback</title>
     <!-- Site Icons -->
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Feedback</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                <!--div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div-->
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br><table class="table dataTable my-0" id="dataTable" >
                                    <thead>
                                        <tr align="center">
                                        
                                            <th >Feedback Id</th>
                                            <th> Feedback</th>
                                            <th>Feedback Date</th>
                                            <th>Product Name</th>
                                            
                                            <th>Customer Name</th>
                                           <th>feedback Image</th>
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
  
 // the below code is to display database records 
    while($rows=mysqli_fetch_array($sql)){ 
         $fi=$rows['feedback_id'];
        ?>
        <tr>
          
       <td align="center"min="1" required><?php echo $rows['feedback_id']; ?></td>
     
        <td align="center"pattern="[A-Za-z\s]*" required ><?php echo $rows['feedback']; ?></td>

        <td align="center"type="date" format='dd-mm-yyyy'<?php echo $rows['feedback_date']; ?></td>

        <td align="center" pattern="[A-Za-z\s]*" required style= "text-transform:capitalize;"><?php echo $rows['name']; ?></td>
      
        <td align="center" pattern="[A-Za-z\s]*" required style= "text-transform:capitalize;"><?php echo $rows['user_name']; ?></td>
       <td align="center"></td>

       <tr style="border-spacing: 0px;">
         <?php 
         include 'con12.php';
        $q5="SELECT * FROM feedback_image WHERE feedback_id=$fi";
        $sql5=mysqli_query($conn,$q5);
        while($r5=mysqli_fetch_array($sql5))
        {
        ?> 
        
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td><img style="height:75px; width:75px;" src="image/Project_images/<?php echo $r5['feedback_image'];?>" /></td>

    
    <?php } ?> 
    </tr>
    </tr>
        
        <?php } ?>
  

  

                              
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
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    
</body>

</html>
<?php connection_aborted(); ?>