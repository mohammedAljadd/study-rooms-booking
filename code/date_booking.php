<?php
if(session_id() == '') {
    session_start();
   }
$expireAfter = 15;
if(isset($_SESSION['last_action'])){
    $secondsInactive = time() - $_SESSION['last_action'];
    $expireAfterSeconds = $expireAfter * 60;
    if($secondsInactive >= $expireAfterSeconds){
        ?>
            <script>
                alert("La session a expiré, veuillez vous reconnecter!");
            </script>
                <?php
                    session_unset();
                    session_destroy();
    }}
    $_SESSION['last_action'] = time();
?>
<?php
        if(isset($_SESSION['email']))
        {
?>
<?php
    include 'includes/dbconn.php';
    $email = $_SESSION['email'];
    $sql = "SELECT affectation.idProf FROM affectation,prof WHERE affectation.idProf=prof.idProf AND prof.email='".$email."';";
    $result = mysqli_query($conn,$sql);
    $outDb = mysqli_num_rows($result);
    if($outDb==0 && isset($_SESSION['salle'])){
?>
<script>
    var error = "<?php echo $_SESSION['error']; ?>";
    switch (error){
                case 'Emptyfields':
                    alert('Empty field');
                    break;
                    
                case 'Sunday':
                    alert('Vous ne pouvez pas réserver le Dimanche, Merci de prendre un autre jour !');
                    break;
                case 'oldDate':
                    alert('les dates sont anciennes');
                    break;
                case 'b3iiiiiiid':
                    alert('Vous pouvez pas réserver plus de deux jours avant');
                    break;
                case 'equal':
                    alert('La date de début et la date de fin sont égales');
                    break;
                case 'short':
                    alert('La durée de la réservation ne doit pas être inférieure à une heure');
                    break;
                case 'long':
                    alert('La durée de la réservation ne doit pas dépasser 4 heures');
                    break;
                case 'inters':
                    alert('les dates se croisent avec d\'autres dates');
                    break;
                case 'holdOn':
                    alert('les heures tolérées sont comprises entre 08h00 et 18h00');
                    break;
                case 'Saturday':
                    alert('les heures tolérées pour Samedi sont comprises entre 08h00 et 12h00');
                    break;
                }
</script>

<?php
    unset($_SESSION['error']);
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
        $idSalle=$_SESSION['salle'];
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
        <h3 style="color:white;font-family:cursive">Heures tolérées: Lundi-Vendredi: 8 h à 18 h. <br> Samedi 8 h à 12 h.</h3> 
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
                <p>Heures tolérées:  <br> Lundi-Vendredi: 8 h à 18 h. <br> Samedi 8 h à 12 h. 
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
        header("location:reservation.php");
    }
?>

<?php
        }
        else{
            include 'login.php';
        }
?>
