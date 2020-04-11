<?php
if($_POST['submit']){
    session_start();
    $name=$_POST['smya'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    if(empty($name) || empty($email) || empty($subject) || empty($message)){
        $_SESSION['contact'] = 'Champs vides';
        header("Location:contact.php");
    }

    else{
        $mailTo = "aljadd.mohammed@ine.inpt.ma";
        $headers = "From: ".$email;
        $txt = "You received e-mail from ".$name.".\n\n".$message;
        mail($mailTo ,$subject,$txt,$headers);
        $_SESSION['contact'] = 'Courrier envoyé avec succès,Nous vous répondrons dès que possible!';
        header("Location:contact.php");
}
}
?>