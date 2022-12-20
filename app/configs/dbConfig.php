<?php require "../app/utils/constants.php";
    $connect = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    if($connect->connect_error){
        die("Failed to connect to DB: " . $connect->connect_error);
    }
