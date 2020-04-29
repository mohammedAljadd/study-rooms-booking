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
            alert("<?php echo $_SESSION['emailError'] ?>");
        </script>
        
<?php
    unset($_SESSION['emailError']);
?>
        
        <script>
            alert("<?php echo $_SESSION['wrongRandom'] ?>");
        </script>
        
<?php
    unset($_SESSION['wrongRandom']);
?>
 
</head>
<body>

    <img src="img/login.png" height="170" width="640" id="img" >

    <div class="box">
    <br>
        <h1>Entrer votre email</h1>
        <br>
    <form action="forget_pass_check.php" method="POST" >
        <input type="text" placeholder="Email"  name="email_forget" > 
        
        <span class="subset" > <input type="submit" name="submit" >   </span>      <span class="subset" > <input type="reset" value="reset"></span> 
        <br>
    </form>


    </div>

</body>
</html>
