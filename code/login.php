<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title>
</head>
<body>

    <img src="img/login.png" height="170" width="640" id="img" >

    <div class="box">
        <h1>Login</h1>
    
    <form action="traiterInfos/login_check.php" method="POST" >
        <input type="text" placeholder="Email"  name="email" > 
        <input type="password" placeholder="Password" name="password" > 
        <span class="subset" > <input type="submit" name="submit" >   </span>      <span class="subset" > <input type="reset" value="reset"></span> 
    </form>


    </div>

</body>
</html>
