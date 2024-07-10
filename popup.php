<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- Site Icons -->
  <link rel="shortcut icon" href="Logo.jpg" type="image/x-icon">
    <link rel="apple-touch-icon" href="Logo.jpg">

<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>



</head>
<body>

    <!--Trigger/Open The Modal -->
    

    <!-- The Modal -->
    <div id="myModal" class="modal">

    <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1> For adding the product to the cart you need to Login/Signup </h1>  
            <p> <a href="login.php" style="color:black; font-weight:bold;">Login</a> &nbsp &nbsp   <a href="Registration.php" style="color:black; font-weight:bold;">Signup</a> </p>

    
        </div>

    </div>
    <!--<button id="myBtn" onclick="showModal()">Open Modal</button>-->


    <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function showModal() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>