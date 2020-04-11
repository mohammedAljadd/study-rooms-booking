<?php
session_start();
include 'includes/dbconn.php';
    if(isset($_POST['submit'])){
        
        $pass = $_POST['pass'];
        $newPass = $_POST['newPass'];
        $newPassR = $_POST['newPassR'];
        $email = $_SESSION['email'];
        echo $pass;


        if( empty($newPassR) || empty($newPass) || empty($pass)){
            $_SESSION['pass'] = 'Champs vides';
            header("location:password.php");
        }




        else{
                    $sql="SELECT email , password FROM prof WHERE email='".$email."' and password='".$pass."';";
                    $result=mysqli_query($conn,$sql);
                    $out = mysqli_num_rows($result);
                    if($out > 0){
                        if($newPass==$newPassR){
                            $sql="UPDATE prof set password='$newPass' WHERE email='".$email."' and password='".$pass."';";
                            
                            $result=mysqli_query($conn,$sql);
                            if($result){
                                $_SESSION['pass'] = 'Mot de passe changé';
                                header("location:password.php");
                            }
                            else{
                            header("location:password.php?somethingWrong");
                        }
                        }
                        else{
                            $_SESSION['pass'] = 'Les mots de passe ne correspondent pas';
                            header("location:password.php");
                        }
                        
                    }
                    else{
                        $_SESSION['pass'] = 'Mot de passe incorrect, veuillez réessayer';
                        header("location:password.php");
                    }



            }

        }
?>