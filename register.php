//agent Registration 
<html>  
<head>  
    <title>PHP login system</title>  
    <link rel = "stylesheet" type = "text/css" href = "style/style.css">   
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
    <div id = "frm">  
        <h1 style="color: #ffe108;
    font-weight: 2000;">Registeration</h1>  
        <form name="f1" action = "store.php" onsubmit = "return validation()" method = "POST">  
            <p>  
                <label> Firstname: </label>  
            </p>
            <p>
                <input type = "text" id ="firstname" name  = "firstname" />  
            </p>
            <p>  
                <label> Lastname: </label>  
            </p>
            <p>
                <input type = "text" id ="lastname" name  = "lastname" />  
            </p>
            <p>  
                <label> Email: </label>  
            </p>
            <p>
                <input type = "email" id ="email" name  = "email" />  
            </p>
            <p>  
                <label> Mobileno: </label>  
            </p>
            <p>
                <input type = "text" id ="mobile" name  = "mobileno" minlength="10" maxlength="10"/>  
            </p>  
            <p>  
                <label> Password: </label>
            </p>
            <p>  
                <input type = "password" id ="pass" name  = "pass" minlength="6" />  
            </p>
            <p>  
                <label> Confirm Password: </label>
            </p>
            <p> 
             <input type="password" placeholder="Confirm Password" name="confirm_password" required>
            </p>
            <p>  
                <label> DOB: </label>
            </p>
            <p> 
             <input type="date" placeholder="DOB" name="dateofbirth" required>
            </p>
            <p>  
                <label> Address: </label>
            </p>
            <p> 
             <textarea name="address" style="margin: 0px;height: 93px;width: 342px;"></textarea>
            </p>
            <p>  
                <label> Car Registration no: </label>
            </p>
            <p> 
             <input type="text" placeholder="" name="reg_no" required>
            </p>
            <p>  
                <label> Car color: </label>
            </p>
            <p> 
             <input type="text" placeholder="" name="car_color" required>
            </p>

            <?php 
                if(@$_GET['error']){ 
            ?>
            <p><span style="color: red"><?=$_GET['error']?></span></p>
            <?php
                }
            ?>  
            </p>
                
            <br>
            <p>
                <button id="btn btn-primary" style= "width: 140px;
    background: #3434e3;
    font-weight: 900;
    color: white;" type="submit">Register</button>
                <br/>
                <br/>
                <span>Already have an account? <a href="index.php">Sign in</a>.</span>
            </p>
            <!-- <p>     
                <input type =  "submit" id = "btn" value = "Create" />  
                <a href="index.php" id = "btn">Login</a>
            </p>   -->
        </form>  
    </div>  
    <script>  
            function validation()  // Validation
            {  
                var id=document.f1.firstname.value;  
                var ps=document.f1.lastname.value;  
                var email=document.f1.email.value;  
                var mobile=document.f1.mobile.value;  
                var pass=document.f1.mobile.pass;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("First Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Lastname field is empty");  
                    return false;  
                    }  
                    if (email.length=="") {  
                    alert("Email field is empty");  
                    return false;  
                    } 
                    if (mobile.length=="") {  
                    alert("Mobile field is empty");  
                    return false;  
                    } 
                    if (pass.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script>  
</body>     
</html> 