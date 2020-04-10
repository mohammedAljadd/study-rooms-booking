<?php
session_start();
include 'includes/dbconn.php';
$email = $_SESSION['emailToremove'];
$sql = "DELETE FROM `prof` WHERE email='".$email."' ;";
$result = mysqli_query($conn,$sql);
$_SESSION['removed']='removed';
header("location:updateUser.php?Done");
?>