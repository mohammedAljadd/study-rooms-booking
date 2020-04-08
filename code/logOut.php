<?php
    if(isset($_POST['logout'])){
        session_start();
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['logOut']=1;
        header("Location:login.php");
    
    }
?>
