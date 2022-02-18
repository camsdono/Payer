<!DOCTYPE html>
<html>
    <head>
        <title>Payer | Create Post</title>
        <link rel="stylesheet" href="loginStyles.css">
    </head>
    <body>
        <h1>Create Post</h1>
        <?php session_start();

            if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

        ?>

        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="text-inputs" style="margin-left: 65px;">
                <input type="text" name="item_name" placeholder="Item Name..." class="item-objects" required><br>
                <input type="text" name="item_description" placeholder="Item Description..." class="item-objects" required><br>
            </div>
            Category: <select class="dropdown" id="category" name="item_category" required>
                <option value="" disabled selected hidden>Please Select</option>
                <option value="art">Art</option>
                <option value="computer">Computer/IT/Admin</option>
                <option value="composition">Composition</option>
            </select><br>
            Image 1: <input type="file" name="image1" class="upload-image" required><br>
            Image 2: <input type="file" name="image2" class="upload-image" required><br>
            Image 3: <input type="file" name="image3" class="upload-image" required><br>
            <input style="margin-left: 65px;" type="submit" name="upload-btn" value="Upload" class="btn">
        </form>

        <?php
            } else {
                header("Location: login.php");
                exit();
            }
        ?>
    </body>
</html>