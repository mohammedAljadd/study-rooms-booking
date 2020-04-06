
<?php
    session_start();
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
<div class="boxw">
<h1>Users</h1>
<table border="1">
<tr>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Email</th>
    <th>Password</th>
</tr>
<?php
    $sql = " SELECT * FROM `prof`;";
    $result = mysqli_query($conn,$sql);
    $out = mysqli_num_rows($result);
    if($out>0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                <th>".$row['nom']."</th>  <th>".$row['prenom']."</th>
                <th>".$row['email']."</th>  <th>".$row['password']."</th>
                </tr>";
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
        
        <label for="add"> Add </label>
        <input type="radio"  name="modify" value="add">
            
        <label for="remove"> Remove </label>
        <input type="radio" name="modify"  value="remove">
        <br>
        <span class="subset" > <input type="submit" name="submit" >   </span>      <span class="subset" > <input type="reset" value="reset"></span> 
    </form>


    </div>



</body>
</html>



<?php
        }
        elseif(!isset($_SESSION['email'])){
            include 'login.php';
        }
        elseif($_SESSION['email']!="aljadd.mohammed@ine.inpt.ma"){
            ?>

            <h1>You are not allowed to visit this web page as you are not the administrator!</h1> 
            
            <?php
        }
?>
