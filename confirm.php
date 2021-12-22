<?php 
if(!isset($_SESSION)){
    session_start();
}
error_reporting(0);
if(@$_SESSION['userid']!=''){
  
}else{
header("Location:index.php");
}
require_once("connect.php");
$post=$_POST;

$query ="SELECT * FROM master_parking as a inner join master_parking_sub_location as b on a.id=b.master_parking_id inner join master_table as c on c.id=b.master_table_id  where c.id='".$post['subtable_id']."' group by b.master_parking_id order by distance ASC";
$result =mysqli_query($con,$query);
if($_SESSION['refreh']==1){
//Inserting record booking inventory
  $id=mysqli_fetch_assoc(mysqli_query($con,"select id from master_inventory order by id desc limit 1"));
  $ids=1000+$id['id']+1;
  $ref="BB_".$ids;
  $query="INSERT INTO master_inventory (master_parking_id,master_sub_parking_id,user_id,from_date,final_amount,status,ref_no) values($post[parking_id],$post[subtable_id],$_SESSION[userid],'".date("Y-m-d h:i:s",strtotime($post['from_picker']))."',$post[final_amount],'0','".$ref."')";  
  mysqli_query($con,$query);
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

<h2 style="text-align: center;">Your Slot Confirmed</h2>
<h5>Your Refernce no : <?php echo $ref;?></h5>
<div class="inner-form">
    <table style="width: 100%;">
        <tbody style="text-align: center;">
            <?php while($rs=mysqli_fetch_assoc($result)){ ?>
            <form action="index.php" method="post">
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
                <th>Reserved Time</th>
                <td><?php echo $post['from_picker']?></td>
              </tr>
              <tr>
                <th>Future Refernce</th>
                <td><?php echo $ref?></td>
              </tr>
              <tr >
                <td align="center" colspan="2"><button>Home</button><button type="button" onclick="window.print()">Print this page</button></td>

              </tr>
            </tr>
                <!-- <input type="hidden" name="parking_id" value="<?php echo $rs['master_parking_id']?>">
                <input type="hidden" name="table_id" value="<?php echo $rs['master_table_id']?>">
                <input type="hidden" name="subtable_id" value="<?php echo $rs['master_table_id']?>">
                <input type="hidden" name="search" value="<?php echo $rs['master_table_id']?>">
                <input type="hidden" name="from_date" value="<?php echo $post['from_picker']?>"> -->
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