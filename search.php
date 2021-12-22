<?php 
//search page remove warning
error_reporting(0);
if(!isset($_SESSION)){
    session_start();
}
if(@$_SESSION['userid']!=''){
  
}else{
header("Location:index.php");
}
require_once("connect.php");//db connect
$post=$_GET;
$br=explode(',',$post['search']);
 $query ="SELECT * FROM master_parking as a inner join master_parking_sub_location as b on a.id=b.master_parking_id inner join master_table as c on c.id=b.master_table_id  where c.location_name='".$br[0]."' group by b.master_parking_id order by distance ASC";
$result =mysqli_query($con,$query);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Car Parking</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
</head>

<body>
<section class="container">
<header>
<section class="logo">
<p style="text-align: center;">ONLINE CAR PARKING RESERVATION SYSTEM</p>
</section>
    <div class="topnav">
        <a href="index.php">Dashboard</a>
        <!-- <a href="index.php">Online Booking</a>  -->
        <a href="user_booking.php">Bookings</a>       
        <a href="parking_zones.php">Parking Zones</a>       
        <a href="adminpanel/">AdminPanel</a>       
        <a href="log-out.php">Log Out</a>
    </div>   
</header>
<h2 style="text-align: center;">You can search the availability</h2>
<form action="search.php" method="post">
  <div class="inner-form">
    <div class="input-field first-wrap">
    <div class="icon-wrap">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
    </svg>
    </div>
    <input id="search" type="text" name="search" value="<?php echo $post['search']?>" placeholder="Where are you looking for?">
    </div>
    <div class="input-field second-wrap">
    <div class="icon-wrap">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
    </svg>
    </div>
    <input class="datepicker flatpickr-input" name="from_picker" value="<?php echo $post['from_picker']?>" id="depart" type="text"   readonly="readonly">
    </div>

    <div class="input-field fifth-wrap">
    <button class="btn-search" type="">SEARCH</button>
    </div>
  </div>
</form>
<h2 style="text-align: center;">See the Nearest Parking Locations </h2>
<div class="inner-form">

    <table style="width: 100%;">
        <thead style="color: azure;">
            <th>Location name</th>
            <th>Location Address</th>
            <th>Distance(Km)</th>
            <th>Available Slots</th>
            <th>Amount per hour</th>
            <th>Action</th>
        </thead>
        <tbody style="text-align: center;">
            <?php while($rs=mysqli_fetch_assoc($result)){ 
                $query ="SELECT count(*) as cnt FROM master_inventory where master_sub_parking_id=$rs[master_table_id] and status='0'";
                $rr =mysqli_fetch_assoc(mysqli_query($con,$query));
                $slot=$rs['no_of_slots']-$rr['cnt'];
                if($slot>0){
                ?>
                <form action="booking.php" method="post">
            <tr>
                <td><?php echo $rs['location_name']?></td>
                <td><?php echo $rs['location_address']?></td>
                <td><?php echo $rs['distance']?></td>
                <td><?php echo $rs['no_of_slots']-$rr['cnt']?></td>
                <td><?php echo $rs['amount']?></td>
                <td><button>Reserve</button></td>
            </tr>
                <input type="hidden" name="parking_id" value="<?php echo $rs['master_parking_id']?>">
                <input type="hidden" name="table_id" value="<?php echo $rs['master_table_id']?>">
                <input type="hidden" name="subtable_id" value="<?php echo $rs['master_table_id']?>">
                <input type="hidden" name="search" value="<?php echo $post['search']?>">
                <input type="hidden" name="from_picker" value="<?php echo $post['from_picker']?>">
                </form>
            <?php }} ?>
        </tbody>
    </table>
</div>


</section>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
      flatpickr(".datepicker",
      {
    enableTime: true,
    dateFormat: "d-m-Y H:i",
});

    </script>
</body>

</html>