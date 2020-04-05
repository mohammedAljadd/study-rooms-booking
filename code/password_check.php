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
            header("location:password.php?emptyField");
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
                                header("location:password.php?passwordChanged");
                            }
                            else{
                            header("location:password.php?somethingWrong");
                        }
                        }
                        else{
                            header("location:password.php?passwordDoesntMatch");
                        }
                        
                    }
                    else{
                        header("location:password.php?wrongPassword".$email."____".$pass);
                    }



            }

        }
?>