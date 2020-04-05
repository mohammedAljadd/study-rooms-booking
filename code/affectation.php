
<?php
    include 'includes/dbconn.php';
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/affectation.css">
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



<div class="box">
<h1>Affectation</h1>
<table border="1">
<tr>
    <th>PROF</th>
    <th>La salle réservée</th>
    <th>Date de début</th>
    <th>Date de fin</th>
    
</tr>
<?php
    $sql = " SELECT   CONCAT(prof.nom ,' ', prof.prenom ) as 
    a,
    salle.nom as b,date as c,date_fin as d 
    FROM prof,salle,affectation where prof.idProf=affectation.idProf 
    and salle.id=affectation.idSalle order by c;";
    $result = mysqli_query($conn,$sql);
    $out = mysqli_num_rows($result);
    
    if($out>0){
        while($row = mysqli_fetch_assoc($result)){
            if($row['a']=="Mohammed AL JADD"){
                echo "<tr>
                <th>C'est vous</th>  <th>".$row['b']."</th>
                <th>".$row['c']."</th>  <th>".$row['d']."</th>
                </tr>";

            }
            else{

            
            echo "<tr>
                <th>".$row['a']."</th>  <th>".$row['b']."</th>
                <th>".$row['c']."</th>  <th>".$row['d']."</th>
                </tr>";
            }
        }
    }

?>
</table>


</div>





