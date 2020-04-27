<?php
    session_start();
    include 'includes/dbconn.php';
        $emaiL = $_SESSION['email_forget'];
          $sql = "select * from forget_password where email='".$emaiL."';";
          $result= mysqli_query($conn,$sql);
          $out = mysqli_num_rows($result);
          if($out>0){
?>

<script>
    alert("<?php echo $_SESSION['randomSent']  ?>");
</script>
<?php
    unset($_SESSION['randomSent'] );
?>

<script>
    alert("<?php echo $_SESSION['wrongRandom'] ?>");
</script>


<?php
    unset($_SESSION['wrongRandom']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>

</head>
<body>

    <img src="img/login.png" height="170" width="640" id="img" >

    <div class="box">
    <br>
        <h1>Entrer votre code</h1>
        <br>
    <form action="forget_pass_check.php" method="POST" >
        <input type="text" placeholder="Le code envoyé"  name="random" > 
        <span class="subset" > <input type="submit" name="submit_code" >   </span>      <span class="subset" > <input type="submit" name="Recode" value="renvoyer"></span> 
        <br>
    </form>


    </div>

</body>
</html>
<?php

          }
          else{
            $_SESSION['Th']='against';
            header("Location:forgetPass.php");
          }
          ?>
<script>
    alert("<?php echo $_SESSION['Th'] ?>");
</script>


<?php

    unset($_SESSION['Th']);
?>