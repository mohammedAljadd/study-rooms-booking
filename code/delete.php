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
 $guess = $_SESSION['guess'];
 $recipient = 'webaljadd@gmail.com';
 $name =  $guess ." ".$sender;
 $subject = "Réservation annulée par ".$_SESSION['guess'];
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 $headers .= 'From:' . $sender;
 $txt = $message = "
 <html>
 <head>
 <link href='https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap' rel='stylesheet'>
 <title>Reservation</title>
 <style>
 tr:nth-child(even){background-color: #f2f2f2}
 table, th, td {
   padding: 8px;
   text-align: center;
   border-bottom: 1px solid #ddd;
 }
 table {
   border-collapse: collapse;
 width: 100%;
 }
 th {
   background-color: #d1e4eb;
   color: white;
 }
 body{
font-family: 'Josefin Sans', sans-serif;      
      font-size: 23px;
      font-weight: bold;
 }
 th,td,h4,p{
 font-family: 'Josefin Sans', sans-serif;
 font-size: 18px;
 font-weight: bold;
 }

 </style>
 </head>
 <body>
 <p>Les informations sur la reservation :</p>
 <table style='padding:7px 7px 7px 7px'>
 <tr >
 <th style='padding:7px 35px 7px 35px;color:red;'>La salle</th>
 <th style='padding:7px 35px 7px 35px;color:red;'>Le batiment</th>
 <th style='padding:7px 35px 7px 35px;color:red;'>Le jour</th>
 <th style='padding:7px 35px 7px 35px;color:red;'>Debut</th>
 <th style='padding:7px 35px 7px 35px;color:red;'>Fin</th>
 </tr>
 <tr>
 <td style='padding:7px 35px 7px 35px;'>".$salle."</td>
 <td style='padding:7px 35px 7px 35px;'>".$batiment."</td>
 <td style='padding:7px 35px 7px 35px;'>".$day."</td>
 <td style='padding:7px 35px 7px 35px;'>".$debut."</td>
 <td style='padding:7px 35px 7px 35px;'>".$fin."</td>
 </tr>
 </table>
 </body>
 </html>
 ";
 $message = "<h4>Une réservation a été annulée par ".$name.'</h4>'."\n\n".$txt;
 if(mail($recipient, $subject, $message, $headers)){
    $_SESSION['error']="annuler";
    $sql = "DELETE FROM `affectation`  where idProf='".$Id."';";
    $result = mysqli_query($conn,$sql);
    header('location:reservation.php?removed'); 
    
 }
