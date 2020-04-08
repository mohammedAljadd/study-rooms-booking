<?php
            if(session_id() == '') {
                session_start();
               }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
 
        
        <script>
            var loginError= "<?php echo $_SESSION['loginError']  ?>";
            if(loginError==1){
                alert('Empty fileds');
            }
            else{
                alert('Wrong informations');
            }
        </script>
        
<?php
    unset($_SESSION['loginError']);
?>
        
 
</head>
<body>

    <img src="img/login.png" height="170" width="640" id="img" >

    <div class="box">
        <h1>Login</h1>
    
    <form action="login_check.php" method="POST" >
        <input type="text" placeholder="Email"  name="email" > 
        <input type="password" placeholder="Password" name="password" > 
        <span class="subset" > <input type="submit" name="submit" >   </span>      <span class="subset" > <input type="reset" value="reset"></span> 
    </form>


    </div>

</body>
</html>
<?php
    if(isset($_SESSION['logOut']) && $_SESSION['logOut']==2){
        session_unset();
        session_destroy();
?>
<script>
    var myDate = new Date();
    var dateHour = myDate.getHours();
    if(dateHour<18 && dateHour>5){
        alert("Merci d'avoir utiliser notre site web,bonne journée ");
    }
    else{
        alert("Merci d'avoir utiliser notre site web, bonne soirée");
    }
    
</script>
<?php

    }
?>