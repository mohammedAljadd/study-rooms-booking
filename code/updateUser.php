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
    left:-5px;
    top:30px;
}
.activate button{
    border:1px solid white;
    padding:2px 5px;
    margin:3.5px 3.5px;
    outline: none;
    text-align: center;
    border-radius: 5px;
    background:none;
    color:#b8ff8c;
    font-family: Montserrat,sans-serif;
    transition: 750ms;
    }
    .activate button:hover{
        cursor:pointer;
        background-color: rgb(182, 206, 250,0.6);
    } 
button{
    border:1px solid white;
    padding:2px 5px;
    margin:3.5px 3.5px;
    outline: none;
    text-align: center;
    border-radius: 5px;
    background:none;
    color:white;
    font-family: Montserrat,sans-serif;
    transition: 750ms;
    }
    button:hover{
        cursor:pointer;
        background-color: rgb(255, 64, 64,0.6);
    }
</style>
<div class="boxw">
<h1>Users</h1>
<form method="POST" action="modify_check.php">
<table border="1">
<tr>
    <th  style='color:rgb(174, 197, 251)'>Nom</th>
    <th  style='color:rgb(174, 197, 251)'>Prenom</th>
    <th  style='color:rgb(174, 197, 251)'>Email</th>
    <th  style='color:rgb(174, 197, 251)'>Supprimer</th>
    <th  style='color:rgb(174, 197, 251)'>Activer</th>
</tr> 
<?php
    $sql = " SELECT prof.nom,prof.prenom,'' gender,prof.email,'' as block FROM prof WHERE idProf=1
    UNION
    SELECT prof.nom,prof.prenom,prof.gender,prof.email,blocked_user.block FROM `prof`,blocked_user WHERE blocked_user.email=prof.email and idProf!=1
        UNION 
        SELECT  prof.nom,prof.prenom,prof.gender,prof.email,'no' FROM `prof` WHERE prof.email not in (SELECT email FROM blocked_user) and idProf!=1 ORDER BY prenom;";
    $result = mysqli_query($conn,$sql);
    $out = mysqli_num_rows($result);
    if($out>0){
        while($row = mysqli_fetch_assoc($result)){
            if($row['email']=='aljadd.mohammed@ine.inpt.ma')
            echo "<tr>
                <th style='color:rgb(255, 104, 104)'>".$row['nom']."</th>  <th style='color:rgb(255, 104, 104)'>".$row['prenom']."</th>
                <th style='color:rgb(255, 104, 104)'>".$row['email']."</th> 
                </tr>";
            if($row['block']=='no'){
                    if($row['gender']=='M'){
                        $output = "<button name='delete' value='".$row['email']."' >supprimer</button>";
                        echo "<tr>
                        <th>".$row['nom']."</th>  <th>".$row['prenom']."</th>
                        <th>".$row['email']."</th> <th> ".$output." </th><th> activé</th>
                        </tr>";
                    }
                    elseif($row['gender']=='F'){
                        $output = "<button name='delete' value='".$row['email']."' >supprimer</button>";
                        echo "<tr>
                        <th style='color:rgb(255, 251, 138)'>".$row['nom']."</th>  <th style='color:rgb(255, 251, 138)'>".$row['prenom']."</th>
                        <th style='color:rgb(255, 251, 138)'>".$row['email']."</th> <th> ".$output." </th><th> activé</th>
                        </tr>";
                    }
                }
                else{
                    if($row['gender']=='M'){
                        $output = "<button name='delete' value='".$row['email']."' >supprimer</button>";
                        $activate = "<div class='activate'><button name='activate' value='".$row['email']."' >activer</button></div>";
                        echo "<tr>
                        <th>".$row['nom']."</th>  <th>".$row['prenom']."</th>
                        <th>".$row['email']."</th> <th> ".$output." </th> <th> ".$activate." </th> 
                        </tr>";
                    }
                    elseif($row['gender']=='F'){
                        $output = "<button name='delete' value='".$row['email']."' >supprimer</button>";
                        $activate = "<div class='activate'><button name='activate' value='".$row['email']."' >activer</button></div>";
                        echo "<tr>
                        <th style='color:rgb(255, 251, 138)'>".$row['nom']."</th>  <th style='color:rgb(255, 251, 138)'>".$row['prenom']."</th>
                        <th style='color:rgb(255, 251, 138)'>".$row['email']."</th> <th> ".$output." </th>  <th> ".$activate." </th> 
                        </tr>";
                    }
                }
        }
    }

?>
</table>
</form>

</div>
    


    <div class="boxMe">
        <h1>Ajouter un utilisateur</h1>
    
    <form action="modify_check.php" method="POST" >
        <input type="text" placeholder="nom"  name="nom" > 
        <input type="text" placeholder="prenom" name="prenom" > 
        <input type="text" placeholder="Email" name="email" > 
        <input type="password" placeholder="Password" name="password" >
        <input type="radio" name="gender" value="M"> Male
        <input type="radio" name="gender" value="F"> Female<br>
        
        <span class="subset" > <input type="submit" name="submit" >   </span>      <span class="subset" > <input type="reset" value="reset"></span> 
    </form>
    

    </div>
</body>
</html>


        <?php
    
    if(isset($_SESSION['active'])){
        ?>
                <script language="javascript"> 
                    if(confirm("Voulez-vous vraiment activer cet utilisateur?")){
                        window.location.href='activate.php';
                    } 
                </script>
        <?php
    }
    ?>





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
    ?>
    <?php 
    if(isset($_SESSION['remove'])){
        ?>
        <script>
        if(confirm("Voulez-vous vraiment supprimer l'utilisateur <?php  echo "' ".$_SESSION['nameRM'].' '.$_SESSION['prenomRM']." '"  ?>?")){
            window.location.href='removeCode.php';
        }
    </script>
    <?php 
    } 
    ?>

<?php
    if(isset($_SESSION['acivatt'])){
        ?>
            <script language="javascript">
            alert("<?php  echo $_SESSION['acivatt']  ?>");
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
    ?>

    <?php
    if(isset($_SESSION['removed'])){
        ?>
            <script language="javascript">
            alert("l'utilisateur  <?php  echo "' ".$_SESSION['nameRM'].' '.$_SESSION['prenomRM']." '"  ?> a été supprimé avec succès!");
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
    unset($_SESSION['active']);
    unset($_SESSION['acivatt']);
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
