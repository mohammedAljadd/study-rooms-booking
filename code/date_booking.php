
<?php
    session_start();
        if(isset($_SESSION['email']))
        {
?>


<?php
    include 'includes/dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/book.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/welcom.css">
    <link rel="stylesheet" href="css/date_booking.css">
    <title>Formulaire</title>
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
            }

            else{
                echo "Welcom,Please Sign Up";
            }
            
        ?>
    </div>
    </div>
    <br><br><br>
    




    <?php
        $nomSalle=$_SESSION['salle'];
        $a=strpos($nomSalle,'SALLE');
        if($a==true){
            $idSalle=$nomSalle[($a+6)]."".$nomSalle[($a+7)];
        }
        elseif($a==false){
            $a=strpos($nomSalle,'AMPHI_E');
            $idSalle=($nomSalle[$a+7]+41);
        }
        $_SESSION['chosenIDSalle']=$idSalle;
        
        
        $sql = "SELECT date,date_fin FROM affectation where idSalle='".$idSalle."' order by date ;";
        $result = mysqli_query($conn,$sql);
        $Check=mysqli_num_rows($result);
    ?>
<?php
    if($Check>0 ){
        $_SESSION['ifAlready']="alreadyReserved";
?>

        <table align="center" border="1px" style="width:600px;line-height:39px;">
                    <tr><th  colspan="2">Les horaires qui sont deja prises</th></tr>
                    <tr>
                        <th>debut</th>
                        <th>fin</th>
                    </tr>
                    
        <?php
            while($row=mysqli_fetch_assoc($result))
            {
        ?>
            <tr>
                <td><?php  echo $row['date'] ;  ?></td>
                <td><?php  echo $row['date_fin'] ;  ?></td>
            </tr>

    <?php
            }
    ?>


        </table>
        <div class="already">
            <h1>Choisir le temps que vous convient</h1>
            <form action="bookingConfirm.php" method="POST">
            <input type="datetime-local" name="date_debut" placeholder="yyyy/mm/dd hh:mm:00">
            <input type="datetime-local" name="date_fin" placeholder="yyyy/mm/dd hh:mm:00">   
            <span> <input type="submit" name="submit"> </span> <span> <input type="reset"> </span>
        </form>
</div>
    

<?php
    }
    elseif($Check==0 ){
        
?>             <div class="notYet">
                <p>Cette salle n'est pas encore reservée, vous pouvez dès maintenant la réserver.
                </div>
<div class="box">
<h1>Choisir le temps que vous convient</h1>
        <form action="bookingConfirm.php" method="POST">
            <input type="datetime-local" name="date_debut" placeholder="yyyy/mm/dd hh:mm:00">
            <input type="datetime-local" name="date_fin" placeholder="yyyy/mm/dd hh:mm:00">   
            <span> <input type="submit" name="submit"> </span> <span> <input type="reset"> </span>
        </form>
</div>


<?php
    }
?>



    </body>
</html>


<?php
        }
        else{
            include 'login.php';
        }
?>
