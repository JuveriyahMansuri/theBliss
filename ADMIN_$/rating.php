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
    $record=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM rating;"));

     $pagi=ceil($record/$per_page);
 //ends here

    $sql=mysqli_query($conn,"SELECT DISTINCT p.product_id,p.name FROM rating r INNER JOIN product p ON p.product_id=r.product_id LIMIT $start,$per_page;");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Rating</title>
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Rating</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br><table class="table dataTable my-0" id="dataTable">
                             <thead>
                                 <th>Product Id</th>
                                
                                 <th>Product Name</th>
                                 <th>Ratings</th>
</thead>      
  <?php 
  
  while($r1=mysqli_fetch_array($sql))
  {?>
  <tr>
<?php 
      $p=$r1['product_id'];
      ?>
      <td><?php echo $p;?></td>
      <td><?php echo $r1['name'];?></td>
      <?php
      $stars=0;
      $s5=mysqli_query($conn,"SELECT * FROM rating WHERE product_id=$p");
      while($r2=mysqli_fetch_array($s5))
      {
          $stars=$stars+$r2['rating'];
      }
      $stars=floor($stars/5);
  ?>
  <td>
      <?php
      for($i=1;$i<=$stars;$i++)
      {
      ?>
      <span style="color:orange;">&#9733;</span>

      <?php 
      }

      ?>
       <?php
       $rem=5-$stars;
      for($i=1;$i<=$rem;$i++)
      {
      ?>
      <span style="border-color:black;">&#9733;</span>

      <?php 
      }
      
      ?>
  </td>
    </tr>
<?php } ?>
  

                           
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
