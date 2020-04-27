
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/password.css">
    <link rel="stylesheet" href="css/shared-css.css">
    <link rel="stylesheet" href="css/welcom.css">
    
    
    <title>Change Password</title>
</head>
<body>
<?php
            if(session_id() == '') {
                session_start();
               }
        ?>
        
        <script>
            alert("<?php echo $_SESSION['changePass'] ?>");
        </script>
        
<?php
    unset($_SESSION['changePass']);
?>
    

<div class="box" >
<br>
        <h1>Changer votre mot de pass</h1>
        <br><br>
        <form action="resetPass.php" method="post">
            <input type="password" placeholder="le nouveau Mot de pass" name="newPass">
            <input type="password"  placeholder="retaper le nouveau Mot de pass" name="newPassR">            
            <span> <input type="submit" value="changer" name="submit"> </span> <span> <input type="reset"> </span>
        </form>
    </div> 
    <?php
    include 'includes/dbconn.php';
    if(isset($_POST['submit'])){
        $newPass = $_POST['newPass'];
        $newPassR = $_POST['newPassR'];
        $email = $_SESSION['email_forget'];
        if($newPass==$newPassR){
            $sql="DELETE from forget_password where email='".$email."';";
            $result=mysqli_query($conn,$sql);
            $sql="UPDATE prof set password='$newPass' WHERE email='".$email."';";
            $result=mysqli_query($conn,$sql);
            if($result){
                $_SESSION['email'] = $_SESSION['email_forget'];
                $_SESSION['noForget'] = "Votre mot de passe a été changé avec succès";
                header("location:home.php");
            }
        }
}