<?php 

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    require_once('../database/config.php');

    $username = $_SESSION['username'];

    $sql = "SELECT 
            id,
            username,
            item_id,
            item_name,
            item_author,
            item_price
             FROM checkout
             WHERE username = '$username'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <link rel="stylesheet" href="../screens/index.css">

            <ul>
                <li><?php echo $row['item_name'], "  ",  $row['item_price'] ?> </li>
            </ul>

            <?php
        }
    }

}else{
    header("Location: ../database/login.php");
    exit();
}

?>
