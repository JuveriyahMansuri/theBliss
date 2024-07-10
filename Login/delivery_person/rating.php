<?php
require('con12.php');
require('function.php');

//if(isset($_POST['submit']))
//{
	//$username=get_safe_value($con,$_POST['username']);
	//$password=get_safe_value($con,$_POST['password']);
	//$sql=mysqli_query('select * from product_category');
    //$result=mysqli_query($conn,$sql);
    $sql=mysqli_query($conn,"SELECT r.rating_id,r.rating AS stars,p.name,u.user_name FROM rating r INNER JOIN user u ON u.user_id=r.user_id INNER JOIN product p ON p.product_id=r.product_id;");
//	$res=mysqli_query($con,$sql);
//	$count=mysqli_num_rows($res);
/*	if($count>0){
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']='$username';
		header('location:product.php');
		die();
		
	}else{
		"Please enter correct login details";
	}
		
}*/
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
    <title>Admin Dashboard</title>

   

</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->

         <?php include 'menu.php'; ?>
               <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
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
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="5" selected="">5</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                                    
                                  </div>
                               
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br><table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr align="center">
                                        
                                            <th >Rating Id</th>
                                            <th>Stars</th>
                                            
                                            <th>Customer Name</th>
                                            
                                            <th>Product Name</th>
                                           
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                   
  <?php
 // the below code is to display database records 
 while($rows=mysqli_fetch_array($sql))
 { ?> 
       <td align="center"><?php echo $rows['rating_id']; ?></td>
       <td align="center">  <?php for($i=1;$i<=$rows['stars'];$i++)
       { ?>

<span style="color:orange;">&#9733;</span>



     <?php  }?> 
     </td>

    

        <td align="center"><?php echo $rows['user_name']; ?></td>

        <td align="center"><?php echo $rows['name']; ?></td>
      
        

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
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
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