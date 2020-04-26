<?php
if($_POST['submit']){
    session_start();
    $name=$_POST['smya'];
    $email=$_SESSION['email'];
    $subject=$_POST['subject'];
    $txt=$_POST['message'];
    if(empty($name) || empty($subject) || empty($txt)){
        $_SESSION['contact'] = 'Champs vides';
        header("Location:contact.php");
    }

    else{
        $sender = $email;
        $recipient = 'mohammedaljadd8@gmail.com';

        $subject = "Un message de ".$name." envoyé depuis la page de réservation";

        $headers = 'From:' . $sender;
       
        $message = "Vous avez reçu un message de ".$sender."\n\n".$txt;
        if(mail($recipient, $subject, $message, $headers)){
            $_SESSION['contact'] = 'Courrier envoyé avec succès, Nous vous répondrons dès que possible!';
            header("Location:contact.php");
        }
}
}
?>
