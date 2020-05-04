<?php
    if(isset($_POST['submit'])){
        session_start();
        include 'includes/dbconn.php';
        $_SESSION['name']=$name = $_POST['nom']; 
        $_SESSION['prenom']=$prenom = $_POST['prenom'];
        $_SESSION['password']=$password = $_POST['password'];
        $_SESSION['emailToadd']=$email = $_POST['email'];
        $_SESSION['gender']=$gender = $_POST['gender'];
        $sql = "SELECT * FROM `prof` WHERE email='".$email."';";
        $result = mysqli_query($conn,$sql);
        $out = mysqli_num_rows($result);
        
        if( empty($prenom) ||  empty($password) || empty($email) || empty($gender) ){
            $_SESSION['errorModify'] = 'Champs vides';
            header("location:updateUser.php");
        }

        elseif($email != "aljadd.mohammed@ine.inpt.ma"){

        if($out==0){
            $_SESSION['add']='add';
            header("location:updateUser.php");
        }
        else{
            $_SESSION['errorModify'] = 'L\'email existait déjà';
            header("location:updateUser.php?Error");
        }
    }
    else{
        $_SESSION['errorModify'] = 'Vous ne pouvez pas utiliser votre e-mail';
        header("location:updateUser.php");
    }
    
    }


?>
<?php
if(isset($_POST['delete'])){
    session_start();
    include 'includes/dbconn.php';
    $email = $_POST['delete'];
    $sql = "SELECT * FROM `prof` WHERE email='".$email."';";
    $result = mysqli_query($conn,$sql);
    while( $out = mysqli_fetch_array($result)){
        $_SESSION['nameRM'] = $out['nom']; 
        $_SESSION['prenomRM'] = $out['prenom'];
    }
        $_SESSION['emailToremove'] = $_POST['delete'];
        $_SESSION['remove'] = 'gonna be removed';
        header("location:updateUser.php");
    

}
?>
<?php
if(isset($_POST['activate'])){
    session_start();
    include 'includes/dbconn.php';
    $email = $_POST['activate'];
    $sql = "SELECT * FROM `prof` WHERE email='".$email."';";
    $result = mysqli_query($conn,$sql);
    while( $out = mysqli_fetch_array($result)){
        $_SESSION['nameAC'] = $out['nom']; 
        $_SESSION['prenomAC'] = $out['prenom'];
    }
        $_SESSION['emailToactive'] = $_POST['activate'];
        $_SESSION['active'] = 'gonna be activated';
        header("location:updateUser.php");
    

}



?>