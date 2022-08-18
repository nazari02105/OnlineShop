<?php
if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != '' && $_POST['password'] != '') {
    include_once("../DBInformations/DBInformation.php");
    try {
        $conn = new PDO("mysql:host=$server;dbname=$dbName", $username, $password);

        $query = $conn->prepare("SELECT * FROM information_schema.tables WHERE table_name = 'Users' AND TABLE_SCHEMA = 'hw9-q1';");
        $query->execute();
        $users = $query->fetchAll();

        if (count($users) == 0){
            $conn->exec("CREATE TABLE users (username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL);");
        }

        $query2 = $conn->prepare("SELECT * FROM users WHERE username = '".$_POST['username']."';");
        $query2->execute();
        $theUser = $query2->fetchAll();
        if (count($theUser) == 0){
            echo "No such user found with this username.";
            header("refresh:3;url=login.html");
        }
        else{
            if ($_POST['password'] != $theUser[0]['password']){
                echo "Password in wrong.";
                header("refresh:3;url=login.html");
            }
            else{
                session_start();
                setcookie("theUsername", $_POST['username'], path:'/');
                echo "Done";
                header("refresh:3;url=../Shop/index.php");
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        header("refresh:3;url=login.html");
    }
} else {
    echo "Something went wrong";
    header("refresh:3;url=login.html");
}