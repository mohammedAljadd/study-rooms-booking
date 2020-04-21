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

        if(empty($_POST['date_debut']) || empty($_POST['date_fin'])){
            $_SESSION['error']="Emptyfields";
            header("location:date_booking.php?emptyFields");
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
                            $result = mysqli_query($conn,$sql);
                            if($result){
                            $_SESSION['error']="done";
                            header("location:reservation.php?VotreReservationDone");
                        }
                        }
                



            }
            else{
                $sql = " INSERT INTO affectation (`idProf`, `idSalle`, `date`, `date_fin`, `Marge`) 
                VALUES ('$idProf', '$idSalle', '$debut', '$fin', '$diff') ;";
                $result = mysqli_query($conn,$sql);
                if($result){
                    $_SESSION['error']="done";
                    header("location:reservation.php?VotreReservationDone");
                }
            }






        }
        
        
        
    
}


?>