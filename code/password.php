<?php
session_start();
    include 'includes/dbconn.php'
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/password.css">
    <link rel="stylesheet" href="css/shared-css.css">
    <link rel="stylesheet" href="css/welcom.css">
    
    
    <title>Change Password</title>
</head>
<body>

<img src="img/Go.png" alt="" height="70" width="260" id="go">
<div class="headache">
<?php
    if($_SESSION['email']!="aljadd.mohammed@ine.inpt.ma"){

?>
        <ul  >
            <a href="home.php">Home</a>
            <a href="reservation.php">Reservation</a>
            <a href="password.php">Compte</a>
            <a href="contact.php">Contact</a>
        </ul>
<?php
    }
    else{
?>
    <ul  >
            <a href="home.php">Home</a>
            <a href="reservation.php">Reservation</a>
            <a href="password.php">Compte</a>
            <a href="updateUser.php">Modify users</a>
        </ul>
        <?php
    }
        ?>
</div>

<div class="welc">   
<?php
            if(isset($_SESSION['email'])){
                    
                $user =$_SESSION['email'];
                $sql = "SELECT nom,prenom FROM `prof`where email='".$user."';";
                $result = mysqli_query($conn,$sql);
                $out = mysqli_num_rows($result);
                if($out>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "Welcome ".$row['nom']." ".$row['prenom'];
                    }
                }
            }
            
        ?>

            <?php
            if(isset($_SESSION['email']))
            {
            ?>
                    <form action="logOut.php" method="post" >
                    <button name="logout" type="submit">Log Out!</button>
                    </form>
            <?php
            }
            ?>

</div>


<div class="box" >
        <h1>Changer votre mot de pass</h1>
        <form action="password_check.php" method="post">
            <input type="password"  placeholder="Mot de pass" name="pass">
            <input type="password" placeholder="le nouveau Mot de pass" name="newPass">
            <input type="password"  placeholder="retaper le nouveau Mot de pass" name="newPassR">            
            <span> <input type="submit" value="changer" name="submit"> </span> <span> <input type="reset"> </span>
        </form>
    </div> 





