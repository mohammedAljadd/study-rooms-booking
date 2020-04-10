<?php
    if(isset($_POST['submit'])){
        session_start();
        include 'includes/dbconn.php';
        $_SESSION['name']=$name = $_POST['nom']; 
        $_SESSION['prenom']=$prenom = $_POST['prenom'];
        $_SESSION['password']=$password = $_POST['password'];
        $_SESSION['emailToremove']=$email = $_POST['email'];
        $_SESSION['gender']=$gender = $_POST['gender'];
        $_SESSION['modify']=$modify = $_POST['modify'];
        $sql = "SELECT * FROM `prof` WHERE email='".$email."' and nom='".$name ."' and password='".$password."' and prenom='".$prenom."';";
        $result = mysqli_query($conn,$sql);
        $out = mysqli_num_rows($result);
        
        if( empty($modify) ||  empty($prenom) ||  empty($modify) ||  empty($password) || empty($email) || empty($modify) ){
            header("location:updateUser.php?empty");
        }

        elseif($email != "aljadd.mohammed@ine.inpt.ma"){

        if($_POST['modify']=="add" && !empty($_POST['gender'])){
            $_SESSION['add']='add';
            header("location:updateUser.php");
        }
        elseif($out>0 && $_POST['modify']=="remove"){
            $_SESSION['remove']='remove';
            header("location:updateUser.php");
        }
        else{
            header("location:updateUser.php?Error");
        }
    }
    else{
        header("location:updateUser.php?cannot_use_your_email");
    }
    

    }


?>