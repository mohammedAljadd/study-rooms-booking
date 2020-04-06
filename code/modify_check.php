<?php
    if(isset($_POST['submit'])){
        include 'includes/dbconn.php';
        $name = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $modify = $_POST['modify'];
        $sql = "SELECT * FROM `prof` WHERE email='".$email."' and nom='".$name."' and password='".$password."' and prenom='".$prenom."';";
        $result = mysqli_query($conn,$sql);
        $out = mysqli_num_rows($result);
        
        if( empty($modify) ||  empty($prenom) ||  empty($modify) ||  empty($password) || empty($email) || empty($modify) ){
            header("location:updateUser.php?empty");
        }

        elseif($email != "aljadd.mohammed@ine.inpt.ma"){

        if($_POST['modify']=="add" && !empty($_POST['gender'])){
            $sql = "INSERT INTO `prof` (`nom`, `prenom`, `email`, `password`,`gender`) VALUES ('$name', '$prenom', '$email', '$password','$gender') ;";
            $result = mysqli_query($conn,$sql);
            header("location:updateUser.php?Done");
        }
        elseif($out>0 && $_POST['modify']=="remove"){
            $sql = "DELETE FROM `prof` WHERE email='".$email."' ;";
            $result = mysqli_query($conn,$sql);
            header("location:updateUser.php?Done");
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