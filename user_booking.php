<?php 
//Session Start
if(!isset($_SESSION)){
    session_start();
}
error_reporting(0);//Remove warning messages
if(@$_SESSION['userid']!=''){// session value filtering
  
}else{
header("Location:index.php");// redirect option
}
require_once("connect.php");// database connect
$query ="SELECT * FROM master_inventory where user_id=$_SESSION[userid] order by id desc";// collect an inventorry info
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
<h2 style="text-align: center;">Your Bookings</h2>
<div class="inner-form">

    <table style="width: 100%;">
        <thead style="color: azure;">
            <th>Refno</th>
            <th>Location Name</th>
            <th>Location Address</th>
            <th>Contact</th>
            <th>Reg No</th>
            <th>Car Color</th>
            <th>Reserve Time</th>
            <th>Amount per hour</th>
            <th>Action</th>
        </thead>
        <tbody style="text-align: center;">
            <?php while($rs=mysqli_fetch_assoc($result)){ 
              $query ="SELECT * FROM master_parking where id=$rs[master_parking_id] limit 1";
              $rr =mysqli_fetch_assoc(mysqli_query($con,$query));
                ?>
                <form action="booking_cancel.php" method="post">
            <tr>
                <td><?php echo $rs['ref_no']?></td>
                <td><?php echo $rr['location_name']?></td>
                <td><?php echo $rr['location_address']?></td>
                <td><?php echo $rr['mobile_no']?></td>
                <td><?php echo $rr['car_reg']?></td>
                <td><?php echo $rr['car_color']?></td>
                <td><?php echo $rs['from_date']?></td>
                <td><?php echo $rr['amount']?></td>
                <td>
                  <?php if($rs['status']==0){?>
                  <button>Cancel</button></td>
                <?php }else{ ?>
                  Order Completed.
                <?php } ?>
            </tr>
                <input type="hidden" name="parking_id" value="<?php echo $rs['id']?>">
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
$(document).ready(function(){
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