<?php
$username = $_SESSION['username'];
//echo $username;
?>

<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4" >
                <div class="d-flex align-items-center" >
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle" style="color:white;">  </i>
                    <h2 class="fs-2 m-0" style="color:white;">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse show" id="navbarSupportedContent" style="color:white;" align="right">
                    <ul  class="navbar-nav ms-auto mb-2 mb-lg-0" style="background-color:gray;">
                        <li style="color:white;">
                     <?php 


                        ?>
                         <a height="15px" width="15px" href="/Login/login.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="return confirm('Are you sure you want to Log Out?')">
                  
                               <?php 
                               
                               include_once "con12.php";
                               //session_start();
                               $username = $_SESSION['username'];
                               //echo $username;
                               //echo "HELLO";

                               //$username=$_SESSION['user_name'];

                               $nav_q="SELECT * FROM User WHERE user_name = '$username';";
                               $nav_sql=mysqli_query($conn,$nav_q);
                              
                               while($rows=mysqli_fetch_array($nav_sql))
                              { 
                                  if($rows['display_picture']==NULL)
                                  {

                                  }
                                  else
                                  {
                                  ?>
                             <img class="rounded-circle mr-2" style="width:30px;height:30px" src="/Login/image/user/<?php echo $rows['display_picture']; ?>"/>
                                  
                            <?php  } } ?>
                            <i  style="color:white;"><?php echo $username; ?></i>
                            </a>
                           
                        </li>
                    </ul>
                </div>
            </nav>
           