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
                      header("Location:enterRandom.php");
                  }
                }
                else{
                  echo 'Noo';
                }
                                
    }
}

if(isset($_POST['submit_code'])){
    $randomUser = $_POST['random'];
    $emaiL = $_SESSION['email_forget'];
    $sql = "select * from forget_password where email='".$emaiL."' and random='".$randomUser."';";
    $result= mysqli_query($conn,$sql);
    $out = mysqli_num_rows($result);
    if($out>0){
      header("Location:resetPass.php");
    }
    else{
      echo 'noo';
    }

}