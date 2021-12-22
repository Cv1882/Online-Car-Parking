<?php 
if(!isset($_SESSION)){
    session_start();
}
//remove warning message from page
error_reporting(0);
if(@$_SESSION['userid']!=''){
  
}else{
header("Location:index.php");
}
require_once("connect.php");
$query ="SELECT * FROM master_parking order by id desc";
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
<h2 style="text-align: center;">Parking Zones</h2>
<div class="inner-form">

    <table style="width: 100%;">
        <thead style="color: azure;">
            <th>Location Name</th>
            <th>Location Address</th>
            <th>No Of Slots</th>
            <th>Avilable Slots</th>
            <th>Contact</th>
            <th>Amount per hour</th>
        </thead>
        <tbody style="text-align: center;">
            <?php while($rs=mysqli_fetch_assoc($result)){ 
              $query ="SELECT count(*) as cnt FROM master_inventory where master_sub_parking_id=$rs[id] and status='0'";
                $rr =mysqli_fetch_assoc(mysqli_query($con,$query));
                $slot=$rs['no_of_slots']-$rr['cnt'];
                ?>
                <form action="booking_cancel.php" method="post">
            <tr>
                <td><?php echo $rs['location_name']?></td>
                <td><?php echo $rs['location_address']?></td>
                <td><?php echo $rs['no_of_slots']?></td>
                <td><?php echo $slot?></td>
                <td><?php echo $rs['mobile_no']?></td>
                <td><?php echo $rs['amount']?></td>
            </tr>
                </form>
            <?php } ?>
        </tbody>
    </table>
</div>
</section>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(document).ready(function(){  // auto populate to auto suggest the user to navigate
  $("#search").keyup(function(){
    $.ajax({
    type: "POST",
    url: "readCountry.php",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
      $("#search").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    },
    success: function(data){
      $("#suggesstion-box").show();
      $("#suggesstion-box").html(data);
      $("#search").css("background","#FFF");
    }
    });
  });
});

function selectCountry(val) {
$("#search").val(val);
$("#suggesstion-box").hide();
}
</script>
<script>
      flatpickr(".datepicker",
      {
    enableTime: true,
    dateFormat: "d-m-Y H:i",
});

    </script>
</body>
<?php $_SESSION['refreh']+=1;?>
</html>