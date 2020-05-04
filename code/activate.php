<?php
session_start();
include 'includes/dbconn.php';
$email = $_SESSION['emailToactive'];
$sql = "DELETE FROM `blocked_user` WHERE email='".$email."' ;";
$result = mysqli_query($conn,$sql);
$_SESSION['acivatt']='L\'utilisateur a été activé avec succès';
header("location:updateUser.php");