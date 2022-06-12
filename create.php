<?php
/*
    first create database named as "main project"
    in phpyadmin then run this file on your localhost
*/
$servername = "localhost";
$username = "root";
$password = "";
$db = "main project";
$conn = mysqli_connect($servername, $username, $password, $db);

$usql = "CREATE TABLE userdetail (
    Sno INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(20),
    lastName VARCHAR(20),
    fatherName VARCHAR(50),
    motherName VARCHAR(20),
    address VARCHAR(20),
    DOB date NULL,
    email VARCHAR(50),
    username VARCHAR(20) UNIQUE KEY,
    password VARCHAR(255),
    accountNo INT(7),
    balance double
    )";

if($conn->query($usql)) {
    echo "done";
}else{
    echo $conn->error;
}
$tsql = "CREATE TABLE transaction (
        Sno INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        accountNo INT(7),
        faccountNo INT(7),
        name TEXT,
        fname TEXT,
        amount INT(11),
        DateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        transactionId TEXT
        )";

if ($conn->query($tsql)) {
    echo "done";
} else {
    echo $conn->error;
}
$conn->close();
?>