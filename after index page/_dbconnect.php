<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "main project";
    $con = mysqli_connect($server,$username,$password,$database);
    if(!$con){
        echo "fail";
    }
?>