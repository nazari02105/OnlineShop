<?php

$toReturn = "yes";
if (isset($_GET['product']) && isset($_GET['user'])) {
    $theBought = "";
    $theNumbers = "";
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

        $query2 = $conn->prepare("SELECT * FROM users WHERE username = '" . $_GET['user'] . "';");
        $query2->execute();
        $theUser = $query2->fetchAll();
        if (count($theUser) != 0) {
            $theBought = $theUser[0]['products'];
            $theNumbers = $theUser[0]['numbers'];
        } else {
            $toReturn = "No";
            header("refresh:3;url=../SignUpAndLogIn/login.html");
        }
    } catch (PDOException $e) {
        $toReturn = "No";
        header("refresh:3;url=../SignUpAndLogIn/login.html");
    }
    //
    $product = $_GET['product'];
    if (isset($theBought) && $theBought != "" && $theBought != null) {
        $isExist = false;
        $arrProduct = explode('-', $theBought);
        $arrNumbers = explode('-', $theNumbers);
        for ($i = 0; $i < count($arrProduct) - 1; $i++) {
            if ($arrProduct[$i] == $product) {
                $toReturn = "no";
                $arrNumbers[$i] += 1;
                $isExist = true;
                break;
            }
        }
        $productImp = "";
        $numberImp = "";
        for ($i = 0; $i < count($arrNumbers) - 1; $i++) {
            $productImp .= $arrProduct[$i] . "-";
            $numberImp .= $arrNumbers[$i] . "-";
        }
        $query3 = $conn->prepare("UPDATE users SET products = '" . ($productImp) . "', numbers = '" . ($numberImp) . "' WHERE username = '" . $_GET['user'] . "';");
        $query3->execute();

        if (!$isExist) {
            $query3 = $conn->prepare("UPDATE users SET products = '" . ($theBought . $product . "-") . "', numbers = '" . ($theNumbers . "1-") . "' WHERE username = '" . $_GET['user'] . "';");
            $query3->execute();
        }
    } else {
        include_once "../DBInformations/DBInformation.php";
        try {
            $conn = new PDO("mysql:host=$server;dbname=$dbName", $username, $password);

            $query = $conn->prepare("SELECT * FROM information_schema.tables WHERE table_name = 'Users' AND TABLE_SCHEMA = 'hw9-q1';");
            $query->execute();
            $users = $query->fetchAll();

            if (count($users) == 0) {
                $conn->exec("CREATE TABLE users (username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, products VARCHAR(4095), numbers varchar(2047));");
            }

            $query2 = $conn->prepare("SELECT * FROM users WHERE username = '" . $_GET['user'] . "';");
            $query2->execute();
            $theUser = $query2->fetchAll();
            if (count($theUser) != 0) {
                $query3 = $conn->prepare("UPDATE users SET products = '" . ($product . "-") . "', numbers = '" . ("1-") . "' WHERE username = '" . $_GET['user'] . "';");
                $query3->execute();
            } else {
                $toReturn = "No";
                header("refresh:3;url=../SignUpAndLogIn/login.html");
            }
        } catch (PDOException $e) {
            $toReturn = "No";
            header("refresh:3;url=../SignUpAndLogIn/login.html");
        }
    }
}

echo $toReturn;
