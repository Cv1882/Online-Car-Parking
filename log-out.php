<?php 
if(!isset($_SESSION)){
    session_start();
}
//clearing session
session_destroy();
unset($_SESSION['userid']);//clearing session variable
header("Location:dashboard.php");//redirect another page

?>