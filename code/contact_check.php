<?php
if($_POST['submit']){
    $name=$_POST['smya'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    if(empty($name) || empty($email) || empty($subject) || empty($message)){
        header("Location:contact.php?emptyFields");
    }

    else{
        $mailTo = "aljadd.mohammed@ine.inpt.ma";
        $headers = "From: ".$email;
        $txt = "You received e-mail from ".$name.".\n\n".$message;
        mail($mailTo ,$subject,$txt,$headers);
        header("Location:contact.php?mailsent");
}
}
?>