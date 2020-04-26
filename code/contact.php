
<?php
session_start();
$expireAfter = 15;
if(isset($_SESSION['last_action'])){
    $secondsInactive = time() - $_SESSION['last_action'];
    $expireAfterSeconds = $expireAfter * 60;
    if($secondsInactive >= $expireAfterSeconds){
        ?>
            <script>
                alert("La session a expiré, veuillez vous reconnecter!");
            </script>
                <?php
                    session_unset();
                    session_destroy();
    }}
    $_SESSION['last_action'] = time();
?>
<?php
        if(isset($_SESSION['email']))
        {
?>



<?php
    include 'includes/dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/shared-css.css">
    <link rel="stylesheet" href="css/welcom.css">
    <title>Contact me</title>
</head>
<body>
<img src="img/Go.png" alt="" height="70" width="260" id="go">
<div class="headache">
        <ul  >
            <a href="home.php">Home</a>
            <a href="reservation.php">Reservation</a>
            <a href="password.php">Compte</a>
            <a href="contact.php">Contact</a>
        </ul>
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
    

    
    <h1>Contact me</h1>
    
    <div class="box">
        <form action="contact_check.php" method="POST">
            <input name="smya"  type="text" placeholder="Full name">
            <input  name="subject" type="text" placeholder="Subject">
            <textarea  name="message" name="" id="" cols="40" rows="8" placeholder="Any Problems ?" ></textarea>
            <span class="subset" > <input type="submit"  name="submit">   </span>      <span class="subset" > <input type="reset" value="reset"></span>       
        </form>
    </div>    
</body>
</html>
<?php
    if(isset($_SESSION['contact'])){
?>
<script>
    var a = "<?php echo $_SESSION['contact']  ?>";
    alert(a);
</script>
<?php
unset($_SESSION['contact']);
    }
?>

<?php
        }
        else{
            include 'login.php';
        }
?>
