<?php      
    include('../connect.php');  
    $username = $_POST['user'];  
    $password = $_POST['pass'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select * from users where (email = '$username' or mobileno = '$username')  and password = '$password' and usertype='1'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            session_start();
            $_SESSION['adminid']=$row['id'];
            header("location:index.php");
        }  
        else{  
            header("location:auth.php?error=sorry,record mismatch");
        }     
?>  