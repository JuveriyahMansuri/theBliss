<?php
require_once "con12.php";
$state_id = $_POST["state_id"];
echo($state_id);
$result = mysqli_query($con,"SELECT * FROM City where state_id = $state_id");
?>
<option value="">Select City</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["city_id"];?>"><?php echo $row["city_name"];?></option>
<?php
}
?>