<?php
require_once('config.php');

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    

    $id = $_GET["id"];
    $sql = "SELECT id, item_name, 
    item_description, 
    item_author, 
    item_catagory, 
    item_price,
    item_image1, 
    item_image2, 
    item_image3  
    FROM published_items 
    WHERE id='$id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <link rel="stylesheet" href="cardStyles.css">
            
            <div class="card2" id="card2" onClick="" style="padding-bottom: 8%;">
                <h3 style="padding-top: 5px;"><?php echo $row["item_name"] ?></h3>
                <p>Author: <?=$row['item_author'] ?></p>
                <p>Description: <?=$row['item_description'] ?></p>
                

                <div class="arrow-controls" style="font-size: 5vh; ">
                    <img src="uploads/<?=$row['item_image1'] ?>" class="image" id="image1" width="65%" height="65%"/>
                    <img src="uploads/<?=$row['item_image2'] ?>" class="image" id="image2" width="65%" height="65%"/>
                    <img src="uploads/<?=$row['item_image3'] ?>" class="image" id="image3" width="65%" height="65%"/>
                    <div class="arrow-left" id="arrow-left"
                    style="float: left; margin-left: 10px; cursor: pointer; margin-top: 25%;">
                        <p><</p>
                    </div>
                    <div class="arrow-right" id="arrow-right"
                    style="float: right; margin-right: 10px; cursor: pointer; margin-top: 25%;">
                        <p>></p>
                    </div>
                </div>
                <div class="checkout">
                    <div class="checkout-buttons" id="checkout-buttons" style="margin-top: 10px;">
                        <form 
                        action="process.php?id=<?=$id?>" 
                        method="post"
                        onsubmit="checkoutBtnPressed">
                            <?php
                                $item_name = $row['item_name'];
                                $item_author = $row['item_author'];
                                $item_price = $row['item_price'];

                                $checkout_state = "";
                            ?>
                            <div class="invisible_fields" style="display: none;">
                                <input type="text" value="<?=$item_name?>" name="item_name">
                                <input type="text" value="<?=$item_author?>" name="item_author">
                                <input type="text" value="<?=$item_price?>" name="item_price">
                            </div>
                            <input type="submit"
                              id="checkout-btn"
                                name="btn-checkout"
                                class="btn"
                                value="Add To Cart"
                                <?php
                                $sql1 = "SELECT
                                item_id,
                                username
                                FROM checkout
                                WHERE item_id='$id'";
                                ?>

                                <?php

                                $result1 = $con->query($sql1);
                                while($row1 = $result1->fetch_assoc()) {
                                    if($row1['item_id'] == $id) {
                                        ?>
                                        
                                        <?php
                                    }
                                    
                                    else {
                                        ?>
                                       
                                        <?php
                                    }
                                   
                                }
                                ?>
                            ><br>
                        </form>
                    </div>
                </div>
            </div>
 

            <script>
                var arrowLeft = document.getElementById('arrow-left');
                var arrowRight = document.getElementById('arrow-right');
                var image1 = document.getElementById('image1');
                var image2 = document.getElementById('image2');
                var image3 = document.getElementById('image3');

                var checkoutButtons = document.getElementById('checkout-buttons');
                var checkoutSubmitButton = document.getElementById('checkout-btn');

                function enableButton() {
                    checkoutSubmitButton.disabled = false;
                    checkoutButtons.style.backgroundColor = "rgb(89, 209, 65);"
                    checkoutSubmitButton.value = "Add To Cart";
                }

                function disableButton() {
                    checkoutSubmitButton.disabled = true;
                    checkoutButtons.style.backgroundColor = "rgb(131, 131, 131)";
                    checkoutSubmitButton.value = "Already Added";
                }

                window.onload = event => {
                    <?php

                        $result1 = $con->query($sql1);
                        while($row1 = $result1->fetch_assoc()) {
                            if($row1['item_id'] == $id) {
                                ?>
                                disableButton();
                                <?php
                            }
                            
                            else {
                                ?>
                                enableButton();
                                <?php
                            }
                            
                        }
                    ?>
                }

                var index = 1;
                function arrowCheck() {
                    if(index === 1) {
                        arrowLeft.style.visibility = "hidden";
                        image1.style.display = "inline-block";
                    }
                    else {
                        image1.style.display = "none";
                        arrowLeft.style.visibility = "visible";
                    }

                    if(index === 2) {
                        image2.style.display = "inline-block";
                    }
                    else {
                        image2.style.display = "none";
                    }

                    if(index === 3) {
                        arrowRight.style.visibility = "hidden";
                        image3.style.display = "inline-block";
                    } 
                    else {
                        arrowRight.style.visibility = "visible";
                        image3.style.display = "none";
                    }
                }

                
                arrowCheck();

                function isChecklist() {
                    
                }

                isChecklist();

                arrowLeft.onclick = function() {
                    if(index != 1)
                    {
                        index -= 1;
                        arrowCheck();
                    }
                }

                arrowRight.onclick = function() {
                    if(index != 3) {
                        index += 1;
                        arrowCheck();
                   }
                }
            </script>
            <?php

                
        }
    }
} 
else  
{
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Payer | Item</title>
    </head>
</html>