<?php
session_start();
include 'includes/dbconn.php';
if(isset($_POST['email_forget'])){
    $email = $_SESSION['email_forget']=$_POST['email_forget'] ;
    $random =  rand(1000000,9999999);
    $sql = "select email from prof where email='".$email."';";
    $endTimeSeconds = strtotime("now")+300;
    $endTime=date("Y-m-d h:m:s",$endTimeSeconds);
    $result= mysqli_query($conn,$sql);
    $out = mysqli_num_rows($result);
    if($out>0){
        $sql = " INSERT INTO `forget_password` (`email`, `random`, `validity`, `fin`) 
                VALUES ('$email', '$random',300, '$endTime');";
                $result= mysqli_query($conn,$sql);
                if($result){
                  $sender = $email;
                  $recipient = 'webaljadd@gmail.com';
                  $subject = "Reservation_INPT password reset";

                  $headers = 'From:' . $sender;
                  $txt = "Votre code est :".$random;
                  $message = "Bonjour,
                  veuillez copier le code ci-dessous pour réinitialiser votre mot de passe.
                  Le code expirera dans les 5 minutes  "."\n\n".$txt;
                  if(mail($recipient, $subject, $message, $headers)){
                      $_SESSION['randomSent'] = "Un code a été envoyé à votre email, veuillez le copier ci-dessous";
                      header("Location:enterRandom.php");
                  }
                }
                
                                
    }
    else{
      $_SESSION['emailError']=" L'email saisi n'existe pas, merci de saisir un email valide";
                  header("Location:forgetPass.php");
    }
}

if(isset($_POST['submit_code'])){
    $randomUser = $_POST['random'];
    $emaiL = $_SESSION['email_forget'];
    $sql = "select * from forget_password where email='".$emaiL."' and random='".$randomUser."';";
    $result= mysqli_query($conn,$sql);
    $out = mysqli_num_rows($result);
    if($out>0){
      $_SESSION['changePass'] = "Vous pouvez maintenant changer votre mot de passe";
      header("Location:resetPass.php");
    }
    else{
      $_SESSION['wrongRandom'] = "Le code que vous avez entrer est incorrect, veuillez entrer le code valide";
      header("Location:enterRandom.php?wrongitp");
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
    $endTimeSeconds = strtotime("now")+300;
    $endTime=date("Y-m-d h:m:s",$endTimeSeconds);
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
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From:' . $sender;
                    $txt = "<h4>Votre code est : <span style='color:red'>".$random."</span><h4>";
                    $message = "<h4>".$bonjour." ".$myGuess.",<h4><br>
                    <h4>Veuillez copier le code ci-dessous pour réinitialiser votre mot de passe.<h4>
                    <h4>Le code expirera dans 5 minutes.  <h4>"."\n\n".$txt."
                    Si les cinq minutes sont passées, vous pouvez cliquer sur le bouton renvoyer pour obtenir un autre code.
                    <br><br>si vous rencontrez des problèmes, veuillez envoyer un message à cet e-mail mohammedaljadd8@gmail.com<br><br>".$bon.".<br><br>Administration INPT." ;
                    if(mail($recipient, $subject, $message, $headers)){
                        $_SESSION['randomSent'] = "Un code a été envoyé à votre email, veuillez le copier ci-dessous";
                        header("Location:enterRandom.php");
                    }
                }
                
                                
    }
    else{
      echo 'asd';
    }
