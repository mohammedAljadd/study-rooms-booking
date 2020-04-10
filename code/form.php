<?php
    session_start();
        if(isset($_SESSION['email']))
        {
?>

<?php
    include 'includes/dbconn.php';
    $email = $_SESSION['email'];
    $sql = "SELECT affectation.idProf FROM affectation,prof WHERE affectation.idProf=prof.idProf AND prof.email='".$email."';";
    $result = mysqli_query($conn,$sql);
    $outDb = mysqli_num_rows($result);
    if($outDb==0){
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/book.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/welcom.css">
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

    <div class="all">
    
    <div class="bat">
        <h1>Batiment A</h1>
                <h2> 
                    <?php
                        $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <82800 )) and idBatiment=1;";
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
                        $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <82800 )) and idBatiment=2;";
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
                        $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <82800 )) and idBatiment=3;";
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
                        $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <82800 )) and idBatiment=4;";
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
                        $sql = "SELECT count(nom) as num from salle where (id not in(select idSalle from affectation) or id in (select idSalle from affectation group by idSalle HAVING sum(Marge) <82800 )) and idBatiment=5;";
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

</div>
<br><br><br><br><br><br><br><br><br>
    <div class="box" >
        <h1>
        <?php
            
            $bat = $_SESSION['bat'];
            switch($bat){
                case "bata":
                    echo "Choisir une salle dans batiment A";
                break;
                case "batb":
                    echo "Choisir une salle dans batiment B";
                break;
                case "batc":
                    echo "Choisir une salle dans batiment C";
                break;
                case "batd":
                    echo "Choisir une salle dans batiment D";
                break;
                case "bate":
                    echo "Choisir une salle dans batiment E";
                break;

            }
        ?>

        </h1>
    <div class="halland">    
        <form action="form.php" method="POST">
            <h3>
        <?php
            $bat = $_SESSION['bat'];
            switch($bat){

                case "bata":
                    $bat=1;
                break;
                case "batb":
                    $bat=2;
                break;
                case "batc":
                    $bat=3;
                break;
                case "batd":
                    $bat=4;
                break;
                case "bate":
                    $bat=5;
                break;

            }
            
            ?>
            <?php   
                    
                    $sql="SELECT concat(upper(salle.nom),' n\'est pas encors reservee') as nom,salle.id as id FROM salle WHERE id not in (SELECT affectation.idSalle FROM affectation) and salle.idBatiment='".$bat."' UNION SELECT concat('First reservation of ',upper(salle.nom),' is ',min(affectation.date)) as nom,salle.id as id FROM affectation,salle WHERE affectation.idSalle=salle.id and salle.idBatiment='".$bat."' GROUP by affectation.idSalle HAVING COUNT(affectation.idSalle)<11;;";
                    $result = mysqli_query($conn,$sql);
                    $option="";
                    while($row=mysqli_fetch_array($result)){
                        $option=$option."<option value=".$row['id'].">".$row['nom']."</option>";
                    }
            ?>
            
            
            <select class="boxer" name="salll" style="width:150px;">
                <option >
                    <?php echo $option;?>
                    </option>
            </select>
            <br><br>
            <span> <input type="submit" name="submit"> </span> <span> <input type="reset"> </span>
        </form>
        </div>
    </div> 
    <?php
                if(isset($_POST['submit'])){
                    if(!empty($_POST['salll'])){
                        $_SESSION['salle'] = $_POST['salll'];
                        header('location:date_booking.php');
                }
                else{
                    header('location:form.php?PleaseChoose');
                }
            }
            ?>
    
    
</body>
</html>
<?php
    }
    elseif($outDb>0){
        include 'reservation.php';
    }
?>

<?php
        }
        else{
            include 'login.php';
        }
?>
