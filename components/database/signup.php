<!DOCTYPE html> 
<html lang="en">
    <head>
        <title>Payer | Signup</title>
        <link rel="stylesheet" href="loginStyles.css">
    </head>
    <body>
        <form action="process.php" method="post">
            <input type="text" placeholder="username" class="txt" name="username" required><br>
            <input type="text" placeholder="firstname" class="txt" name="firstname" required><br>
            <input type="text" placeholder="lastname" class="txt" name="lastname" required><br>
            <input type="email" placeholder="email" class="txt" name="email" required><br>
            <input type="password" placeholder="password" class="txt" name="password" required><br>
            <input type="password" placeholder="confirm password" class="txt" name="cpassword" required><br>
            <input type="submit" value="Create a Account" class="btn" name="btn-save"><br>
            <a class="link" href="login.php">Already have a account</a>
        </form>
    </body>
</html>