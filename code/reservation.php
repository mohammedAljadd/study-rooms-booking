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
<script>
    var error = "<?php echo $_SESSION['error']; ?>";
    switch (error){
                case 'done':
                    alert('Votre réservation a été effectuée');
                    break;
                case 'annuler':
                    alert('Votre réservation a été annulée');
                    break;
                
                }
</script>

<?php
    unset($_SESSION['error']);
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
            }

            else{
                echo "Welcom,Please Sign Up";
            }
            
        ?>
        
</div>
    </div>
<?php
    $email = $_SESSION['email'];
    $sql = "select idProf from prof where email='".$email."';";
    $result= mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result))
        {
            $Id = $row['idProf'];
        }
        
        $sql2 = "select idProf from affectation where idProf='".$Id."';";
        $result2= mysqli_query($conn,$sql2);
        $out2 = mysqli_num_rows($result2);

?>
<?php
    if($out2==0){

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
        <form action="reservation.php"  method="POST">
            
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
                if(isset($_POST['submit'])){
                    if(isset($_POST['bat']) ){
                        $_SESSION['bat2']=$_SESSION['bat'] = $_POST['bat'];
                    header('location:form.php');
                }
                else{
                    header('location:reservation.php?PleaseChoose');
                }
            }
            ?>
<?php
    }
    else{
        $email = $_SESSION['email'];
        $sql4 = "SELECT salle.nom salle,batiment.nom batiment FROM salle,affectation,prof,batiment where affectation.idProf=prof.idProf and prof.email='".$email."' and salle.id=affectation.idSalle and salle.idBatiment=batiment.id;";
        $result4 = mysqli_query($conn,$sql4);
        while($row=mysqli_fetch_assoc($result4)){ 
            $salle= $row['salle'];
            $batiment = $row['batiment'];
        
    } 
    $sql3 = "select date,date_fin,idSalle from affectation where idProf='".$Id."'";
    $result3 = mysqli_query($conn,$sql3);
    while($row=mysqli_fetch_assoc($result3)){ 
        $debut = $row['date'];
        $fin = $row['date_fin'];
    
?>
<?php
            if(isset($_SESSION['email']))
            {
            ?>
                <div class="lOogout">
                    <form action="logOut.php" method="post" >
                    <button name="logout" type="submit">Log Out!</button>
                    </form>
                </div>
    <?php
        }
    ?>
<?php
        $day =    date("l",strtotime($debut));
        switch($day){
            case "Monday":
                $day='Lundi';
            break;
            case "Tuesday":
                $day='Mardi';
            break;
            case "Wednesday":
                $day='Mercredi';
            break;
            case "Thursday":
                $day='Jeudi';
            break;
            case "Friday":
                $day='Vendredi';
            break;
            case "Saturday":
                $day='Samedi';
            break;

        }

?>

<div class="lastTabl">
    <table border="1" class="lastTable" align="center"  style="width:600px;line-height:39px;color:#fff;">
        <tr>
            <th colspan="4" style='color:rgb(144, 167, 241)'>Vous avez reservé   
            <?php 
           
            $salle = str_split($salle, 5);
            $batiment = explode('_', $batiment);
            echo '<span style="color:rgb(255, 104, 104)">La '.$salle[0].' '.$salle[1].'</span> dans <span style="color:rgb(255, 104, 104)">Le '.strtolower($batiment[0]).' '.$batiment[1].'</span>' ; 
            ?> </th>

        </tr>
    <tr>
    
        <th  style='color:rgb(174, 197, 251)'>Le jour</th>
        <th  style='color:rgb(174, 197, 251)'>Debut</th>
        <th  style='color:rgb(174, 197, 251)'>Fin</th>
        <th  style='color:rgb(255, 104, 104)'>Voulez vous annuler?</th>
    </tr>
    <tr>
    <th> <?php echo $day;  ?> </th>
        <th> <?php echo $debut;  ?> </th>
        <th> <?php  echo $fin;  ?></th>
        <th>
        <button onClick="deleteMe()">annuler</button>
        </th>
    </tr>
    </table>
</div>
<script language="javascript">
 function deleteMe()
 {
 if(confirm("Voulez-vous vraiment annuler votre réservation ?")){
 window.location.href='delete.php';
 return true;
 }
 } 
 </script>
<?php
    }
?>
</body>
</html>
<?php
    }
?>






<?php
        }
        else{
            include 'login.php';
        }
?>