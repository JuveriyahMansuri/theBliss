<?php

//Including Database configuration file.

include "con12.php";

//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {

//Search box value assigning to $Name variable.

   $Name = $_POST['search'];

//Search query.

   $Query = "SELECT * FROM product WHERE name LIKE '%$Name%' ";

//Query execution

   $ExecQuery = MySQLi_query($conn, $Query);

//Creating unordered list to display result.

   echo '

<ul style="background-color:white">

   ';
?>
<table style="background-color:white" class="table dataTable my-0" id="dataTable">
<tr align="center">
    <th></th>
<th>product id</th>
                                                         <th>product name</th>
                                                         <th>description</th>
                                                         <th>price</th>
                                                          <th>quantity on hand</th> 
</tr>
<?php 
   //Fetching result from database.

   while ($Result = MySQLi_fetch_array($ExecQuery)) {

       ?>

   <!-- Creating unordered list items.

        Calling javascript function named as "fill" found in "script.js" file.

        By passing fetched result as parameter. -->
<ul >

   <li onclick='fill("<?php echo $Result['name']; ?>")'>

  

   <!-- Assigning searched result in "Search box" in "search.php" file. -->
<tr align="center">
<td><img height="100px" width="100px" src="/Login/image/Project_images/<?php echo $Result['display_picture']; ?>">   </td>
      <td> <?php echo $Result['product_id']; ?>  </td>
      <td><?php echo $Result['name']; ?>  </td>
      <td>  <?php echo $Result['description']; ?>   </td>
      <td> ₹ <?php echo $Result['price']; ?>  </td>
      <!-- <td> <?php //echo $Result['value']; ?>  </td> -->
      <td>  <?php echo $Result['quantity_in_hand']; ?>   </td>
   </tr>
   </li>
 
   </ul>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->

   <?php

}
?>
  </table>
<?php
}


?>

</ul>