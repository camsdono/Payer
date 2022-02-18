<!DOCTYPE html>
<html>
    <head>
        <title>Payer | Category</title>
    </head>
</html>
<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
require_once('config.php');

$category = $_GET["category"];

if($category === "computer") {
    $sql = "SELECT id, item_name, 
    item_description, 
    item_author, 
    item_catagory, 
    item_image1, 
    item_image2, 
    item_image3  
    FROM published_items 
    WHERE item_catagory='$category'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            
            <link rel="stylesheet" href="../screens/index.css">
            
            <div class="card1" id="card" onClick="location.href='item_display.php?id=<?=$row["id"] ?>'" name="card">
                <h3 style="padding-top: 5px;"><?php echo $row["item_name"] ?></h3>
                <img src="uploads/<?=$row['item_image3']?>" width="250" height="300">
                <p>Author: <?=$row['item_author'] ?></p>
            </div>
               
            <?php
        }
    } else {
    echo "0 results";
    }
}
} else {
    header("Location: login.php");
    exit();
}

?>


