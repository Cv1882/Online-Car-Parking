<?php 
//Booking cancellation
if(!isset($_SESSION)){
    session_start();
}
error_reporting(0);
if(@$_SESSION['userid']!=''){
  
}else{
header("Location:index.php");
}
require_once("connect.php");
$query ="update master_inventory set status='1' where id=$_POST[parking_id]";
$result =mysqli_query($con,$query);

echo "Your Booking Cancelled."
?>
<a href="/vizag">Go Home</a>