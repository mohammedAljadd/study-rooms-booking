<?php
session_start();
include 'includes/dbconn.php';
$name=$_SESSION['name']; 
$prenom =$_SESSION['prenom'];
$password =$_SESSION['password'];
$password = md5($password);
$email = $_SESSION['emailToremove'];
$gender =$_SESSION['gender'];
$sql = "INSERT INTO `prof` (`nom`, `prenom`, `email`, `password`,`gender`) VALUES ('$name', '$prenom', '$email', '$password','$gender') ;";
$result = mysqli_query($conn,$sql);
if($result){
    $_SESSION['added']='added';
    header("location:updateUser.php?Done");
}
else{
    header("location:updateUser.php?nooooooooooo");
}
?>