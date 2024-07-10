<?php 
//session_start();
?>
<div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
            <a class="navbar-brand" href="index.php">
    <img src="The Bliss.png" alt="The Bliss" style="width:80px;" class="rounded-pill"> 
  </a> </div>
            <div class="list-group list-group-flush my-3">
              
                        <!-- <a href="profile.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-gift me-2"></i>Profile</a> -->
                        <!-- <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-gift me-2"></i>Notifications</a> -->
                        <a href="order.php" style="color:black;" class="list-group-item list-group-item-action fw-bold"><i
                        class="fas fa-chart-line me-2"></i>Delivery</a>
                          <a style="color:black;" href="status_of_delivery.php" class="list-group-item list-group-item-action  fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Status of order</a>  
                        <!-- <a href="rating.php" class="list-group-item list-group-item-action  fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Reviews</a> -->
                        <div class="dropdown">  
                          <!-- <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"> 
                           <i class="fas fa-project-diagram me-2" >Earnings</i> 
                            <div class="dropdown-content">
                             <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Daily Earnings</a> 
                             <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Monthly Earnings</a> 
                     
                       </div>
                      </a> -->
            </div>
            <a href="/Login/logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="return confirm('Are you sure you want to Log Out?')"><i
                        class="fas fa-power-off me-2"></i>Logout</a>

            </div>
        </div>

        <style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>