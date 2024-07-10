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
    $record=mysqli_num_rows(mysqli_query($conn,"SELECT user_id FROM user WHERE user_type_id=2;"));

     $pagi=ceil($record/$per_page);
 //ends here

     $sql=mysqli_query($conn,"SELECT u.u_status,u.user_id_proof_type,u.user_id,u.display_picture,u.user_name,u.user_id_proof,u.email_address,u.mobile,u.addr,v.category_name,m.membership_type,u.membership_start_date,u.skill_certificate,a.area_name FROM user AS u INNER JOIN area AS a ON u.area_pincode=a.pincode INNER JOIN membership AS m ON u.membership_id=m.membership_id INNER JOIN vendor_category AS v ON v.vendor_category_id=u.vendor_category_id WHERE u.user_type_id=2 LIMIT $start,$per_page;");


?>

<!DOCTYPE html>
<html lang="en">

<head>

<script src="jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>Vendor</title>
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
               
                   
                    <div class="card shadow">
                        <div class="card-header py-3">
                           <center> <p class="text-primary m-0 font-weight-bold"><h3>Vendor</h3></p> </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                    
                                  </div>
                               
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter">
                                        <form method="post">
                                        
                                       
<div id="result">
</div>
                                    </label>
</form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <br> <br><table style="width:100px" class="table dataTable my-0" id="dataTable">
                                    <thead style= "text-transform:capitalize;">
                                        <tr align="center">
                                        <th></th>
                                            <th >Vendor Id</th>
                                            <th> Vendor name</th>
                                            <th>Vendor (Type)category</th>
                                           
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>Area</th>
                                            <th>Mobile number</th>
                                            <th>Email address</th>
                                            <th>Membership type</th>
                                            <th>Membership start date</th>
                                            <th>ID proof Type</th>
                                            <th>ID proof Number</th>
                                            <th>Skill certificate</th>
                                            <th></th>
                                            <th> </th>
                                            <th></th>
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
  
          // below code is to display database records
    while($rows=mysqli_fetch_array($sql))
    { ?>
        <tr>
            <?php if( $rows['display_picture'] ==NULL) 
            {  
            
               ?> <td align="center">   </td>
          <?php  }
            else
            { ?>
                <td align="center"><img class="rounded-circle mr-2" width="60" height="60" src="/Login/image/user/<?php echo $rows['display_picture']; ?>"></td>
        
           <?php }
            ?>
       <td align="center" required min="1"><?php echo $rows['user_id']; ?></td>
     
        <td align="center" required   style= "text-transform:capitalize;"><?php echo $rows['user_name']; ?></td>
        <td align="center" required   style="text-transform:capitalize;"><?php echo $rows['category_name']; ?></td>
        

        <td align="center" style="width:500px" required style= "text-transform:capitalize;"><?php echo $rows['addr']; ?></td>
        <td align="center" required   style= "text-transform:capitalize;"><?php echo $rows['area_name']; ?></td>

        <td align="center" required pattern="[0-9]{10}"><?php echo $rows['mobile']; ?></td>
        <td align="center" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><?php echo $rows['email_address']; ?></td>
       
        <td align="center" required pattern="[A-Za-z\s]*" style= "text-transform:capitalize;"><?php echo $rows['membership_type']; ?></td>
        <td align="center" ><?php $d_date = date("d-m-Y", strtotime($rows['membership_start_date'])); echo $d_date ;?></td>
        <td align="center"><?php echo $rows['user_id_proof_type']; ?></td>
        <td align="center"><?php echo $rows['user_id_proof']; ?></td>
        <td align="center"><img style="height:80px;width:80px" required src="/Login/image/user/<?php echo $rows['skill_certificate']; ?>" /></td>
      
        <td align="center" > <a href='edit_vendor.php?vid=<?php echo $rows['user_id']; ?>' style="background-color:grey;" class="btn btn-primary"> &#9999; </a></td>
        <td>
        <form method="post">
            

<?php if($rows['u_status']==0)
  {  ?>    
<center>  <a href = 'vendor.php?action=delete&ps=1&ui=<?php echo $rows["user_id"];  ?>' style="background-color:grey;" class="btn btn-primary" onclick="return confirm('Are you sure you want to active?')">ACTIVE   </a></center>

<?php }
else
{?>

 <center>  <a href = 'vendor.php?action=delete&ps=0&ui=<?php echo $rows["user_id"];  ?>' style="background-color:grey;" class="btn btn-primary" onclick="return confirm('Are you sure you want to inactive?')">INACTIVE   </a></center>
<?php } ?>
</form>
</td>
       

        </tr>
        <?php } ?>
  

        <?php
if(isset($_GET['action']) && $_GET['action']=="delete") 
{
    include 'con12.php';
    $ps=$_GET['ps'];
    $ui=$_GET['ui'];
     $query=mysqli_query($conn,"UPDATE user SET u_status=$ps WHERE user_id=$ui");   
}
?>

                           
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                       </div>
                                <div class="col-md-6">
                                     <nav  class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination" >
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

    
</body>

</html>
<?php connection_aborted(); ?>