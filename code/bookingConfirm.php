<?php
    if(isset($_POST['submit'])){
        if(session_id() == '') {
            session_start();
           }
        include 'includes/dbconn.php';
        $idProf = $_SESSION['idprof'];
        $nomSalle=$_SESSION['salle'];
        $idSalle=$_SESSION['salle'];
        
        

        $Debut = explode( 'T' ,$_POST['date_debut'] );
        $Fin = explode( 'T' ,$_POST['date_fin'] );
        $D = $Debut['1'].":00";
        $F = $Fin['1'].":00";
        
        $debut = $Debut['0']." ".$D;
        $fin = $Fin['0']." ".$F; 
        
        
        $debutSTR = strtotime($debut) ;
        $finSTR = strtotime($fin) ;
        $diff = $finSTR-$debutSTR;
        $Actual=date("Y-m-d H:i:00 ");
        $Actual = date('Y/m/d H:i:s', strtotime($Actual)-3600);
        $Chek = 1;

        $tard = $debutSTR-strtotime($Actual);
        $toleD=date("H:i",strtotime($debut));
        $toleF=date("H:i",strtotime($fin));
        $day = date("l",$debutSTR);

        if(empty($_POST['date_debut']) || empty($_POST['date_fin'])){
            $_SESSION['error']="Emptyfields";
            header("location:date_booking.php?emptyFields");
        }
        if($day == 'Sunday'){
            $_SESSION['error']="Sunday";
            header("location:date_booking.php?sunday");
        }
        elseif($tard<0){
            $_SESSION['error']="oldDate";
            header("location:date_booking.php?oldDate");
        }
        elseif($tard>172800){
            $_SESSION['error']="b3iiiiiiid";
            header("location:date_booking.php?b3iiiiiiid");
        }
        elseif($toleD<'08:00' || $toleD>'17:00' || $toleF<'08:00' || $toleF>'18:00'){
            $_SESSION['error']="holdOn";
            header("location:date_booking.php?holdOn");
        }
        elseif($diff==0){
            $_SESSION['error']="equal";
            header("location:date_booking.php?Debut=fin");
        }
        
        elseif($diff<3600){
            $_SESSION['error']="short";
            header("location:date_booking.php?short");
        }
        elseif($diff>14400){
            $_SESSION['error']="long";
            header("location:date_booking.php?long");
        }
        else{
                    $sql = "SELECT date,date_fin FROM `affectation`where idSalle='".$idSalle."';";
                    $result=mysqli_query($conn,$sql); 
                    $out=mysqli_num_rows($result);
                    if($out>0){
                    while($row=mysqli_fetch_assoc($result)){
                        if(($row['date']<$debut && $row['date_fin']> $debut)||($row['date']<$fin && $row['date_fin']> $fin)){
                            $Chek = 0;
                        break;
                        }
                    }


                    
                        if($Chek==0){
                            $_SESSION['error']="inters";
                            header("location:date_booking.php?invalideTime1");
                        }
                        
                        else{
                            $sql = " INSERT INTO `affectation` (`idProf`, `idSalle`, `date`, `date_fin`, `Marge`) 
                            VALUES ('$idProf', '$idSalle', '$debut', '$fin', '$diff') ;";
                            $sql1 = "SELECT batiment.nom from batiment,salle WHERE batiment.id=salle.idBatiment and salle.id='".$idSalle."';";
                            $result1 = mysqli_query($conn,$sql1);
                            while($row = mysqli_fetch_assoc($result1)){
                                $batiment = $row['nom'];
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
                            
                             $_SESSION['error']="done";

                             $sender = $_SESSION['email'];
                             $recipient = 'mohammedaljadd8@gmail.com';
                             $name = $_SESSION['name'];
                             $subject = "Réservation par ".$name;
                             $headers = "MIME-Version: 1.0" . "\r\n";
                             $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                             $headers .= 'From:' . $sender;
                             $txt = $message = "
                                 <html>
                                 <head>
                                 <title>Reservation</title>
                                 </head>
                                 <body>
                                 <h2>Les informations sur la reservation :</h2>
                                 <table border='1' style='padding:7px 7px 7px 7px'>
                                 <tr >
                                 <th style='padding:7px 20px 7px 20px;color:red'>La salle</th>
                                 <th style='padding:7px 20px 7px 20px;color:red'>Le batiment</th>
                                 <th style='padding:7px 20px 7px 20px;color:red'>Le jour</th>
                                 <th style='padding:7px 20px 7px 20px;color:red'>Debut</th>
                                 <th style='padding:7px 20px 7px 20px;color:red'>Fin</th>
                                 </tr>
                                 <tr>
                                 <th style='padding:7px 20px 7px 20px'>".$nomSalle."</th>
                                 <th style='padding:7px 20px 7px 20px'>".$batiment."</th>
                                 <th style='padding:7px 20px 7px 20px'>".$day."</th>
                                 <th style='padding:7px 20px 7px 20px'>".$debut."</th>
                                 <th style='padding:7px 20px 7px 20px'>".$fin."</th>
                                 </tr>
                                 </table>
                                 </body>
                                 </html>
                                 ";
                                 $message = "<h2>Une réservation a été effectuée par ".$sender.'</h2>'."\n\n".$txt;
                                 if(mail($recipient, $subject, $message, $headers)){
                                 $_SESSION['contact'] = 'Courrier envoyé avec succès, Nous vous répondrons dès que possible!';
                                 $result = mysqli_query($conn,$sql);
                                 header("location:reservation.php?VotreReservationDone");
                             }
                
                            
            }
                



            }
            else{
                $sql = " INSERT INTO `affectation` (`idProf`, `idSalle`, `date`, `date_fin`, `Marge`) 
                VALUES ('$idProf', '$idSalle', '$debut', '$fin', '$diff') ;";
                $sql1 = "SELECT batiment.nom from batiment,salle WHERE batiment.id=salle.idBatiment and salle.id='".$idSalle."';";
                $result1 = mysqli_query($conn,$sql1);
                while($row = mysqli_fetch_assoc($result1)){
                    $batiment = $row['nom'];
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
                
                $_SESSION['error']="done";

                $sender = $_SESSION['email'];
                $recipient = 'mohammedaljadd8@gmail.com';
                $name = $_SESSION['name'];
                $subject = "Réservation par ".$name;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From:' . $sender;
                $txt = $message = "
                    <html>
                    <head>
                    <title>Reservation</title>
                    </head>
                    <body>
                    <h2>Les informations sur la reservation :</h2>
                    <table border='1' style='padding:7px 7px 7px 7px'>
                    <tr >
                    <th style='padding:7px 20px 7px 20px;color:red'>La salle</th>
                    <th style='padding:7px 20px 7px 20px;color:red'>Le batiment</th>
                    <th style='padding:7px 20px 7px 20px;color:red'>Le jour</th>
                    <th style='padding:7px 20px 7px 20px;color:red'>Debut</th>
                    <th style='padding:7px 20px 7px 20px;color:red'>Fin</th>
                    </tr>
                    <tr>
                    <th style='padding:7px 20px 7px 20px'>".$nomSalle."</th>
                    <th style='padding:7px 20px 7px 20px'>".$batiment."</th>
                    <th style='padding:7px 20px 7px 20px'>".$day."</th>
                    <th style='padding:7px 20px 7px 20px'>".$debut."</th>
                    <th style='padding:7px 20px 7px 20px'>".$fin."</th>
                    </tr>
                    </table>
                    </body>
                    </html>
                    ";
                $message = "<h2>Une réservation a été effectuée par ".$sender.'</h2>'."\n\n".$txt;
                if(mail($recipient, $subject, $message, $headers)){
                    $_SESSION['contact'] = 'Courrier envoyé avec succès, Nous vous répondrons dès que possible!';
                    $result = mysqli_query($conn,$sql);
                    header("location:reservation.php?VotreReservationDone");
                }
                
                            
            }






        }
        
        
        
    
}


?>