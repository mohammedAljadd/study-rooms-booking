<?php
session_start();
include 'includes/dbconn.php';
$email = $_SESSION['emailToremove'];
$sql = "SELECT idProf FROM `prof` WHERE email='".$email."' ;";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $oldId = $row['idProf'];
}
$sql = "DELETE FROM `prof` WHERE email='".$email."';";
$result = mysqli_query($conn,$sql);
$sql = "UPDATE prof set  idProf = idProf-1 WHERE idProf >'".$oldId."';";
$result = mysqli_query($conn,$sql);
$_SESSION['removed']='removed';
header("location:updateUser.php?Done");
?>