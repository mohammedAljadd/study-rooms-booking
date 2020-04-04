
<?php
    session_start();
    include 'includes/dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/book.css">
    <link rel="stylesheet" href="css/welcom.css">
    <link rel="stylesheet" href="css/reservation.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Reservation</title>
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
        <div class="welcom">
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
        ?>
                <div class="logout">
                    <form action="logOut.php" method="post" >
                    <button name="logout" type="submit">Log Out!</button>
                    </form>
                </div>
                </div>
    <?php
        }
    ?>
<?php
    if(!isset($_SESSION['reserved']))
    {
?>
            <?php
            if(!isset($_SESSION['batiment']))
            {
            ?>
                <p>les batimets</p>
            <?php
            }
                else //batiment choisie
                {
            ?>
                <h2>salle</h2>

            <?php
                }
            ?>
            <?php
                if(isset($_SESSION['batiment']) && isset($_SESSION['salle']))
                {
            ?>
                <p>choisir les dates</p>
            <?php
                }
            ?>

<?php
    }
    else //already reserved
    {
?>
    <h2>Table qui montre ton reservation</h2>

<?php
    }
?>


