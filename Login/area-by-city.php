<?php
require_once "con12.php";
$city_id = $_POST["city_id"];
$result = mysqli_query($con,"SELECT * FROM Area where city_id = $city_id");
?>
<option value="">Select Area</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["pincode"];?>"><?php echo $row["area_name"];?></option>
<?php
}
?>