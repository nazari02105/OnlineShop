<?php

//
include_once "../DBInformations/DBInformation.php";
try {
    $conn = new PDO("mysql:host=$server;dbname=$dbName", $username, $password);

    $query = $conn->prepare("SELECT * FROM information_schema.tables WHERE table_name = 'Users' AND TABLE_SCHEMA = 'hw9-q1';");
    $query->execute();
    $users = $query->fetchAll();

    if (count($users) == 0) {
        $conn->exec("CREATE TABLE users (username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, products VARCHAR(4095), numbers varchar(2047));");
    }

    $query2 = $conn->prepare("SELECT * FROM users WHERE username = '" . $_COOKIE['theUsername'] . "';");
    $query2->execute();
    $theUser = $query2->fetchAll();
    if (count($theUser) != 0) {
        $query3 = $conn->prepare("UPDATE users SET numbers = NULL, products = NULL WHERE username = '" . $_COOKIE['theUsername'] . "';");
        $query3->execute();
    } else {
        header("refresh:3;url=../SignUpAndLogIn/login.html");
    }
} catch (PDOException $e) {
    header("refresh:3;url=../SignUpAndLogIn/login.html");
}
//

header("refresh:1;url=cart.php");
