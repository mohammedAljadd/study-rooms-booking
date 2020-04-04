
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
                <br><br>
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
            <div class="all">
    
                <div class="bat">
                    <h1>Batiment A</h1>
                            <h2> 
                                <?php
                                    $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <86400 )) and idBatiment=1;";
                                    $result = mysqli_query($conn,$sql);
                                    $out = mysqli_num_rows($result);
                                    if($out > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo $row['num']." salles sont disponibles";
                                        }
                                    }
                                ?>
                            </h2>
                </div> 


                <div class="bat">
                    <h1>Batiment B</h1>
                            <h2>   
                            <?php
                                    $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <86400 )) and idBatiment=2;";
                                    $result = mysqli_query($conn,$sql);
                                    $out = mysqli_num_rows($result);
                                    if($out > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo $row['num']." salles sont disponibles";
                                        }
                                    }
                                ?>
                            </h2>
                </div>


                <div class="bat">
                    <h1>Batiment C</h1>
                    <h2> 
                    <?php
                                    $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <86400 )) and idBatiment=3;";
                                    $result = mysqli_query($conn,$sql);
                                    $out = mysqli_num_rows($result);
                                    if($out > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo $row['num']." salles sont disponibles";
                                        }
                                    }
                                ?>
                    </h2>
                </div>

                <div class="bat" >
                    <h1>Batiment D</h1>
                    <h2> 
                    <?php
                                    $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <86400 )) and idBatiment=4;";
                                    $result = mysqli_query($conn,$sql);
                                    $out = mysqli_num_rows($result);
                                    if($out > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo $row['num']." salles sont disponibles";
                                        }
                                    }
                                ?>
                    </h2>
                </div>

                <div class="bat">
                    <h1>Batiment E</h1>
                    <h2> 
                    <?php
                                    $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <86400 )) and idBatiment=5;";
                                    $result = mysqli_query($conn,$sql);
                                    $out = mysqli_num_rows($result);
                                    if($out > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo $row['num']." salles sont disponibles";
                                        }
                                    }
                                ?>
                    </h2>
                </div>

                                </div>

            
            
            
            
                                <div class="forma">
        <form action="reservation_check.php"  method="POST">
            
            <label for="bata">Batiment A </label>
            <input type="radio"  name="bat" value="bata">
            
            <label for="batb">Batiment B</label>
            <input type="radio" name="bat"  value="batb">
            
            <label for="batc">Batiment C</label>
            <input type="radio"   name="bat" value="batc">
            
            <label for="batd">Batiment D</label>
            <input type="radio"   name="bat" value="batd">
            
            <label for="bate">Batiment E</label>
            <input type="radio"   name="bat" value="bate">
            
            <br>
            <input type="submit" name="submit" value="choisir une salle">

        </form>
</div>
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


