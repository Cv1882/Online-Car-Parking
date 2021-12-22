<?php
require_once("connect.php");
//auto populate event
if(!empty($_POST["keyword"])) {
echo '<ul id="country-list">';
$query ="SELECT * FROM master_table WHERE (city_name like '" . $_POST["keyword"] . "%' or location_name like '".$_POST["keyword"]."%') LIMIT 0,6";
$result =mysqli_query($con,$query);
while($country=mysqli_fetch_assoc($result)) {
?>
<?php
//foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["location_name"]; ?>,<?php echo $country["city_name"]; ?>');"><?php echo $country["location_name"]; ?>,<?php echo $country["city_name"]; ?></li>
<?php } ?>
</ul>
<?php }  ?>