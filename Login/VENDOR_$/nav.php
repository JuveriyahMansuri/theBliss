<?php 
require("con12.php");

$username=$_SESSION['username'];

$nav_q="SELECT display_picture FROM user WHERE user_name='$username'";
$nav_sql=mysqli_query($conn,$nav_q);

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
                       
                <ul  class="navbar-nav ms-auto mb-2 mb-lg-0" height="20px" width="20px"  style="background-color:#d33b33;">
               
                        <li style="color:white;" height="20px" width="20px">
                        
                        <a height="20px" width="20px" href="/Login/login.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="return confirm('Are you sure you want to Log Out?')">
                            <?php while($rows=mysqli_fetch_array($nav_sql))
                            {?>
                                     
                                      <img class="rounded-circle mr-2" src="/Login/image/user/<?php echo $rows['display_picture'];?>" style="width:30px;height:30px"/>
                            <?php } ?>
                            <i  height="20px" width="20px" style="color:white;"><?php echo $username;?></i>
                            
                        </a>
                           
                        </li>
                    </ul>
                </div>
            </nav>
                            