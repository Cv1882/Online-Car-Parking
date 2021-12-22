<?php      
//user registration store form
	    include('connect.php');  
	    $firstname = $_POST['firstname'];  
	    $lastname = $_POST['lastname'];  
	    $email = $_POST['email'];  
	    $mobileno = $_POST['mobileno'];  
	    $password = $_POST['pass'];  
        $dob = date('Y-m-d',strtotime($_POST['dateofbirth']));  
        $address = $_POST['address'];  
        $reg_no = $_POST['reg_no'];  
        $car_color = $_POST['car_color'];  
	    $status = 1;  
	    $usertype = 2;  
      
        //to prevent from mysqli injection  
        $firstname = stripcslashes($firstname);  
        $lastname = stripcslashes($lastname);  
        $email = stripcslashes($email);  
        $mobileno = stripcslashes($mobileno);  
        $password = stripcslashes($password);  
        $firstname = mysqli_real_escape_string($con, $firstname);  
        $email = mysqli_real_escape_string($con, $email);  
        $mobileno = mysqli_real_escape_string($con, $mobileno);  
        $password = mysqli_real_escape_string($con, $password);  
        $lastname = mysqli_real_escape_string($con, $lastname);  
      
        $sql = "insert into users(`firstname`,`lastname`,`email`,`mobileno`,`password`,`status`,`usertype`,`user_dob`,`address`,`car_reg`,`car_color`)values('".$firstname."','".$lastname."','".$email."','".$mobileno."','".$password."','".$status."','".$usertype."','".$dob."','".$address."','".$reg_no."','".$car_color."')";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            header("location:success.php");
        }  
        else{  
            header("location:index.php?error=Record updated succesfully");
        }     
?>  