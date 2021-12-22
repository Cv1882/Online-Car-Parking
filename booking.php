<?php 
if(!isset($_SESSION)){
    session_start();
}
if(@$_SESSION['userid']!=''){
  
}else{
header("Location:index.php");
}
require_once("connect.php");
$post=$_POST;
$query ="SELECT * FROM master_parking as a inner join master_parking_sub_location as b on a.id=b.master_parking_id inner join master_table as c on c.id=b.master_table_id  where c.id='".$post['subtable_id']."' group by b.master_parking_id order by distance ASC";//checking booking sql
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
<h2 style="text-align: center;">Your can search the availability</h2>
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
<h2 style="text-align: center;">Reconfirm your Slot</h2>
<div class="inner-form">
    <table style="width: 100%;">
        <tbody style="text-align: center;">
            <?php while($rs=mysqli_fetch_assoc($result)){ ?>
                <form action="confirm.php" method="post">
            <tr>
                <th>Location name</th>
                <td><?php echo $rs['location_name']?></td>
              </tr>
              <tr>
                
                <th>Location Address</th>
                <td><?php echo $rs['location_address']?></td>
              </tr>
              <tr>
                
                <th>Distance(Km)</th>
                <td><?php echo $rs['distance']?></td>
              </tr>
              <tr>
                <th>Amount per hour</th>
                <td><?php echo $rs['amount']?></td>
              </tr>
              <tr>
                <th>Reservation Time</th>
                <td><?php echo $post['from_picker']?></td>
              </tr>
              <tr >
                <td align="center" colspan="2"><button>Reserve</button></td>
              </tr>
            </tr>
                <input type="hidden" name="parking_id" value="<?php echo $rs['master_parking_id']?>">
                <input type="hidden" name="table_id" value="<?php echo $rs['master_table_id']?>">
                <input type="hidden" name="subtable_id" value="<?php echo $rs['master_table_id']?>">
                <input type="hidden" name="search" value="<?php echo $post['search']?>">
                <input type="hidden" name="from_picker" value="<?php echo $post['from_picker']?>">
                <input type="hidden" name="final_amount" value="<?php echo $rs['amount']?>">
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

</html>