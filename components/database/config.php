<?php

    $con = mysqli_connect('localhost', 'root','','payer');

    if(!$con) {
        echo "Please check database connection";
    }
?>