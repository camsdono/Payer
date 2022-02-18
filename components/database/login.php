<!DOCTYPE html> 
<html lang="en">
    <head>
        <title>Payer | Login</title>
        <link rel="stylesheet" href="loginStyles.css">
    </head>
    <body>
        <form action="process.php" method="post">
            <input type="text" placeholder="Username" class="txt" name="username" required><br>
            <input type="password" placeholder="Password" class="txt" name="password" required><br>
            <input type="submit" value="Login" class="btn" name="btn-login"><br>
            <a class="link1" href="signup.php">Don't Have A Account Get Started</a>
        </form>
    </body>
</html> 