<?php
session_start();
include 'includes/dbconn.php';
$name=$_SESSION['name']; 
$prenom =$_SESSION['prenom'];
$password =$_SESSION['password'];
$password = md5($password);
$email = $_SESSION['emailToadd'];
$gender =$_SESSION['gender'];
$sql = "SELECT (idProf+1) newID FROM prof ORDER BY idProf DESC LIMIT 1;";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $newId = $row['newID'];
}
$sql = "INSERT INTO `prof` (`idProf`,`nom`, `prenom`, `email`, `password`,`gender`) VALUES ('$newId','$name', '$prenom', '$email', '$password','$gender') ;";
$result = mysqli_query($conn,$sql);
if($result){
    $_SESSION['added']='added';
    header("location:updateUser.php?Done");
}
else{
    header("location:updateUser.php?nooooooooooo");
}
?>