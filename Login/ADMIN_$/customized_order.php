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
    $record=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM customized_order;"));

     $pagi=ceil($record/$per_page);
 //ends here



    $sql=mysqli_query($conn,"SELECT c.image,p.vendor_id,c.value,c.unit_of_measurement,c.c_date,c.customized_details,c.customized_id,p.name,u.user_name,c.approval,c.amount AS bill FROM customized_order c INNER JOIN user u ON c.customer_id=u.user_id INNER JOIN product p ON p.product_id=c.product_id ORDER BY c_date DESC LIMIT $start,$per_page;");

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
    <title>Customized Orders</title>
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
                        <center> <p class="text-primary m-0 font-weight-bold"><h3>Customized Orders</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br><table class="table dataTable my-0" id="dataTable">
                                    <thead style= "text-transform:capitalize;">
                                        <tr align="center" width="200%">
                                        <th>Customized Image</th>
                                            <th >Customized Id</th>
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th > Customized&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Details&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                         <th>Unit of measurement</th>
                                            <th>&nbsp;&nbsp;&nbsp;Total Bill</th>
                                            <th>Product Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>Vendor Id</th>
                                            <th>Customer Name</th>
                                            <th>Approval</th>
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
  
 // the below code is to display database records 
    while($rows=mysqli_fetch_array($sql)){ ?>
        <tr>
            <?php if( $rows['image'] == NULL) 
            { 
            
               ?> <td align="center">   </td>
          <?php  }
            else
            {  ?>
                <td align="center"><img class="rounded-circle mr-2" width="60" height="60" src="/Login/image/custom_order/<?php echo $rows['image']; ?>"></td>
        
           <?php }
            ?>
       <td align="center" required min="1"><?php echo $rows['customized_id']; ?></td>
       <td align="center"> <?php $d_date = date("d-m-Y", strtotime($rows['c_date'])); echo $d_date ;?></td>
        <td align="center" required pattern="[A-Za-z\s]*"><?php echo $rows['customized_details']; ?></td>

        <td align="center" required pattern="[A-Za-z\s]*"><?php echo $rows['value'],$rows['unit_of_measurement']; ?></td>

       
        
       
        <?php if($rows['bill']==null)
        {?>
        <td></td>
        <?php }
        else { ?>

<td align="center">₹ <?php echo $rows['bill']; ?></td>
<?php } ?>
        <td align="center"  style= "text-transform:lowercase;"><?php echo $rows['name']; ?></td>
        <td align="center"  style= "text-transform:lowercase;"><?php echo $rows['vendor_id']; ?></td>
        
        <td align="center"  style= "text-transform:capitalize;"><?php echo $rows['user_name']; ?></td>
        <?php if( $rows['approval'] =="accepted") 
            {  
            
               ?> <td align="center"> <button style="background: green;border-radius: 25px; font-weight : bold;  color:white;"><?php echo $rows['approval']; ?> </button></td>
          <?php  } ?>
          <?php if( $rows['approval'] =="rejected") 
            {  
            
               ?> <td align="center"> <button style="background: #c00;border-radius: 25px;"><?php echo $rows['approval']; ?> </button></td>
          <?php  } ?>
          <?php if( $rows['approval'] =="pending") 
            {  
            
               ?> <td align="center"> <button style="background:yellow;border-radius: 25px;"><?php echo $rows['approval']; ?> </button></td>
          <?php  } ?>
          <?php if( $rows['approval'] =="cancelled") 
            {  
            
               ?> <td align="center" style="background:red;border-radius: 25px;"><?php echo $rows['approval']; ?></td>
          <?php  } ?>
        </tr>
        <?php } ?>
  

  

                               <!--         <tr>
                                            <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/avatars/avatar1.jpeg">Airi Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                            <td>2008/11/28</td>
                                            <td>$162,700</td>
                                        </tr>
    -->
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
