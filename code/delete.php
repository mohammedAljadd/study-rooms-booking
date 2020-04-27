<?php   
        session_start();
        include 'includes/dbconn.php';
        $email = $_SESSION['email'];
        $sql = "select idProf from prof where email='".$email."';";
        $result= mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result))
            {
                $Id = $row['idProf'];
            }
            

$sql = " SELECT salle.nom as salle,affectation.date as debut,affectation.date_fin as fin,batiment.nom as batiment FROM affectation,salle,prof,batiment WHERE salle.id=affectation.idSalle and prof.idProf=affectation.idProf and affectation.idProf='".$Id."' and batiment.id=salle.idBatiment;";
$result= mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $salle = $row['salle'];
    $debut = $row['debut'];
    $fin = $row['fin'];
    $batiment = $row['batiment'];
}
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

 

 $sender = $_SESSION['email'];
 $recipient = 'mohammedaljadd8@gmail.com';
 $name = $_SESSION['name'];
 $subject = "Réservation annulée par ".$name;
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 $headers .= 'From:' . $sender;
 $txt = $message = "
     <html>
     <head>
     <title>Reservation</title>
     </head>
     <body>
     <h2>La réservation annulée:</h2>
     <table border='1' style='padding:7px 7px 7px 7px'>
     <tr >
     <th style='padding:7px 20px 7px 20px;color:red'>La salle</th>
     <th style='padding:7px 20px 7px 20px;color:red'>Le batiment</th>
     <th style='padding:7px 20px 7px 20px;color:red'>Le jour</th>
     <th style='padding:7px 20px 7px 20px;color:red'>Debut</th>
     <th style='padding:7px 20px 7px 20px;color:red'>Fin</th>
     </tr>
     <tr>
     <th style='padding:7px 20px 7px 20px'>".$salle."</th>
     <th style='padding:7px 20px 7px 20px'>".$batiment."</th>
     <th style='padding:7px 20px 7px 20px'>".$day."</th>
     <th style='padding:7px 20px 7px 20px'>".$debut."</th>
     <th style='padding:7px 20px 7px 20px'>".$fin."</th>
     </tr>
     </table>
     </body>
     </html>
     ";
     $message = "<h2>Une réservation a été annulée par ".$sender.'</h2>'."\n\n".$txt;
     if(mail($recipient, $subject, $message, $headers)){
        $_SESSION['error']="annuler";
        $sql = "DELETE FROM `affectation`  where idProf='".$Id."';";
        $result = mysqli_query($conn,$sql);
        header('location:reservation.php?removed'); 
        
     
     }
