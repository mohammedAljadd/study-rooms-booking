
<?php
session_start();
if(isset($_POST['submit'])){
    include 'includes/dbconn.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        $_SESSION['loginError']=1;
        header("location:login.php?error=emptyfields");
        exit();
    }

    else{
        $sql="SELECT email , password FROM prof WHERE email='".$email."' and password='".$password."';";
        $result=mysqli_query($conn,$sql);
        $out = mysqli_num_rows($result);
        
            if($out > 0){
                $_SESSION['email']=$_POST['email'];
                $sql="SELECT idProf FROM prof WHERE email='".$email."' and password='".$password."';";
                $result=mysqli_query($conn,$sql);
                $out = mysqli_num_rows($result);
                if($out>0){
                    $_SESSION['welcome']=1;
                    header("location:home.php");
                    $sql="SELECT idProf FROM prof WHERE email='".$email."' and password='".$password."';";
                $result=mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $_SESSION['idprof']=$row['idProf'] ;
                }
                }
                
            }
            
            else {
                $_SESSION['loginError']=2;
                header("location:login.php"); 
            }

    }

}

else {
    header("location:login.php?error=didn't submit"); 
}

?>
