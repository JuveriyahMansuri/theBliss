<div class="bg-white" id="sidebar-wrapper" style="">

        
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase ">
            <a class="navbar-brand" href="index.php">
    <img src="The Bliss.png" alt="The Bliss" style="width:100px;" class="rounded-pill"> 
  </a> </div>
            <div class="list-group list-group-flush my-3" >
              <!--  <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a> -->
               
                    <!--    <select class="form-control" id="user_type-dropdown">
                <option value="">Please Select Option</option>
                <?php 
        include 'con12.php';
        $query = mysqli_query($con,"SELECT * FROM User_type");
        $rowcount=mysqli_num_rows($query);
        ?>
                <?php
                for($i=1;$i<=$rowcount;$i++)
                {
                    $row=mysqli_fetch_array($query);
                
                ?>
                
                <option value="<?php echo $row["user_type"]?>"><?php echo $row["user_type"]?>
                    </option>
                    <?php
               }
               ?>
            </select> -->
                        

                    </a>



                      <div class="dropdown">  <a href="#" style="color:black;" class="list-group-item list-group-item-action  fw-bold"><i
                        class="fas fa-project-diagram me-2" >Users </i> 
        <div class="dropdown-content"><a href="vendor.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Vendor</a> 
                        <a href="customer.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Customer</a> 
                       <a href="delivery_person.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Delivery Person</a> 
                       </div>
                      </a>
            </div>
            <div class="dropdown">  <a href="#" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
            style="color:black;"  class="fas fa-project-diagram me-2" >Product Category </i> 
        <div class="dropdown-content"><a href="view_main_category.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Main Category</a> 
                        <a href="edit_p_cat.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Sub Category</a> 
                       </div>
                      </a>
            </div>
            
                        <a href="product.php" style="color:black;" class="list-group-item list-group-item-action fw-bold"><i style="color:black;"
                        class="fas fa-paperclip me-2"></i>  Products</a>
                        <a href="membership.php" style="color:black;" class="list-group-item list-group-item-action  fw-bold"><i
                        class="fas fa-paperclip me-2"></i>  Membership</a>
                        <a href="order.php" style="color:black;" class="list-group-item list-group-item-action fw-bold"><i
                        class="fas fa-shopping-cart me-2"></i>Orders</a>

            <div class="dropdown">  
        <div class="dropdown-content"> 
                          </div>
                        <a href="customized_order.php" style="color:black;" class="list-group-item list-group-item-action  fw-bold"><i
                        class="fas fa-gift me-2"></i>Customized Orders</a>
                       
                       
                      </a>
            </div>
                        <div class="dropdown">  <a href="#" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2" >Events </i> 
        <div class="dropdown-content"><a href="view_event_type.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">View Event Type</a> 
                        <a href="event.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">View Event Bookings</a> 
                       </div>
                      </a>
            </div>
                    </a>

                        <a href="feedback.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Feedback</a>
                        <a href="rating.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Rating</a>
                        <a href="report.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Reports</a>
                <a href="/Login/logout.php" style="color:black;" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="return confirm('Are you sure you want to Log Out?')"><i
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
  padding: 12px 19px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>