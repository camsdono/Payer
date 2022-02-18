<?php 

    require_once('config.php');

    if(isset($_POST['btn-checkout'])) {
        session_start();
        $id = $_GET["id"];
        $sql = "SELECT
        id,
        item_name, 
        item_description, 
        item_author, 
        item_catagory, 
        item_price,
        item_image1, 
        item_image2, 
        item_image3  
        FROM published_items 
        WHERE id='$id'";
        

        $username = $_SESSION['username'];
        $item_id = $id;
        $item_name = $_POST['item_name'];
        $item_author = $_POST['item_author'];
        $item_price = $_POST['item_price'];
        
        $sql = "INSERT INTO checkout (username, item_id, item_name, item_author, item_price) values('$username', '$item_id', '$item_name', '$item_author', '$item_price')";
        $result = mysqli_query($con, $sql);

        if($result) {
            echo "This item has been added to your checkout";
        } else {
            echo "An error has occured please try again later";
        }  
    }


    if(isset($_POST['btn-save'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);

        if($password != $cpassword) {
            echo "Passwords do not match";
        }
        else {
            $Pass = md5($password);
            $sql = "INSERT INTO users (username, password, firstname, surname, email) values('$username', '$Pass', '$firstname', '$lastname', '$email')";
            $result = mysqli_query($con, $sql);

            if($result) {
                echo "Your account has been created";
            } else {
                echo "An error has occured please try again later";
            }
        }
    }

    if(isset($_POST['btn-login'])) {
        session_start();
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $Pass = md5($password);

        $sql = "SELECT * FROM users WHERE username = '$username' AND password='$Pass'";
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if($row['username'] === $username && $row['password'] === $Pass) {
                echo "Logged In";
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../screens/home.php");
            } else {
                header("Location: login.php?"); 
                echo "Incorrect username or password";
                exit();
            }
        } else {
            header("Location: login.php?"); 
            echo "Incorrect username or password";
            exit();
        } 
    }

    if(isset($_POST['upload-btn']) && isset($_FILES['image1'])) {
        session_start();
        $item_name = mysqli_real_escape_string($con, $_POST['item_name']);
        $item_description = mysqli_real_escape_string($con, $_POST['item_description']);
        $item_author = $_SESSION['username']; 
        $item_category = mysqli_real_escape_string($con, $_POST['item_category']);

        $img_name1 = $_FILES['image1']['name'];
        $img_size1 = $_FILES['image1']['size'];
        $tmp_name1 = $_FILES['image1']['tmp_name'];
        $error1 = $_FILES['image1']['error'];

        $img_name2 = $_FILES['image2']['name'];
        $img_size2 = $_FILES['image2']['size'];
        $tmp_name2 = $_FILES['image2']['tmp_name'];
        $error2 = $_FILES['image2']['error'];

        $img_name3 = $_FILES['image3']['name'];
        $img_size3 = $_FILES['image3']['size'];
        $tmp_name3 = $_FILES['image3']['tmp_name'];
        $error3 = $_FILES['image3']['error'];

        if($error1 === 0 && $error2 === 0 && $error3 === 0) {
            if($img_size1 > 125000 && $img_size2 > 125000 && $img_size3 > 125000) {
                $em = "Sorry your file is too large";
                header("Location: ../screens/home.php");
            } else {
                $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
                $img_ex_lc1 = strtolower($img_ex1);

                $img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);
                $img_ex_lc2 = strtolower($img_ex2);

                $img_ex3 = pathinfo($img_name3, PATHINFO_EXTENSION);
                $img_ex_lc3 = strtolower($img_ex3);

                $allowed_exs = array("jpg", "jpeg", "png");

                if(in_array($img_ex_lc1, $allowed_exs) && in_array($img_ex_lc2, $allowed_exs) && in_array($img_ex_lc3, $allowed_exs)) {
                    $new_img_name1 = uniqid("IMG-", true). '.' . $img_ex1;
                    $img_upload_path1 = 'uploads/' . $new_img_name1;
                    move_uploaded_file($tmp_name1, $img_upload_path1);

                    $new_img_name2 = uniqid("IMG-", true). '.' . $img_ex2;
                    $img_upload_path2 = 'uploads/' . $new_img_name2;
                    move_uploaded_file($tmp_name2, $img_upload_path2);

                    $new_img_name3 = uniqid("IMG-", true). '.' . $img_ex3;
                    $img_upload_path3 = 'uploads/' . $new_img_name3;
                    move_uploaded_file($tmp_name3, $img_upload_path3);

                    $sql = "INSERT INTO published_items (item_name,
                     item_description,
                      item_author,
                       item_catagory,
                        item_image1,
                        item_image2,
                        item_image3) 
                        VALUES('$item_name',
                        '$item_description',
                         '$item_author',
                         '$item_category',
                          '$new_img_name1',
                          '$new_img_name2',
                          '$new_img_name3')";
                    mysqli_query($con, $sql);
                    header("Location: ../screens/home.php");
                } else {
                    $em = "Sorry you can't upload a file of this type";
                    header("Location: ../screens/home.php");
                }
            }
        } else {
            $em = "unknown error occured";
            header("Location: ../screens/home.php");
        }
    }

?>