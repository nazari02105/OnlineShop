<?php
if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != '' && $_POST['password'] != '') {
    include_once("../DBInformations/DBInformation.php");
    include_once("../Models/User.php");
    try {
        $conn = new PDO("mysql:host=$server;dbname=$dbName", $username, $password);

        $query = $conn->prepare("SELECT * FROM information_schema.tables WHERE table_name = 'Users' AND TABLE_SCHEMA = 'hw9-q1';");
        $query->execute();
        $users = $query->fetchAll();

        if (count($users) == 0){
            $conn->exec("CREATE TABLE users (username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, products VARCHAR(4095), numbers varchar(2047));");
        }

        $query2 = $conn->prepare("SELECT * FROM users WHERE username = '".$_POST['username']."';");
        $query2->execute();
        $theUser = $query2->fetchAll();
        if (count($theUser) == 0){
            $user = new User($_POST['username'], $_POST['password']);
            $query3 = $conn->prepare("INSERT INTO users VALUES (?, ?, NULL, NULL);");
            $query3->execute([$user->getUsername(), $user->getPassword()]);

            echo "Done";
            header("refresh:3;url=login.html");
        }
        else{
            echo "User with Username already exists.";
            header("refresh:3;url=signup.html");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        header("refresh:3;url=signup.html");
    }
} else {
    echo "Something went wrong";
    header("refresh:3;url=signup.html");
}
