<?php 

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Payer | Home (<?php echo $_SESSION['username']; ?>)</title>
        <link rel="stylesheet" href="index.css">
        <script src="https://kit.fontawesome.com/25bc72aa95.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="topnav">
        <a class="active" href="home.php">Home</a>
        <a href="dashboard.php">Your Dashboard</a>
        <a style="float: right;" href="#"><i class="fa-solid fa-gear"></i></a>
        <a style="float: right;" id="no-notice" href="basket_display.php"><i class="fa-solid fa-cart-shopping"></i></a>
        <a style="float: right;" id="no-notice" href="#"><i class="fa-solid fa-bell"></i></a>
        <a style="float: right;" href="#"><i class="fa-solid fa-user"></i></a>
       
    </div> 
        <a href="../database/create_post.php">Create Post</a>
        <div class="categorys">
            <div class="card" id="computer_card">
                <h3 style="padding-top: 5px;">Computers | IT | Admin</h3>
            </div>
        </div>
    </body>
    <script src="../database/script.js"></script> 
</html>
<?php 

}else{
    header("Location: ../database/login.php");
    exit();
}

?>

