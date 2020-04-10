<?php
session_start();
$email = $_SESSION['emailToremove'];
$sql = "DELETE FROM `prof` WHERE email='".$email."' ;";
$result = mysqli_query($conn,$sql);
header("location:updateUser.php?Done");
?>