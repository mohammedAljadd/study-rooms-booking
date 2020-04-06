<?php
    session_start();
    include 'includes/dbconn.php';
        if(isset($_SESSION['email']))
        {
            $email = $_SESSION['email'];
            $sql = "SELECT concat(if(gender='M','Mr ','Mme '),prof.prenom) as name from prof  where email='".$email."';";
            $result=mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $_SESSION['guess']=$row['name'] ;
                }
?>
<?php
    
    if(isset($_SESSION['welcome']))
    {
?>
    <script>

    var myDate = new Date();
    var dateHour = myDate.getHours();
    if(dateHour<18){
        var guess = "<?php echo $_SESSION['guess'] ?>";
        alert('Bonjour '+guess+'!');
    }
    else{
        alert('Bonsoir '+guess+'!');
    }
    </script>
<?php
    }
    unset($_SESSION['welcome']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/welcom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home</title>
</head>
<body>
            
<img src="img/Go.png" alt="" height="70" width="260" id="go">
<div class="headache">
<?php
    if($_SESSION['email']!="aljadd.mohammed@ine.inpt.ma"){

?>
        <ul  >
            <a href="home.php">Home</a>
            <a href="reservation.php">Reservation</a>
            <a href="password.php">Compte</a>
            <a href="contact.php">Contact</a>
        </ul>
<?php
    }
    else{
?>

    <ul  >
    
            <a href="home.php">Home</a>
            <a href="reservation.php">Reservation</a>
            <a href="password.php">Compte</a>
            <a href="updateUser.php">Modify users</a>
            
        </ul>
        <?php
    }
        ?>





        <div class="welcom">
        <?php
        
            if(isset($_SESSION['email'])){
                    
                $user =$_SESSION['email'];
                $sql = "SELECT nom,prenom FROM `prof`where email='".$user."';";
                $result = mysqli_query($conn,$sql);
                $out = mysqli_num_rows($result);
                if($out>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "Welcome ".$row['nom']." ".$row['prenom'];
                    }
                }
            }

            else{
                echo "Welcom,Please Sign Up";
            }
            
        ?>
        <?php
            if(isset($_SESSION['email']))
            {
            ?>
                <div class="logout">
                    <form action="logOut.php" method="post" >
                    <button name="logout" type="submit">Log Out!</button>
                    </form>
                </div>
    <?php
        }
    ?>
        
</div>
    
    </div>



    <div class="box" >
    <h1>Quote</h1> <br>
    <div class="maqola">
        “The art of reading and studying consists <br> 
        in remembering the essentials and forgetting <br>
        what is not essential.” <br>
                Adolf Hitler, Mein Kampf.
    </div>

</div>
<div class="icon-bar">
    <ul>
        <a  target="blank" href="https://www.facebook.com/www.inpt.ac.ma/" class="facebook"><i class="fa fa-facebook"></i></a>
    <br> <a  target="blank" href="https://twitter.com/INPTRabat" class="twitter"><i class="fa fa-twitter"></i></a>
    <br> <a  target="blank" href="https://www.instagram.com/inptrabat/?hl=fr" class="google"><i class="fa fa-instagram"></i></a>
    <br> <a  target="blank" href="https://www.linkedin.com/company/institut-national-postes-telecommunications/" class="linkedin"><i class="fa fa-linkedin"></i></a>
    <br> <a  target="blank" href="https://www.youtube.com/channel/UCxAjpRybUJvXuin_61UqG_w" class="youtube"><i class="fa fa-youtube"></i></a>  
</div>
</ul>
<br>



<div class="last" >
<footer>

    <div id="mohamed">
        <h2>Mr. Mohammed<br>AL JADD</h2>
        <ul >
            <li><i class="fa fa-envelope"></i> email: aljadd.mohammed@ine.inpt.ma</li>
            <li><i class="fa fa-phone"></i> Tél: +212 696 40 51 50 </li>
        </ul>
        <div class="rights">
        Copyright © 2020 bookingINPT All rights reserved
        </div>
    </div>
</footer>
<img  class="logo" src="img/logo.png" height="50" width="100">
</div>





</body>
</html>
<?php
        }
        else{
            include 'login.php';
        }
?>