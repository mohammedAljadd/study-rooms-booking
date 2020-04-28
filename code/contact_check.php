<?php
if($_POST['submit']){
    session_start();
    $name=$_POST['smya'];
    $email=$_SESSION['email'];
    $Subject=$_POST['subject'];
    $txt=$_POST['message'];
    if(empty($name) || empty($Subject) || empty($txt)){
        $_SESSION['contact'] = 'Champs vides';
        header("Location:contact.php");
    }

    else{
        $sender = $email;
        $recipient = 'webaljadd@gmail.com';

        $subject = 'Reservation_contact :'.$Subject;

        $headers = 'From:' . $sender;
       
        $message = "Vous avez reçu un message de ".$name.' '.$sender."\n\n".$txt;
        if(mail($recipient, $subject, $message, $headers)){
            $_SESSION['contact'] = 'Courrier envoyé avec succès, Nous vous répondrons dès que possible!';
            header("Location:contact.php");
        }
}
}
?>
