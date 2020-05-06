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
        if(isset($_SESSION['email']) && $_SESSION['email']=="aljadd.mohammed@ine.inpt.ma")
        {
?>




<?php
    include 'includes/dbconn.php';
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/affectation.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost&family=Raleway&display=swap" rel="stylesheet">
    <title>affectation</title>
</head>
<img src="img/Go.png" alt="" height="70" width="260" id="go">
<div class="headacheAdmin">
<ul  >

            <a href="home.php">Home</a>
            <a href="reservation.php">Reservation</a>
            <a href="password.php">Compte</a>
            <a href="updateUser.php">Modify users</a>
            <a href="affectation.php">Affectation</a>
        </ul>
</div>
<style>
table{
    position:relative;
    top:13px;
    left:1.6cm;
    width:24cm;
    font-family: 'Raleway', sans-serif;
    font-size: 16px;
}
td,th{
    padding:8px 12px 8px 12px;
}
.box{
    position:relative;
    top:270px;
    height:70%;
    width:28cm;
    background-color:rgb(0,0,0,0.7);
}
</style>


<div class="box">
<h1>Affectation</h1>
<table border="1" class="affecTable">
<tr>
    <th style='color:rgb(174, 197, 251)'>PROF</th>
    <th style='color:rgb(174, 197, 251)'>La salle réservée</th>
    <th style='color:rgb(174, 197, 251)'>Le jour</th>
    <th style='color:rgb(174, 197, 251)'>Date de début</th>
    <th style='color:rgb(174, 197, 251)'>Date de fin</th>
    <th style='color:rgb(174, 197, 251)'>Batiment</th>
    
</tr>
<?php
    $sql = " SELECT   CONCAT(prof.nom ,' ', prof.prenom ) as a, 
    salle.nom as b,
    date as c,
    date_fin as d,
    batiment.nom as e,
	case 
      when DAYNAME(date) = 'Monday' then 'Lundi'
      when DAYNAME(date) = 'Tuesday' then 'Mardi'
      when DAYNAME(date) = 'Wednesday' then 'Mercredi'
      when DAYNAME(date) = 'Thursday' then 'Jeudi'
      when DAYNAME(date) = 'Friday' then 'Vendredi'
      when DAYNAME(date) = 'Saturday' then 'Samedi'
    end as myDay
    FROM prof,salle,affectation,batiment 
    where prof.idProf=affectation.idProf and salle.id=affectation.idSalle 
    and batiment.id=salle.idBatiment order by c;";
    $result = mysqli_query($conn,$sql);
    $out = mysqli_num_rows($result);
    
    if($out>0){
        while($row = mysqli_fetch_assoc($result)){
            if($row['a']=="Mohammed AL JADD"){
                echo "<tr>
                <th style='color:rgb(255, 104, 104)'>C'est vous</th>  <th style='color:rgb(255, 104, 104)'>".$row['b']."</th>
                <th style='color:rgb(255, 104, 104)'>".$row['myDay']."</th>
                <th style='color:rgb(255, 104, 104)'>".$row['c']."</th>  <th style='color:rgb(255, 104, 104)'>".$row['d']."</th> 
                <th style='color:rgb(255, 104, 104)'>".$row['e']."</th>
                </tr>";

            }
            else{

            
            echo "<tr>
                <th>".$row['a']."</th>  <th>".$row['b']."</th>
                <th>".$row['myDay']."</th>
                <th>".$row['c']."</th>  <th>".$row['d']."</th>
                <th>".$row['e']."</th>
                </tr>";
            }
        }
    }

?>
</table>


</div>


<?php
        }
        elseif(!isset($_SESSION['email'])){
            include 'login.php';
        }
        elseif($_SESSION['email']!="aljadd.mohammed@ine.inpt.ma"){
            ?>

            <script>
                alert("Vous n\'êtes pas autorisé à visiter cette page Web car vous n\'êtes pas l\'administrateur. Merci!");
            </script>
            <script>
                window.location.replace("login.php");
            </script>
            <?php
            session_start();
            session_unset();
            session_destroy();
        }
?>


