<?php
session_start();
include 'includes/dbconn.php';
    if(isset($_POST['email_forget'])){
        $email = $_SESSION['email_forget']=mysqli_real_escape_string($conn,$_POST['email_forget']) ;
        $sql = "delete from forget_password where email='".$email."'";
        $result= mysqli_query($conn,$sql);
        $random =  rand(1000000,9999999);
        $sql = "select email from prof where email='".$email."';";
        $endTimeSeconds = strtotime("now")+315-3600;
        $endTime=date("Y-m-d H:i:s",$endTimeSeconds);
        $result= mysqli_query($conn,$sql);
        $out = mysqli_num_rows($result);
        $sql2 = "select * from  `blocked_user` where email='".$email."' and block='yes';";
        $result2= mysqli_query($conn,$sql2);
        $out2 = mysqli_num_rows($result2);
        if($out>0 && $out2==0){
            $sql = " INSERT INTO `forget_password` (`email`, `random`, `validity`, `fin`) 
                    VALUES ('$email', '$random',300, '$endTime');";
                    $result= mysqli_query($conn,$sql);
                    if($result){
                      $sender = $email;
                      $recipient = 'webaljadd@gmail.com';
                      $subject = "Reservation_INPT password reset";
                      $sql = "SELECT concat(if(gender='M','Mr ','Mme '),prof.prenom) as name from prof  where email='".$email."';";
                      $result=mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $myGuess=$row['name'] ;
                        }
                        $date = strtotime("now");
                        $myHour = date('H', $date);
                        if($myHour<18 && $myHour>5){
                          $bonjour='Bonjour';
                          $bon = 'Bonne journée';
                        }
                        else{
                          $bonjour='Bonsoir';
                          $bon = 'Bonne soirée';
                        }
                        $head = '<h4>On '.date('j F o').', at '.date('H:i').',<h4>';
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From:' . $sender;
                        $txt = "<h4>Votre code est : <span style='color:red'>".$random."</span><h4>";
                        $message = $head ." <br><h4>".$bonjour." ".$myGuess.",<h4><br>
                        <h4>Veuillez copier le code ci-dessous pour réinitialiser votre mot de passe.
                        Le code expirera dans 5 minutes . <h4>"."\n\n".$txt."
                        Si les cinq minutes sont passées, vous pouvez cliquer sur le bouton renvoyer pour obtenir un autre code.
                        <br><br>Si vous rencontrez des problèmes, veuillez envoyer un message à cet e-mail mohammedaljadd8@gmail.com.<br><br>".$bon.".<br><br>Administration INPT.
                        <br>https://www.inpt.ac.ma/<br>" ;
                        if(mail($recipient, $subject, $message, $headers)){
                            $_SESSION['randomSent'] = "Un code a été envoyé à votre email, veuillez le copier ci-dessous";
                            header("Location:enterRandom.php");
                        }
                        else{
                          echo 'no sent mail';
                        }
                    }
                    
                                    
        }
        elseif($out2>0){
          $_SESSION['emailError']="Vous ne pouvez pas réinitialiser le mot de passe pendant les 2 heures suivantes, car vous n'avez pas entré le bon code de réinitialisation du mot de passe pendant 10 tentatives !";
          header("Location:login.php");
        }
        else{
          $_SESSION['emailError']=" L'email saisi n'existe pas, merci de saisir un email valide";
          header("Location:forgetPass.php");
        }
    }

    if(isset($_POST['submit_code'])){
        $randomUser = $_POST['random'];
        $emaiL = $_SESSION['email_forget'];
        $sql1 = "select * from forget_password where email='".$emaiL."';";
        $result1= mysqli_query($conn,$sql1);
        $out1 = mysqli_num_rows($result1);
        $sql = "select * from forget_password where email='".$emaiL."' and random='".$randomUser."';";
        $result= mysqli_query($conn,$sql);
        $out = mysqli_num_rows($result);
        
        if($out>0){
          $_SESSION['changePass'] = "Vous pouvez maintenant changer votre mot de passe";
          header("Location:resetPass.php");
        }
        elseif($out1==0){
          $_SESSION['wrongRandom'] = "Les 5 minutes sont passées, veuillez cliquer sur le bouton Renvoyer pour obtenir un nouveau code";
          header("Location:enterRandom.php");
        }
        else{
          $sql = "select * from  `blocked_user` where email='".$emaiL."';";
          $result= mysqli_query($conn,$sql);
          $out = mysqli_num_rows($result);
          $lastAttemp = date("Y-m-d H:i:s");
          $lastAttemp = strtotime($lastAttemp);
          $lastAttemp = $lastAttemp-3600;
          $lastAttemp = date("Y-m-d H:i:s",$lastAttemp);
          if($out>0){
            while($row = mysqli_fetch_assoc($result)){
              $attempts=$row['attempts'] ;
          }
          $newAttempts = $attempts+1;
          $sql="UPDATE blocked_user set attempts='$newAttempts',lastAttemp='$lastAttemp' WHERE email='".$emaiL."';";
          $result=mysqli_query($conn,$sql);
          

          }
          else{
            
            $sql = "INSERT INTO `blocked_user` (`email`, `attempts`,`lastAttemp`,block_time) VALUES ('$emaiL',1,'$lastAttemp',1);";
            $result= mysqli_query($conn,$sql);
          }
          $email = $_SESSION['email_forget'];
          $ten=11;
          $sql2 = "select * from  `blocked_user` where email='".$email."';";
          $result2= mysqli_query($conn,$sql2);
          while($row2 = mysqli_fetch_assoc($result2)){
            $attempt=$row2['attempts'] ;
        }
          if($attempt==11){

              $subject = "Password reset block";
              $sql = "SELECT concat(if(gender='M','Mr ','Mme '),prof.prenom) as name from prof  where email='".$email."';";
              $result=mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $myGuess=$row['name'] ;
                }
                $date = strtotime("now");
                $myHour = date('H', $date);
                if($myHour<18 && $myHour>5){
                  $bonjour='Bonjour';
                  $bon = 'Bonne journée';
                }
                else{
                  $bonjour='Bonsoir';
                  $bon = 'Bonne soirée';
                }

              $head = '<h4>On '.date('j F o').', at '.date('H:i').',<h4>';
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $headers .= 'From: aljadd700@gmail.com';
              $recipient='webaljadd@gmail.com';
              $message = $head ." <br><h4>".$bonjour." ".$myGuess.",<h4><br>
              <h4>Votre compte est  <span style='color:red'>bloqué</span> en ce moment contre la réinitialisation du mot de passe 
              en raison de l'échec de la saisie du code envoyé correct pendant 10 tentatives . <h4>"."\n\n
              Si vous qui tentiez de réinitialiser le mot de passe, veuillez nous le faire savoir pour vous débloquer et vous donner un nouveau mot de passe.
              <br><br>Veuillez envoyer un message à cet e-mail mohammedaljadd8@gmail.com.<br><br>".$bon.".<br><br>Administration INPT.
              <br>https://www.inpt.ac.ma/<br>";
              if(mail($recipient, $subject, $message, $headers)){
                $_SESSION['outOFreset']="Vous ne pouvez pas réinitialiser le mot de passe pendant les 2 heures suivantes, car vous n'avez pas entré le bon code de réinitialisation du mot de passe pendant 10 tentatives !";
                header("Location:login.php");
              }
              else{
                  echo 'cawalima';
              }
              
            }
          else{
            $_SESSION['wrongRandom'] = "Le code que vous avez entrer est incorrect, veuillez entrer le code valide";
            header("Location:enterRandom.php?wrongitp");
          }
            
        }
        

    }


    if(isset($_POST['Recode'])){
        $email = $_SESSION['email_forget'];
        $sql = "delete from forget_password where email='".$email."'";
        $result= mysqli_query($conn,$sql);
        if($result){
          echo "delete";
        }
        else{
          echo 'no delete';
        }
        $random =  rand(1000000,9999999);
        $endTimeSeconds = strtotime("now")+315-3600; //3ndna mochkil zid sa3a n9ess sa3a
        $endTime=date("Y-m-d H:i:s",$endTimeSeconds);
            $sql = " INSERT INTO `forget_password` (`email`, `random`, `validity`, `fin`) 
                    VALUES ('$email', '$random',300, '$endTime');";
                    $result= mysqli_query($conn,$sql);
                    if($result){
                      $sender = $email;
                      $recipient = 'webaljadd@gmail.com';
                      $subject = "Reservation_INPT password reset";
                      $sql = "SELECT concat(if(gender='M','Mr ','Mme '),prof.prenom) as name from prof  where email='".$email."';";
                      $result=mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $myGuess=$row['name'] ;
                        }
                        $date = strtotime("now");
                        $myHour = date('H', $date);
                        if($myHour<18 && $myHour>5){
                          $bonjour='Bonjour';
                          $bon = 'Bonne journée';
                        }
                        else{
                          $bonjour='Bonsoir';
                          $bon = 'Bonne soirée';
                        }
                        $head = '<h4>On '.date('j F o').', at '.date('H:i').',<h4>';
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From:' . $sender;
                        $txt = "<h4>Votre code est : <span style='color:red'>".$random."</span><h4>";
                        $message = $head ." <br><h4>".$bonjour." ".$myGuess.",<h4><br>
                        <h4>Veuillez copier le code ci-dessous pour réinitialiser votre mot de passe.
                        Le code expirera dans 5 minutes . <h4>"."\n\n".$txt."
                        Si les cinq minutes sont passées, vous pouvez cliquer sur le bouton renvoyer pour obtenir un autre code.
                        <br><br>Si vous rencontrez des problèmes, veuillez envoyer un message à cet e-mail mohammedaljadd8@gmail.com.<br><br>".$bon.".<br><br>Administration INPT.
                        <br>https://www.inpt.ac.ma/<br>" ;
                        if(mail($recipient, $subject, $message, $headers)){
                            $_SESSION['randomSent'] = "Le code a été renvoyé à votre email, veuillez le copier ci-dessous";
                            header("Location:enterRandom.php");
                        }
                    }
                  }
                  
                    
                                    
        
        
  