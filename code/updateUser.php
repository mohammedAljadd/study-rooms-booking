<?php
if(session_id() == '') {
    session_start();
   }
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
        if(isset($_SESSION['email']) && $_SESSION['email']=="aljadd.mohammed@ine.inpt.ma")
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
    <link rel="stylesheet" href="css/modify.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Modify</title>
</head>
<body>
<img src="img/Go.png" alt="" height="70" width="260" id="go">
<div class="headacheAdmin">
<ul  >

            <a href="home.php">Home</a>
            <a href="reservation.php">Reservation</a>
            <a href="password.php">Compte</a>
            <a href="updateUser.php">Modify users</a>
            <a href="affectation.php">Affectation</a>
        </ul>
</div>
<style>
table{
    position:relative;
    left:60px;
    top:30px;
}

</style>
<div class="boxw">
<h1>Users</h1>
<table border="1">
<tr>
    <th  style='color:rgb(174, 197, 251)'>Nom</th>
    <th  style='color:rgb(174, 197, 251)'>Prenom</th>
    <th  style='color:rgb(174, 197, 251)'>Email</th>
</tr>
<?php
    $sql = " SELECT * FROM `prof`;";
    $result = mysqli_query($conn,$sql);
    $out = mysqli_num_rows($result);
    if($out>0){
        while($row = mysqli_fetch_assoc($result)){
            if($row['email']=='aljadd.mohammed@ine.inpt.ma')
            echo "<tr>
                <th style='color:rgb(255, 104, 104)'>".$row['nom']."</th>  <th style='color:rgb(255, 104, 104)'>".$row['prenom']."</th>
                <th style='color:rgb(255, 104, 104)'>".$row['email']."</th> 
                </tr>";
                else{
                    echo "<tr>
                    <th>".$row['nom']."</th>  <th>".$row['prenom']."</th>
                    <th>".$row['email']."</th> 
                    </tr>";
                }
        }
    }

?>
</table>

</div>
    


    <div class="boxMe">
        <h1>Modify</h1>
    
    <form action="modify_check.php" method="POST" >
        <input type="text" placeholder="nom"  name="nom" > 
        <input type="text" placeholder="prenom" name="prenom" > 
        <input type="text" placeholder="Email" name="email" > 
        <input type="password" placeholder="Password" name="password" >
        <input type="radio" name="gender" value="M"> Male
        <input type="radio" name="gender" value="F"> Female<br>
        
        <input type="radio"  name="modify" value="add">
        <label for="add"> Add </label>
            
        <input type="radio" name="modify"  value="remove">
        <label for="remove"> Remove </label>
        <br>
        <span class="subset" > <input type="submit" name="submit" >   </span>      <span class="subset" > <input type="reset" value="reset"></span> 
    </form>
    

    </div>
</body>
</html>
<?php
    
    if(isset($_SESSION['add'])){
        ?>
                <script language="javascript"> 
                    if(confirm("Voulez-vous vraiment ajouter le nouvel utilisateur?")){
                        window.location.href='addCode.php';
                    } 
                </script>
        <?php
    }
    elseif(isset($_SESSION['remove'])){
        ?>
        <script>
        if(confirm("Voulez-vous vraiment supprimer l'utilisateur <?php  echo "' ".$_SESSION['name'].' '.$_SESSION['prenom']." '"  ?>?")){
            window.location.href='removeCode.php';
        }
     </script>
     <?php 
    } 
    ?>
    <?php
    if(isset($_SESSION['added'])){
        ?>
            <script language="javascript">
            alert("le nouvel utilisateur<?php  echo "<".$_SESSION['name'].' '.$_SESSION['prenom'].">"  ?> a été ajouté avec succès!");
            </script>
        <?php
    }
    if(isset($_SESSION['removed'])){
        ?>
            <script language="javascript">
            alert("l'utilisateur  <?php  echo "' ".$_SESSION['name'].' '.$_SESSION['prenom']." '"  ?> a été supprimé avec succès!");
            </script>
        <?php
    }
?>
<?php
    if(isset($_SESSION['errorModify'])){
        ?>
            <script language="javascript">
            alert("<?php echo $_SESSION['errorModify']." !"  ?>");
            </script>
        <?php
    }
    ?>



<?php
    unset($_SESSION['add']);
    unset($_SESSION['remove']);
    unset($_SESSION['added']);
    unset($_SESSION['removed']);
    unset($_SESSION['errorModify']);
?>

<?php
        }
        elseif(!isset($_SESSION['email'])){
            include 'login.php';
        }
        elseif($_SESSION['email']!="aljadd.mohammed@ine.inpt.ma"){
            ?>

            <script>
                alert("Vous n\'êtes pas autorisé à visiter cette page Web car vous n\'êtes pas l\'administrateur. Merci!");
            </script>
            <script>
                window.location.replace("login.php");
            </script>
            <?php
            session_start();
            session_unset();
            session_destroy();
        }
?>
