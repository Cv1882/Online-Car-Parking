<?php 
if(!isset($_SESSION)){
    session_start();
}
if(@$_SESSION['adminid']!=""){
    header('Location:dashboard.php');
}
$_SESSION['refreh']=1;
?>
<html>  
<head>  
    <title>Login</title>  
    <link rel = "stylesheet" type = "text/css" href = "../style/style.css">   
    <style>
        label {
            color: #bb7070;
        }
        input,textarea
        {
            width: 335px;
            height: 30px;
        }
        input[type="date"] {
            width: 140px;
        }
</style>
</head>  
<body>  
    <div id = "frm" class="login-container">  
        <h1 style="color: #ffe108;
    font-weight: 2000;">Admin Login</h1>  
        <form name="f1" action = "process.php" onsubmit = "return validation()" method = "POST">  
            <p>  
                <label> UserName: </label>  
            </p>
            <p>
                <input type = "text" id ="user" name  = "user" />  
            </p>  
            <p>  
                <label> Password: </label>
            </p>
            <p>  
                <input type = "password" id ="pass" name  = "pass" />  
            </p>
            <?php 
                if(@$_GET['error']){ 
            ?>
            <p><span style="color: red"><?=$_GET['error']?></span></p>
            <?php
                }
            ?>  
            <p>     
                <button id="btn btn-primary" style= "width: 140px;
    background: #3434e3;
    font-weight: 900;
    color: white;" type="submit">Login</button>
            </p>  
        </form>  
    </div>  
    <script>  
            function validation()  
            {  
                var id=document.f1.user.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script>  
</body>     
</html> 