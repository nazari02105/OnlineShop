<?php

?>


<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Cart</title>

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">SHOP</a>
                            <ul class="dropdown-menu">
                                <li><a href="cart.php">Cart</a></li>
                                <li><a href="Shop.php">Shop</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="side-menu"><a href="cart.php">
						<i class="fa fa-shopping-bag"></i>
                            <span id="forNumber" class="badge">
                            <?php
                                $bought = "";
                                //
                                include_once("../DBInformations/DBInformation.php");
                                try {
                                    $conn = new PDO("mysql:host=$server;dbname=$dbName", $username, $password);

                                    $query = $conn->prepare("SELECT * FROM information_schema.tables WHERE table_name = 'Users' AND TABLE_SCHEMA = 'hw9-q1';");
                                    $query->execute();
                                    $users = $query->fetchAll();

                                    if (count($users) == 0){
                                        $conn->exec("CREATE TABLE users (username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, products VARCHAR(4095), numbers varchar(2047));");
                                    }

                                    $query2 = $conn->prepare("SELECT * FROM users WHERE username = '".$_COOKIE['theUsername']."';");
                                    $query2->execute();
                                    $theUser = $query2->fetchAll();
                                    if (count($theUser) != 0){
                                        $bought = $theUser[0]['products'];
                                    }
                                    else{
                                        echo "Authentication failed.";
                                        header("refresh:3;url=../SignUpAndLogIn/login.html");
                                    }
                                } catch (PDOException $e) {
                                    echo $e->getMessage();
                                    header("refresh:3;url=../SignUpAndLogIn/login.html");
                                }
                                //
                                if (!isset($bought)){
                                    echo "0";
                                }
                                else if ($bought == '' || $bought == NULL) {
                                    echo "0";
                                }
                                else{
                                    $str = $bought;
                                    $arr = explode('-', $str);
                                    echo count($arr)-1;
                                }
                            ?>
                            </span>
					</a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                include_once("../Models/Product.php");
                                $car = new Product("images/shop_car.png", "$8999");
                                $case = new Product("images/shop_case.png", "$460");
                                $hat = new Product("images/shop_hat.png", "$9.79");
                                $headset = new Product("images/shop_headset.png", "$70");
                                $jacket = new Product("images/shop_jacket.jpg", "$12");
                                $laptop = new Product ("images/shop_laptop.jpg", "$360");
                                $mobile = new Product("images/shop_mobile.png", "$80");
                                $shoe = new Product("images/shop_shoe.jpg", "$24");
                                $tShirt = new Product("images/shop_tshirt.jpg", "$9");

                                $product_arr = [$car->getName(), $case->getName(), $hat->getName(), $headset->getName(), $jacket->getName(), $laptop->getName(),
                                $mobile->getName(), $shoe->getName(), $tShirt->getName()];
                                $price_arr = [$car->getPrice(), $case->getPrice(), $hat->getPrice(), $headset->getPrice(), $jacket->getPrice(), $laptop->getPrice(),
                                $mobile->getPrice(), $shoe->getPrice(), $tShirt->getPrice()];
                                //
                                $theBought = "";
                                $theNumbers = "";
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
                                        $theBought = $theUser[0]['products'];
                                        $theNumbers = $theUser[0]['numbers'];
                                    } else {
                                        echo "Authentication failed.";
                                        header("refresh:3;url=../SignUpAndLogIn/login.html");
                                    }
                                } catch (PDOException $e) {
                                    echo $e->getMessage();
                                    header("refresh:3;url=../SignUpAndLogIn/login.html");
                                }
                                //
                                if (isset($theBought) && $theBought != "" && $theBought != null){
                                    $str = $theBought;
                                    $arr = explode("-", $theBought);
                                    $numberArr = explode("-", $theNumbers);
                                    for ($i = 0; $i<count($arr) - 1; ++$i){
                                        ?>

                                        <tr id="thisRow<?php echo $arr[$i]; ?>">
                                            <td class="thumbnail-img">
                                                <a href="#">
									                <img class="img-fluid" src=<?php echo $arr[$i]; ?> alt="" />
								                </a>
                                            </td>
                                            <td class="name-pr">
                                                <a href="#">
									                Lorem ipsum dolor sit amet
								                </a>
                                            </td>
                                            <td class="price-pr">
                                                <p><?php echo $price_arr[array_search($arr[$i], $product_arr)]; ?></p>
                                            </td>
                                            <td class="quantity-box"><input type="number" size="4" value=<?php echo $numberArr[$i]; ?> min="1" step="1" class="c-input-text qty text" onchange="changePrice( '<?php echo $price_arr[array_search($arr[$i], $product_arr)]; ?>', this.value, '<?php echo $i; ?>');"></td>
                                            <td class="total-pr">
                                                <p id="total<?php echo $i; ?>"><?php echo "$".(substr($price_arr[array_search($arr[$i], $product_arr)], 1) * $numberArr[$i]); ?></p>
                                            </td>
                                            <td class="remove-pr">
                                                
                                                <a onclick="deleteRow('<?php echo $arr[$i]; ?>', '<?php echo $i; ?>')">
									                <i class="fas fa-times"></i>
								                </a>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div id="totalTotal" class="ml-auto font-weight-bold"> 
                                <?php
                                $sum = 0;
                                if (isset($arr)){
                                    for ($i = 0; $i<count($arr)-1; $i++) {
                                        $sum += (substr($price_arr[array_search($arr[$i], $product_arr)], 1) * $numberArr[$i]);
                                    }
                                }
                                echo "$$sum";
                                ?>
                            </div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Tax</h4>
                            <div class="ml-auto font-weight-bold"> $ 2 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Shipping Cost</h4>
                            <div class="ml-auto font-weight-bold"> Free </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div id="mainTotal" class="ml-auto h5"> <?php echo "$".($sum + 2); ?> </div>
                        </div>
                        <hr> 
                    </div>
                </div>
                <div class="col-8"></div>
                <div class="col-2 d-flex shopping-box"><a href="cleanCart.php" class="ml-auto btn hvr-hover">Clean Cart</a> </div>
                <div class="col-2 d-flex shopping-box"><a href="cart.php" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-01.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-02.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-03.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-04.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-06.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-07.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-08.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-09.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/Instagram/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js."></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
    <script src="price.js"></script>
    <script src="buying.js"></script>
</body>

</html>