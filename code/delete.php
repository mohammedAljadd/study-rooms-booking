<?php   
        session_start();
        include 'includes/dbconn.php';
        $email = $_SESSION['email'];
        $sql = "select idProf from prof where email='".$email."';";
        $result= mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result))
            {
                $Id = $row['idProf'];
            }
        $sql = "DELETE FROM `affectation`  where idProf='".$Id."';";
        $result = mysqli_query($conn,$sql);
        header('location:reservation.php?removed'); 
        $_SESSION['error']="annuler";
?>