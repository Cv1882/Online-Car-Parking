<?php 
if(!isset($_SESSION)){
    session_start();
}
//checking session is valid
if(@$_SESSION['userid']!=''){
  
}else{
header("Location:index.php");
}
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
  <h1 style="color: #ffe108;
    text-align: center;">ONLINE CAR PARKING SYSTEM</h1>

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
<form action="search.php" method="get">
  <div class="inner-form">
    <div class="input-field first-wrap">
    <div class="icon-wrap">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"> // svg icons
    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
    </svg>  
    </div>
    <input name="search" id="search" type="text" placeholder="Where are you looking for?">
    <div id="suggesstion-box"></div>
    </div>
    <div class="input-field second-wrap">
    <div class="icon-wrap">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
    </svg>
    </div>
    <input name="from_picker" class="datepicker flatpickr-input" id="depart" type="text" value="<?php echo date('d-m-Y h:i')?>" readonly="readonly">
    </div>

    <div class="input-field fifth-wrap">
    <button class="btn-search" type="">SEARCH</button>
    </div>
  </div>
</form>
</section>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(document).ready(function(){  // Checking for the search option to auto populate
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
      }
      );
</script>
</body>

</html>